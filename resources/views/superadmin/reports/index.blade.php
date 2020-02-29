@extends('layouts.app')

            @section('content')
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Reports</div>
                            <div class="card-body">
                                
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>  
                            @endif



                            {!! Form::open(['url' => 'reports', 'method' => 'GET', 'files' => true]) !!}
                            <div>
                            <label>Period:</label>
                            {!! Form::select('period', $periods,  $request->period, ['id' => 'period', 'class' => 'form-control', 'onchange' => 'periodNow(this.value)']) !!}
                            </div>

                            <label>Users:</label>
                            {!! Form::select('user', $users, $request->user, ['id' => 'user', 'class'=> 'form-control', 'placeholder' => 'all']) !!} 
                        
                            <br>
                            <div id="specific_date">
                                
                            </div>

                            <!--
                            <label>Specific Date:</label>
                            <input type="date" name="date" id="date">
                            -->

                            <div class="text-center" style="margin-top:20px">

                            <!--
                            <button id="get_query" type="button" class="btn btn-sm btn-info" onclick="querySale()">query</button> -->

                            {!! Form::submit('Check', ['class' => 'btn btn-sm btn-success']) !!}

                            {!! Form::close() !!}
                            </div>

                            <hr>
                            @if($sales) 
                            <div id="report">
                                <table class="table table-stripped table-bordered" id="myTable">
                                    <thead>
                                        <tr>
                                            <td>User</td>
                                            <td>Client</td>
                                            <td>Description</td>
                                            <td>Date</td>
                                            <td>Total Amount</td>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            $count_total = 0; 
                                        ?>
                                        @foreach($sales as $sale) 
                                        <tr>
                                            <td>{{$sale->user->name}}</td>
                                            <td>
                                                @if($sale->client)
                                                    {{$sale->client->name}}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{$sale->description}}</td>
                                            <td>{{$sale->created_at}}</td>
                                            <td>{{$sale->total_amount}}</td>

                                        </tr>
                                        <?php 
                                            $count_total = $count_total + $sale->total_amount;
                                        ?>
                                        @endforeach
                                    </tbody> 
                                                                  
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-left; font-weight-hold">TOTAL: </td>
                                            <td class="text-right font-weight-hold">{{$count_total}}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                       
                            </div>
                            @endif
                            <hr>
                        </div>
 
                    </div>
                </div>
            </div>
@endsection

@section('scripts')

    <script type="text/javascript">
            function periodNow(value)
            {
                if(value == 4)
                {
                    $('#specific_date').show();
                    var $lavel = $('<label>').text('Specific Date: ');
                    var $input = $('<input>').attr({
                    type: "date", 
                    id: "specific",
                    name: "specific",
                    required: "required", 
                    });
                    $input.appendTo($lavel);
                    $('#specific_date').append($lavel);

                }
                else 
                {
                    $('#specific_date').empty();
                    $('#specific_date').hide();

                }
              
                
            }

                function querySale()
                {

                    /*
                    var period = $('#period').val();
                    var user = $('#user').val(); 
                    console.log("period_sub: ",period); 
                    console.log("user_id: ",user);


                    $.ajax({
                        url: "{{ url('reports/query') }}" + "/" + $('#period').val() + "/" + $('#user').val(),  
                        type: 'GET', 
                        data: {},
                        success: function(response){
                            console.log(response);
                            } 
                    });

                    $('#report').html('<hr>');

                    var content = "<table>"

                    content +="</table>"

                    $('#report').append(content);
                    */
                }


                $(document).ready(function(){

                    /*
                    $('#get_query').keyup(function(){


                        console.log("Hola");
                        
                    
                        $.ajax({
                            url: "{{ url('reports/query') }}" + "/" + $('#period').val() + "/" + $('#user').val(),  
                            type: 'GET', 
                            data: {},
                            success: function(response){
                                console.log(response);
                            } 
                        });

                    }); 
                    */

                    var period = $('#period').val();
                    $('#period').on('change', function(){
                        console.log(this.value);
                    });
                    console.log('period: ', period);

                    $('#myTable').DataTable();
                });


    </script>
@endsection
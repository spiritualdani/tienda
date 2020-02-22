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

                                <label>Period:</label>
                                {!! Form::select('period',$periods, null, ['id' => 'period','class' => 'form-control']) !!}

                                <label>Users:</label>
                                {!! Form::select('user',$users, null, ['id' => 'user', 'class'=> 'form-control']) !!}

                                @if ($sales)
                                <hr>
                                <div id="report">
                                    <table class="table table-stripped table-bordered" id="myTable">
                                                    <thead>
                                                        <tr>    
                                                            <td>User</td>
                                                            <td>Client</td>
                                                            <td>Description</td>
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
                                                                    {{ $sale->client->name}}
                                                                @else
                                                                    -
                                                                @endif

                                                            </td>
                                                            <td>{{$sale->description}}</td>
                                                            <td>{{$sale->total_amount}}</td>


                                                        </tr>
                                                        <?php  
                                                            $count_total = $count_total + $sale->total_amount; 
                                                        ?>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3" class="text-left; font-weight-bold">TOTAL: </td>
                                                            <td class="text-right font-weight-bold">{{$count_total}}</td>                                    
                                                        </tr>
                                                    </tfoot>
                                    </table>

                                </div>
                                @endif

                                <div class="text-center" style="margin-top:20px">
                                <button id="get_query" type="button" class="btn btn-sm btn-info" onclick="querySale()">query</button>
                            
                                {!! Form::submit('Save', ['class' => 'btn btn-sm btn-success']) !!}

                                {!! Form::close() !!}

                                </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection

@section('scripts')

    <script type="text/javascript">

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

                    $('#myTable').DataTable();
                });


    </script>
@endsection
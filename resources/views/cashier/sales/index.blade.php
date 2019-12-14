@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">New Sale</div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                    </div>
                @endif
               


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">  
                
                {!! Form::open(['url' => 'cashier/sales', 'files'=>true])!!} 
                <br>
                <label>Name:</label>
                {!! Form::text('name', null,['id'=>'name', 'class' => 'form-control', 'required' => 'required']) !!}

                <label>CI:</label>
                {!! Form::text('ci', null,['id'=>'ci','class' => 'form-control', 'required' => 'required']) !!}  

                <label>Product:</label>
                {!! Form::select('products_id[]',$products, null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Quantity:</label>
                {!! Form::number('quantity',null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Description:</label>
                {!! Form::textarea('description', null,['class' => 'form-control', 'required' => 'required']) !!} 

 
                <div class="text-center"></div>
                    {!! Form::submit('Save', ['class'=> 'btn btn-sm btn-success'])!!}
                    
                {!! Form::close()!!}

                </div>    
 


               <div class="card-header">Sales</div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>User</td>
                            <td>Client</td>
                            <!--<td>CI</td>-->  
                            <td>Description</td>
                            <td>Total Amount</td>

                        
                            <td>Actions</td>
                         
                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count_total = 0; 
                        ?> 

                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->user->name}}</td>
                                <!--<td>{{ $sale->user->ci}}</td>-->
                                <td> 
                                
                                @if($sale->client)        
                                    {{  $sale->client->name }}
                                
                                @else
                                    -
                                @endif

                                </td>
                                <td>{{ $sale->description }}</td>
                                <td>{{ $sale->total_amount }}</td>
                                
                                <td>
                                    <a href="/cashier/sales/{{$sale->id}}/sales_products">
                                    <button class="btn btn-sm btn-info" style="float:left; margin-right: 15px;">Sale Product</button>
                                    </a>
                                </td>
                                
                            </tr>

                            <?php
                                $count_total = $count_total + $sale->total_amount; 
                            ?>

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr >
                            <td colspan="3" class="text-left; font-weight-bold">TOTAL: </td>
                            <!--<td>CI</td>-->  
                            <td  class="text-right font-weight-bold" >{{$count_total}}</td>
                            <td></td>

                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript"> 
    $(document).ready( function () {

        $('#ci').keyup(function(){
            $.ajax({
                url: '{{ url('cashier/sales/get_client')}}'+ '/'+$('#ci').val(), 
                type: 'GET', 
                data: {}, 
                success: function(response){
                    $('#name').val(response);
                }
            }); 
         }); 
        $('#myTable').DataTable();
        
    });
 </script>

@endsection 




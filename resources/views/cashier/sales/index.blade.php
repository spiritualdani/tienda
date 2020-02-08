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


                <div class="row contenedor-cuadros" >

 

                    @foreach($products as $product)

                    <div class="col-md-3">

                    <div class="card" style="width:300px">

                        <div class="image">
                            <img src="{{asset('img/products/'.$product->picture)}}">
                        </div>
                            
                        <div class="card-body">
                            <p class="text-center">{{ $product->name }}</p>

                            <div class="row">
                            <div class="col-md-6">
                                <button id="sum" type="button" class="btn btn-sm btn-success" style="float:center; margin-right: 30px; margin-right: 0px;" onclick="add_product('{{$product->id}}')">+</button>
                                <button id="res" type="button" class="btn btn-sm btn-danger" style="float:right; margin-left: 20px;"  onclick="sub_product('{{$product->id}}')">-</button>

                            </div>
                            </div>

                            <div >
                                {!! Form::hidden('quantity[]', $product->id.',0',['class' => 'form-control', 'id' => 'product_'.$product->id]) !!} 

                                {!! Form::number('wind',0,['class' => 'form-control', 'id' => 'wind_'.$product->id,'disabled' => 'disabled' ]) !!} 
                            </div>

                        </div>  

                       

                    </div>

                    </div>

                     

                    @endforeach

                </div>  

                <!-- {!! Form::select('products_id[]',$products, null,['class' => 'form-control', 'required' => 'required']) !!} -->

                <!--

                <label>Quantity:</label>
                {!! Form::number('quantity', null,['class' => 'form-control', 'required' => 'required']) !!}

                -->

                <label>Description:</label>
                {!! Form::textarea('description', null,['class' => 'form-control']) !!} 

 
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
                                    </a >  
                                    <a href="{{'sales/'.$sale->id.'/bill'}}" target="_blank">
                                    
                                    <!-- <a href="/cashier/sales/{{$sale->id}}/bill">   -->
                                        
                                        <button class="btn btn-sm btn-secondary" style="float:center"> Bill
                                            
                                        </button>

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



        function add_product(product_id)
        {
            /*
            valor = parseInt($('#product_' + product_id).val());  
            valor = valor + 1;  
            $('#product_' + product_id).val(valor); 
            */

            var text = $('#product_' + product_id).val();
            textArray = text.split(','); 
            console.log(textArray);
            textArray[1] = parseInt(textArray[1]) + 1; 
            console.log(textArray);
            $('#product_' + product_id).val(textArray[0] + ',' + textArray[1]); 

            $('#wind_'+ product_id).val(textArray[1]);

        }

        function sub_product(product_id)
        {
            /*
            if($('#product_' + product_id).val() == 0) 
            {
                $('#product_' + product_id).val(0);  


            }
            else{


                valor = $('#product_' + product_id).val(); 
                valor = valor - 1; 
                $('#product_' + product_id).val(valor);
            }
            */

            var text = $('#product_' + product_id).val();
            textArray = text.split(','); 
            if(textArray[1] == '0')    
            {
                $('#product_' + product_id).val(textArray[0] + ',' + textArray[1]); 

                $('#wind_'+ product_id).val(textArray[1]); 
            }

            else 
            {
                textArray[1] = parseInt(textArray[1]) - 1; 
                $('#product_' + product_id).val(textArray[0] + ',' + textArray[1]); 

                $('#wind_'+ product_id).val(textArray[1]);
            }
        }

    $(document).ready( function () {

        $('#ci').keyup(function(){
            $.ajax({
                url: "{{ url('cashier/sales/get_client')}}"+ "/"+$('#ci').val(), 
                type: 'GET', 
                data: {}, 
                success: function(response){
                    $('#name').val(response);
                }
            }); 
         });

        /*

        $('#submit').keyup(function(){


        }); 

        */

        /*

        $('#sum').on('click', function(){
            $sumador = $sumador + 1; 
            $('#quantity').attr('value', $sumador);  
        }); 

        $('#res').on('click',function(){ 
                $sumador = $sumador - 1; 
                if($('#quantity').attr('value') == 0) 
                {
                    $sumador = 0;
                    $('#quantity').attr('value', $sumador);
                }
                else
                {
                    $('#quantity').attr('value', $sumador); 
                }      
            
        })

        */
        
        $('#myTable').DataTable();
        
    });
 </script>

@endsection 




@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div> 
                    <a href="/sales">
                        <button  class="btn btn-sm btn-primary"  style="float:left; margin-right: 15px; margin-bottom: 0px;"> Back
                            

                        </button>
                    </a>

                    <a href="/sales/{{$sale->id}}/products_sales/create">
                    
                        <button  class="btn btn-sm btn-success" style="float:right; margin-right: 0px; margin-bottom: 0px;"> + New
                            

                        </button>
                    </a>
                </div>
                <div class="card-header">Product Sales</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="text-right"> 
                   <!--buttoms-->

                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>Sale</td>
                            <td>Product</td>
                            <td>Quantity</td>
                            <td>Amount</td>
                            <td>Actions</td>
                      
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($products_sales as $product_sale)
                        
                            <tr>
                                <td>{{ $product_sale->sale->id }}</td>
                                <td>{{ $product_sale->product->name }}</td>
                                <td>{{ $product_sale->quantity }}</td>
                                <td>{{ $product_sale->amount }} </td>
                           

                                <td><a href="/sales/{{$product_sale->sale->id}}/products_sales/{{$product_sale->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                              
                                    {!! Form::open(
                                        ['url'=> '/sales/'.$product_sale->sale->id.'/products_sales/'.$product_sale->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete user")', 'style' => 'float:left'])!!}


            
                                 
                                    {!! Form::submit('Delete',['class'=>'btn btn-sm btn-danger'])!!}
                                    {!! Form::close()!!}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript"> 
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
 </script>

@endsection 


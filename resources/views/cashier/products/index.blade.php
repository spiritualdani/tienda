@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <!--

                <div class="text-right"> 
                    <a href="{{ url('products/create') }}">
                        <button  class="btn btn-sm btn-success"> + New
                            

                        </button>
                    </a>

                </div>
                -->
                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Description</td>
                            <td>Quantity</td>
                            <td>Prize</td>
                            <td>Category</td>
                            <td>Picture</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product-> prize }} </td>
                                <td>{{ $product-> category->name }}</td>
                                
                                <td>
                                    @if($product->picture !='')
                                    <img src="{{asset('img/products/'.$product->picture)}}" width="50px"><br>
                                    @endif()

                                </td>

                                <!--

                                <td><a href="/products/{{$product->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/products/'.$product->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete user")', 'style' => 'float:left'])!!}

                                    {!! Form::submit('Delete',['class'=>'btn btn-sm btn-danger'])!!}
                                    {!! Form::close()!!}

                                </td>
                            -->

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


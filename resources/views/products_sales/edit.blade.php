@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products Sales / New</div>

                <div class="card-body">
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

               

                {!! Form::model($product_sale,
                    ['url'=>'sales/'.$product_sale->sale_id.'/products_sales/'.$product_sale->id, 'method'=>'PUT', 'files'=>true]) !!}

                 <label>Sale:</label>
                {!! Form::text('sale_id', $product_sale->sale_id, null,['class' => 
                'form-control', 'required' => 'required']) !!}  
                <br>
                <label>Product:</label>
                {!! Form::select('product_id',$products, null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Quantity:</label>
                {!! Form::number('quantity', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Amount:</label>
                {!! Form::number('amount', null,['class' => 'form-control', 'required' => 'required']) !!}  

                <div class="text-center">
                {!! Form::submit('Save', ['class'=>'btn btn-sm btn-success']) !!}                    
                </div>
                {!! Form::close() !!}        


                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products_Sales / New</div>

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


                {!! Form::open(['url' => 'sales/'.$sale->id.'/products_sales', 'files'=>true])!!}   
                
                <label>Sale:</label>
                {!! Form::text('sale_id', $sale->id, null,['class' => 
                'form-control', 'required' => 'required']) !!}  
                <br>
                <label>Product:</label>
                {!! Form::select('product_id',$products, null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Quantity:</label>
                {!! Form::number('quantity',null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Amount:</label>
                {!! Form::number('amount', null,['class' => 'form-control', 'disabled' => 'disabled']) !!}  

            
                <div class="text-center"></div>
                    {!! Form::submit('Save', ['class'=> 'btn btn-sm btn-success'])!!}
                    
                {!! Form::close()!!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

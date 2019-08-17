@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products / New</div>

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


                {!! Form::open(['url' => 'products', 'files'=>true])!!}   


                <label>Category:</label>
                {!! Form::select('category_id', $categories, null,['class' => 
                'form-control', 'required' => 'required']) !!}  

                <label>Name:</label>
                {!! Form::text('name', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Description:</label>
                {!! Form::text('description', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Quantity:</label>
                {!! Form::number('quantity', null,['class' => 'form-control', 'required' => 'required']) !!}  

                <label>Prize:</label>
                {!! Form::number('prize', null,['class' => 'form-control', 'required' => 'required', 'step' => 'any']) !!}  

                <label>Picture: </label>
                <input type="file" name="file" class="form-control">

            
                <div class="text-center"></div>
                    {!! Form::submit('Save', ['class'=> 'btn btn-sm btn-success'])!!}
                    
                {!! Form::close()!!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

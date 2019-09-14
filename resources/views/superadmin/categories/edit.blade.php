@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categories / New</div>

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


                    {!! Form::model($category, ['url' => 'categories/'.$category->id, 'method' => 'PUT'])!!}   
                    
                    <label>Name:</label>
                    {!! Form::text('name', null,['class' => 'form-control', 'required' => 'required']) !!}

                    <div class="text-center"></div>
                        {!! Form::submit('Save', ['class'=> 'btn btn-sm btn-success'])!!}
                    {!! Form::close()!!}
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

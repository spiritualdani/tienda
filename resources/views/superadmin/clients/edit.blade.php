@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Clients / New</div>

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

                {!! Form::model($client,
                    ['url'=>'users/'.$client->user_id.'/clients/'.$client->id, 'method'=>'PUT', 'files'=>true]) !!}


                <label>User:</label>
                {!! Form::text('user_id', $user->id, null,['class' => 
                'form-control', 'required' => 'required']) !!}  
                <br>
                <label>Name:</label>
                {!! Form::text('name', null,['class' => 'form-control', 'required' => 'required']) !!}
                
                <label>CI:</label>
                {!! Form::text('ci', null,['class' => 'form-control', 'required' => 'required']) !!}  

                    
                <label>Phone:</label>
                {!! Form::text('phone', null,['class' => 'form-control', 'required' => 'required']) !!}  

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



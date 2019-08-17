@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rols / New</div>

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

                
                {!! Form::model($user,['url'=>'users/'.$user->id, 'method'=>'PUT', 'files'=>true]) !!}
                        
                <label>Rol:</label>
                {!! Form::select('rol_id',$rols,null,['class'=>'form-control', 'required'=>'required']) !!}

                <label>Name:</label>
                {!! Form::text('name', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>Username:</label>
                {!! Form::text('username', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>CI:</label>
                {!! Form::text('ci', null,['class' => 'form-control', 'required' => 'required']) !!}  

                <label>Phone:</label>
                {!! Form::text('phone', null,['class' => 'form-control', 'required' => 'required']) !!}  

                <label>Email:</label>
                {!! Form::email('email', null,['class' => 'form-control','required' => 'required']) !!}
                
                <label>Password:</label>
                <input type="password" name="password" class="form-control" required>

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



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sales / New</div>

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


                {!! Form::open(['url' => 'sales', 'files'=>true])!!}   


                <label>User:</label>
                {!! Form::select('user_id', $users, null,['class' => 
                'form-control', 'required' => 'required']) !!}  


               


                <label>Client:</label>
                {!! Form::select('client_id', $clients, null,['class' => 
                'form-control', 'required' => 'required', 'placeholder' => 'take a client']) !!}  
                <!--

                <label>Name:</label>
                {!! Form::text('name', null,['class' => 'form-control', 'required' => 'required']) !!}

                <label>CI:</label>
                {!! Form::text('ci', null,['class' => 'form-control', 'required' => 'required']) !!}  

                <label>Phone:</label>
                {!! Form::text('phone', null,['class' => 'form-control', 'required' => 'required']) !!}  
               

                -->


                <label>Description:</label>
                {!! Form::textarea('description', null,['class' => 'form-control', 'required' => 'required']) !!}   
                
                <!--
                <label>Total amount:</label>
                {!! Form::number('total_amount', null,['class' => 'form-control', 'required' => 'required']) !!}  -->
 
                <div class="text-center"></div>
                    {!! Form::submit('Save', ['class'=> 'btn btn-sm btn-success'])!!}
                    
                {!! Form::close()!!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

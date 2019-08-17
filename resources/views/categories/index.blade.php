@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categorias</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-right">
                        <a href="{{ url('categorias/create')}}">
                           <button class="btn btn-sm btn-success"> + Nuevo
                           </button>     


                        </a>            
                
                    </div>

                        <!-- <a href="/roles/create">+ Nuevo</a>    -->

                    <table class="table 
                    table-striped
                    table-bordered">
                        <thead>
                            <tr>
                                <td>Nombres</td>
                         
                            </tr>
                        </thead>   
                        <tbody>
                            @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria-> nombre}}</td>
                                  
                                    <td><a href="/categorias/{{$categoria->id}}/edit">
                                        <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Editar</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/categorias/'.$categoria->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Desea eliminar la categoria")', 'style' => 'float:left'])!!}

                                    {!! Form::submit('Eliminar',['class'=>'btn btn-sm btn-danger'])!!}
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
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="text-right">
                        <a href="{{ url('categories/create')}}">
                           <button class="btn btn-sm btn-success"> + New
                           </button>     
                        </a>            
                    </div>

                        <!-- <a href="/roles/create">+ Nuevo</a>    -->

                    <table class="table 
                    table-striped
                    table-bordered">
                        <thead>
                            <tr>
                                <td>Name</td>
                         
                            </tr>
                        </thead>   
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category-> name}}</td>
                                  
                                    <td><a href="/categories/{{$category->id}}/edit">
                                        <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/categories/'.$category->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete this category")', 'style' => 'float:left'])!!}

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
</div>
@endsection

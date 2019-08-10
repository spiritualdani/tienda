@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rols</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="text-right"> 
                    <a href="{{ url('rols/create') }}">
                        <button  class="btn btn-sm btn-success"> + New
                            

                        </button>
                    </a>

                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>Names</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rols as $rol)
                            <tr>
                                <td>{{ $rol->name }}</td>
                                <td><a href="/rols/{{$rol->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/rols/'.$rol->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete rol")', 'style' => 'float:left'])!!}

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
@endsection

@section('scripts')

<script type="text/javascript"> 
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
 </script>

@endsection 


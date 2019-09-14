@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="text-right"> 
                    <a href="{{ url('users/create') }}">
                        <button  class="btn btn-sm btn-success"> + New
                            

                        </button>
                    </a>

                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>CI</td>
                            <td>Phone</td>
                            <td>Email</td>
                            <td>Username</td>
                            <td>Rol</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->ci }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user-> email }} </td>
                                <td>{{ $user-> rol->name }}</td>


                                <td><a href="/users/{{$user->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/users/'.$user->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete user")', 'style' => 'float:left'])!!}

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


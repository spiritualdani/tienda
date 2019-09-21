@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Clients</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="text-right"> 
                    <a href="/users/{{$user->id}}/clients/create">
                        <button  class="btn btn-sm btn-success"> + New
                            

                        </button>
                    </a>


                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>User</td>
                            <td>Name</td>
                            <td>CI</td>
                            <td>Phone</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->user->name}}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->ci }}</td>
                                <td>{{ $client->phone }}</td>
                           
    


                                <td><a href="/users/{{$client->user->id}}/clients/{{$client->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/users/'.$client->user->id.'/clients/'.$client->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete client")', 'style' => 'float:left'])!!}
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


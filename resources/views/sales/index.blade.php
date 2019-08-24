@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Sales</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="text-right"> 
                    <a href="{{ url('sales/create') }}">
                        <button  class="btn btn-sm btn-success"> + New
                            

                        </button>
                    </a>

                </div>

                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>User</td>
                            <!--<td>CI</td>-->  
                            <td>Description</td>
                            <td>Total Amount</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->user->id}}</td>
                                <!--<td>{{ $sale->user->ci}}</td>-->
                                <td>{{ $sale->description }}</td>
                                <td>{{ $sale->total_amount }}</td>
                               
                                <td><a href="/sales/{{$sale->id}}/edit">
                                    <button class="btn btn-sm btn-warning" style="float:left; margin-right: 15px;">Edit</button>
                                    </a>
                                    
                                    {!! Form::open(['url'=> '/sales/'.$sale->id, 'method'=> 'DELETE', 'onsubmit'  =>' return confirm("Are you sure to delete sale")', 'style' => 'float:left'])!!}

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


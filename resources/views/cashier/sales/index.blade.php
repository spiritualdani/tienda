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
                <!--
                <div class="text-right"> 
                    <a href="{{ url('sales/create') }}">
                        <button  class="btn btn-sm btn-success" style="float:right; margin-right: 0px; margin-bottom: 25px;"> + New
                            

                        </button>
                    </a>

                </div>
                -->
                <table class="table table-striped table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <td>User</td>
                            <td>Client</td>
                            <!--<td>CI</td>-->  
                            <td>Description</td>
                            <td>Total Amount</td>

                        
                            <td>Actions</td>
                         
                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count_total = 0; 
                        ?> 

                        @foreach($sales as $sale)
                            <tr>
                                <td>{{ $sale->user->name}}</td>
                                <!--<td>{{ $sale->user->ci}}</td>-->
                                <td> 
                                
                                @if($sale->client)        
                                    {{  $sale->client->name }}
                                
                                @else
                                    -
                                @endif

                                </td>
                                <td>{{ $sale->description }}</td>
                                <td>{{ $sale->total_amount }}</td>
                                
                                <td>
                                    <a href="/cashier/sales/{{$sale->id}}/sales_products">
                                    <button class="btn btn-sm btn-info" style="float:left; margin-right: 15px;">Product Sale</button>
                                    </a>
                                </td>
                                
                            </tr>

                            <?php
                                $count_total = $count_total + $sale->total_amount; 
                            ?>

                        @endforeach

                    </tbody>

                    <tfoot>

                        <tr >
                            <td colspan="3" class="text-left; font-weight-bold">TOTAL: </td>
                            <!--<td>CI</td>-->  
                            <td  class="text-right font-weight-bold" >{{$count_total}}</td>
                            <td></td>

                        </tr>

                    </tfoot>
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


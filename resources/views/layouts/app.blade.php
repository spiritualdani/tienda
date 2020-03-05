@extends('inspinia::layouts.main')

@if (auth()->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm')
@section('user-name', auth()->user()->name)
@endif

@section('breadcrumbs')
@include('inspinia::layouts.main-panel.breadcrumbs', [
  'breadcrumbs' => [
    (object) [ 'title' => 'Home', 'url' => route('home') ]
  ]
])
@endsection

@section('sidebar-menu')
  <ul class="nav metismenu" id="side-menu" style="padding-left:0px;">
    <li class="active">
      <a href="{{ route('home') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
    </li>
    <li class="active">
    	<a href="{{ url('rols') }}"><i class="fa fa-gears"></i><span class="nav-label">Rols</span></a>	
    </li>

    <li class="active">
    	<a href="{{ url('users') }}"><i class="fa fa-user"></i><span class="nav-label">Users</span></a>	
    </li>

    <li class="active">
    	<a href="{{ url('categories') }}"><i class="fa fa-th-large"></i><span class="nav-label">Categories</span></a>	
    </li>

    <li class="active">
    	<a href="{{ url('products') }}"><i class="fa fa-archive"></i><span class="nav-label">Products</span></a>	
    </li>

    <li class="active">
    	<a href="{{ url('sales') }}"><i class="fa fa-opencart"></i><span class="nav-label">Sales</span></a>	
    </li>

    <li class="active">
    	<a href="{{ url('reports') }}"><i class="fa fa-calendar-check-o"></i><span class="nav-label">Reports</span></a>	
    </li>

  </ul>
@endsection

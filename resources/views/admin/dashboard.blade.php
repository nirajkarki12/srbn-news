@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content-header', 'Dashboard')

@section('breadcrumb')
    <li class="active"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-10">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Dashboard</h3>
        </div>

      </div>
    </div>
  </div>
@endsection

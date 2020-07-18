@extends('layouts.admin')

@section('title', 'Predictions')

@section('content-header', 'List of Predictions')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.prediction')}}"><i class="fa fa-folder-o"></i> Predictions</a></li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Predictions</h3>
            <div class="box-tools pull-right">
	            	<a href="{{route('admin.prediction.create')}}" class="btn pull-right" title="Add a Category">
            			<span class="fa fa-plus"></span>
            		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($predictions) > 0)

          	<table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th >Zodiac/Horoscope Sign</th>
                        <th >Data</th>
                        <th >Type</th>
                        <th >Date/Start Date</th>
                        <th >Rating</th>
                        <th class="text-center" width="11%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($predictions as $key => $predict)
                    <tr>
                        <td style="vertical-align:middle">{{ $predictions->firstItem() + $key }}</td>
                        <td style="vertical-align:middle">{{ $predict->horoscope->name }}</td>
                        <td style="vertical-align:middle">{{ $predict->data }}</td>
                        <td style="vertical-align:middle">{{$predict->type}}</td>
                        <td style="vertical-align:middle">{{\Carbon\Carbon::parse($predict->prediction_date)->format('d M Y')}}</td>
                        <td style="vertical-align:middle">{{$predict->rating.' stars'}}</td>


                        <td style="vertical-align:middle" class="text-center">
                            <a href="{{route('admin.prediction.create' , $predict)}}" title="Edit a Prediction">
                                <span class="fa fa-pencil-square-o fa-lg"></span>
                            </a>
                            &nbsp;
                            <a href="{{route('admin.prediction.delete' , $predict)}}" title="Delete a Prediction" onclick="return confirm('Are you sure?')">
                                <span class="fa fa-times fa-lg"></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$predictions->links()}}
            @else
                <h3 class="no-result">No results found</h3>
            @endif
        </div>
      </div>
    </div>
  </div>

@endsection
<!-- $attribute->created_at->format(Setting::get('date_format', 'j F, Y') .' ' .Setting::get('time_format', 'H:i')) -->

@section('scripts')

@endsection

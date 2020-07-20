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
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                @php
                    $lang = isset($_REQUEST) && array_key_exists('lang', $_REQUEST) ? : 'selected';
                @endphp
                <div class="box-body">
                    <form role="form" method="get" action="{{route('admin.prediction')}}">
                        <div class="box-body">
                            <div class="form-group col-sm-4">
                                <label for="prediction_date">Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="prediction_date" name="prediction_date" value="{!! isset($_REQUEST) && array_key_exists('prediction_date', $_REQUEST) ? $_REQUEST['prediction_date'] : \Carbon\Carbon::today()->format('Y-m-d') !!}" required placeholder="Prediction Date">
                                    </div>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="lang">Type</label>
                                <select name="lang" id="lang" class="form-control" required>
                                    <option value="ne" {!! isset($_REQUEST) && array_key_exists('lang', $_REQUEST) && $_REQUEST['lang'] == 'ne' ? 'selected' : '' !!}>रशिफल</option>
                                    <option value="en" {!! isset($_REQUEST) && array_key_exists('lang', $_REQUEST) && $_REQUEST['lang'] == 'en' ? 'selected' : '' !!}>Zodiac</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="type">Timeline Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="daily" {!! isset($_REQUEST) && array_key_exists('type', $_REQUEST) && $_REQUEST['type'] == 'daily' ? 'selected' : '' !!}>Daily</option>
                                    <option value="weekly" {!! isset($_REQUEST) && array_key_exists('type', $_REQUEST) && $_REQUEST['type'] == 'weekly' ? 'selected' : '' !!}>Weekly</option>
                                    <option value="monthly" {!! isset($_REQUEST) && array_key_exists('type', $_REQUEST) && $_REQUEST['type'] == 'monthly' ? 'selected' : '' !!}>Monthly</option>
                                    <option value="yearly" {!! isset($_REQUEST) && array_key_exists('type', $_REQUEST) && $_REQUEST['type'] == 'yearly' ? 'selected' : '' !!}>Yearly</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            &nbsp;
                            <button type="reset" class="btn btn-default">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box -->
        </div>
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
                        <th >Name</th>
                        <th width="50%">Data</th>
                        <th >Timeline</th>
                        <th >Start Date</th>
                        <th >End Date</th>
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
                        <td style="vertical-align:middle">{{\Carbon\Carbon::parse($predict->start_date)->format(Setting::get('date_format', 'j F, Y'))}}</td>
                        <td style="vertical-align:middle">{{\Carbon\Carbon::parse($predict->end_date)->format(Setting::get('date_format', 'j F, Y'))}}</td>
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
@section('scripts')
    <script type="text/javascript">
        $(function () {
            $('#prediction_date').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                todayHighlight: true,
            });

        });

    </script>
@endsection

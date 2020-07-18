@extends('layouts.admin')

@section('title', 'Adgroup')

@section('content-header', 'Adgroup')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.adgroup')}}"><i class="fa fa-picture-o"></i> Adgroup</a></li>
@endsection

@section('content')
<style type="text/css">
   td p{
      margin: 5px 0 0;
   }
</style>
@include('notification.notify')
<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Adgroup</h3>
            <div class="box-tools pull-right">
            	<a href="{{route('admin.adgroup.create')}}" class="btn pull-right" title="Add a Ads">
         			<span class="fa fa-plus"></span>
         		</a>
            </div>
        </div>
        <div class="box-body table-responsive">

        	@if(count($adgroups) > 0)

          	<table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="4%">#</th>
                        <th>Title</th>
                        <th>Show After</th>
                        <th>Total Ads</th>
                        <th>Publish Date</th>
                        <th>Expiry Date</th>
                        <th class="text-center" width="11%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($adgroups as $key => $adgroup)
                        <tr>
                            <td style="vertical-align:middle">{{ $adgroups->firstItem() + $key }}</td>
                            <td style="vertical-align:middle">{{ $adgroup->title }}</td>
                            <td style="vertical-align:middle">{{ $adgroup->show_after }} Scroll</td>
                            <td style="vertical-align:middle">{{ count($adgroup->ads) }}</td>
                            <td style="vertical-align:middle">{{ $adgroup->publish_date ? $adgroup->publish_date->format(Setting::get('date_format', 'j F, Y')) : '-' }}</td>
                            <td style="vertical-align:middle">{{ $adgroup->expiry_date ? $adgroup->expiry_date->format(Setting::get('date_format', 'j F, Y')) : '-' }}</td>
                            <td style="vertical-align:middle" class="text-center">
                                <a href="{{route('admin.adgroup.edit' , array('adgroup' => $adgroup->id, 'page' => $adgroups->currentPage()))}}" title="Edit a Adgroup">
                                    <span class="fa fa-pencil-square-o fa-lg"></span>
                                </a>
                                &nbsp;
                                <a href="{{route('admin.adgroup.destroy' , array('adgroup' => $adgroup->id, 'page' => $adgroups->currentPage()))}}" title="Delete a Adgroup" onclick="return confirm('Are you sure?')">
                                    <span class="fa fa-times fa-lg"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $adgroups->links() }}
            @else
                <h3 class="no-result">No results found</h3>
            @endif
        </div>
      </div>
    </div>
  </div>

@endsection

@extends('layouts.admin')

@section('title', 'Meme')

@section('content-header', 'List of Meme')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.meme')}}"><i class="fa fa-folder-o"></i> Meme</a></li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Memes</h3>
            <div class="box-tools pull-right">
	            	<a href="{{route('admin.meme.create')}}" class="btn pull-right" title="Add a Meme">
            			<span class="fa fa-plus"></span>
            		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($memes) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th>Image</th>
						      <th>Source</th>
						      <th>Like Count</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($memes as $key => $meme)
							    <tr>
                                    <td>
                                        {{$memes->firstItem()+$key}}
                                    </td>

                                    <td style="vertical-align:middle">
                                        @if($meme->image)
                                            <img src="{{ $meme->image }}" class="img-responsive" style="height:100px;">
                                        @endif
                                    </td>
                                    <td>{{$meme->source}}</td>
                                    <td>{{$meme->likes->count()}}</td>
                                    <td style="vertical-align:middle" class="text-center">
                                        <a href="{{route('admin.meme.create' , $meme)}}" title="Edit a Meme">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </a>
                                        &nbsp;
                                        <a href="{{route('admin.meme.delete' , $meme)}}" title="Delete a Meme" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $memes->links() }}
					@else
						<h3 class="no-result">No results found</h3>
					@endif
        </div>
      </div>
    </div>
  </div>

@endsection

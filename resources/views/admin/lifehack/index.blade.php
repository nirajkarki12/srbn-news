@extends('layouts.admin')

@section('title', 'Life Hacks')

@section('content-header', 'List of Life Hacks')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.lifehack')}}"><i class="fa fa-folder-o"></i> Life Hacks</a></li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Life Hacks</h3>
            <div class="box-tools pull-right">
	            	<a href="{{route('admin.lifehack.create')}}" class="btn pull-right" title="Add a Category">
            			<span class="fa fa-plus"></span>
            		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($lifehacks) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th width="30%">Content English</th>
						      <th width="30%">Content Nepali</th>
						      <th width="30%">Like Count</th>
						      <th>Images</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($lifehacks as $key => $lifehack)
							    <tr>
                                    <td style="vertical-align:middle">{{ $lifehacks->firstItem() + $key }}</td>
                                    <td style="vertical-align:middle">{{ $lifehack->content?:'-----' }}</td>
                                    <td style="vertical-align:middle">{{ $lifehack->translation?$lifehack->translation->content:'----' }}</td>
                                    <td style="vertical-align:middle">{{ $lifehack->likes->count() }}</td>
                                    <td style="vertical-align:middle">
                                        @if($lifehack->image)
                                            <img src="{{ $lifehack->image }}" class="img-responsive" style="width:120px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                            
                                    
                                    <td style="vertical-align:middle" class="text-center">
                                        <a href="{{route('admin.lifehack.create' , $lifehack)}}" title="Edit a Life Hack">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </a>
                                        &nbsp;
                                        <a href="{{route('admin.lifehack.delete' , $lifehack)}}" title="Delete a Life Hack" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $lifehacks->links() }}
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
<script type="text/javascript">
   $(function () {
     	$('.read-more').click(function(e) {
   		  e.preventDefault();
   		  $(this).text(function(i, t) {
   		    return t == 'close' ? 'more' : 'close';
   		  }).prev('.full-description').slideToggle()
   		});

   });

</script>
@endsection
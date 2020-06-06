@extends('layouts.admin')

@section('title', 'Horoscopes/Zodiacs')

@section('content-header', 'List of Horoscopes/Zodiacs')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.horoscope')}}"><i class="fa fa-folder-o"></i> Horoscopes/Zodiacs</a></li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">List of Horoscopes/Zodiacs</h3>
            <div class="box-tools pull-right">
	            	<a href="{{route('admin.horoscope.create')}}" class="btn pull-right" title="Add a Category">
            			<span class="fa fa-plus"></span>
            		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($horoscopes) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th >Nepali</th>
						      <th >English</th>
						      <th >Info Nepali</th>
						      <th >Info English</th>
						      <th >Order</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($horoscopes as $key => $horo)
							    <tr>
                                    <td style="vertical-align:middle">{{ $key+1 }}</td>
                                    <td style="vertical-align:middle">
                                        <img src="{{$horo->image_nepali}}" alt="image" style="height:35px">
                                        {{ $horo->name_nepali }}
                                    </td>
                                    <td style="vertical-align:middle">
                                        <img src="{{$horo->image_english}}" alt="image" style="height:35px">
                                        {{ $horo->name_english }}
                                    </td>
                                    <td style="vertical-align:middle">{{$horo->info_nepali}}</td>
                                    <td style="vertical-align:middle">{{$horo->info_english}}</td>
                                    <td style="vertical-align:middle">{{$horo->order}}</td>
                            
                                    
                                    <td style="vertical-align:middle" class="text-center">
                                        <a href="{{route('admin.horoscope.create' , $horo)}}" title="Edit a Horoscope">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </a>
                                        &nbsp;
                                        <a href="{{route('admin.horoscope.delete' , $horo)}}" title="Delete a Horoscope" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
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
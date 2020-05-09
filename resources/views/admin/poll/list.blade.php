@extends('layouts.admin')

@section('title', 'Polls')

@section('content-header', 'Polls')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.poll')}}"><i class="fa fa-bar-chart"></i> Polls</a></li>
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
            <h3 class="box-title">List of Polls</h3>
            <div class="box-tools pull-right">
            	<a href="{{route('admin.poll.create')}}" class="btn pull-right" title="Add a Poll">
         			<span class="fa fa-plus"></span>
         		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($polls) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th>Title</th>
                        <th>Type</th>
						      <th>Description</th>
                        <th width="14%">Poll</th>
						      <th>Status</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($polls as $key => $poll)
							    <tr>
						      	<td style="vertical-align:middle">{{ $polls->firstItem() + $key }}</td>
						      	<td style="vertical-align:middle">{{ $poll->title }}</td>
                           <td style="vertical-align:middle">
                              @if($poll->type && array_key_exists($poll->type, \App\Models\Post::$postTypes)) 
                                 <p class="text-info" title="
                                    <img src='{{ $poll->content }}'>
                                    ">
                                    {{ \App\Models\Post::$postTypes[$poll->type] }}
                                 </p>
                              @endif
                           </td>
						      	<td style="vertical-align:middle" class="minimize text-justify">{!! $poll->description ?: '-' !!}</td>
                           <td style="vertical-align:middle">
                              <p>
                                 {{ $poll->question }}
                                 @if($poll->options && count($poll->options) > 0)
                                    <ol style="padding:0;list-style-position: inside;">
                                       @foreach($poll->options as $option)
                                          <li class="text-muted">{{ $option->value }}</li>
                                       @endforeach
                                    </ol>
                                 @else
                                 <br />
                                    <em class="text-muted">no options</em>
                                 @endif
                              </p>
                           </td>
						      	<td style="vertical-align:middle">{{ $poll->status ? 'Published' : 'Unpublished' }}</td>
							      <td style="vertical-align:middle" class="text-center">
           							<a href="{{route('admin.poll.edit' , array('slug' => $poll->slug, 'page' => $polls->currentPage()))}}" title="Edit a Poll">
                                   <span class="fa fa-pencil-square-o fa-lg"></span>
                               </a>
                               &nbsp;
                               <a href="{{route('admin.poll.destroy' , array('slug' => $poll->slug, 'page' => $polls->currentPage()))}}" title="Delete a Poll" onclick="return confirm('Are you sure?')">
                                 <span class="fa fa-times fa-lg"></span>
                               </a>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $polls->links() }}
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
      var minimized_elements = $('.minimize');
    
      minimized_elements.each(function(){    
         var t = $(this).text();        
         if(t.length < 220) return;

         $(this).html(
            t.slice(0, 220) + '<span>... </span><a href="javascript:void(0)" class="more">Read more&raquo;&raquo;</a>'+
            '<p style="display:none;">'+ t.slice(220, t.length) + '<br /> <a href="javascript:void(0)" class="less">&raquo;Show less&laquo;</a></p>'
         );
           
       }); 
       
       $('a.more', minimized_elements).click(function(event){
           event.preventDefault();
           $(this).hide().prev().hide();
           $(this).next().show();        
       });
       
       $('a.less', minimized_elements).click(function(event){
           event.preventDefault();
           $(this).parent().hide().prev().show().prev().show();    
       });
   });

</script>
@endsection
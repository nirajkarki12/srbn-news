@extends('layouts.admin')

@section('title', 'Posts')

@section('content-header', 'Posts')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><a href="{{route('admin.post')}}"><i class="fa fa-newspaper-o"></i> Posts</a></li>
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
            <h3 class="box-title">List of Posts</h3>
            <div class="box-tools pull-right">
            	<a href="{{route('admin.post.create')}}" class="btn pull-right" title="Add a Post">
         			<span class="fa fa-plus"></span>
         		</a>
            </div>
        </div>
        <div class="box-body">

        	@if(count($posts) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th>Title</th>
                        <th>Type</th>
						      <th width="30%">Description</th>
						      <th>Note</th>
                        <th>Source</th>
                        <th>Categories</th>
						      <th>Status</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($posts as $key => $post)
							    <tr>
						      	<td style="vertical-align:middle">{{ $posts->firstItem() + $key }}</td>
						      	<td style="vertical-align:middle">{{ $post->title }}</td>
                           <td style="vertical-align:middle">
                              @if($post->type && array_key_exists($post->type, \App\Models\Post::$postTypes)) 
                                 <p class="text-info" title="{{ $post->content }}">
                                    {{ \App\Models\Post::$postTypes[$post->type] }}
                                 </p>
                              @endif
                           </td>
						      	<td style="vertical-align:middle" class="minimize text-justify">{!! $post->description ?: '-' !!}</td>
                           <td style="vertical-align:middle">
                              <p class="text-muted">
                                 {{ $post->note ?: '-' }}
                              </p>
                           </td>
                           <td style="vertical-align:middle">
                              @if($post->source)
                                 <a href="{{ $post->source_url }}" target="_new" title="{{ $post->source }}">{{ $post->source }}</a>
                              @else
                                 -
                              @endif
                           </td>
                           <td style="vertical-align:middle">
                              <ol style="padding-left: 15px" class="limit-li">
                                 @if($post->categories && count($post->categories) > 0)
                                    @foreach($post->categories as $cat)
                                       <li>{{ $cat->name }}</li>
                                    @endforeach
                                 @else
                                    -
                                 @endif
                              </ol>
                              <a href="javascript:void(0)" class="show_less" style="display:none"><i>Show less</i></a>
                           </td>
						      	<td style="vertical-align:middle">{{ $post->status ? 'Published' : 'Unpublished' }}</td>
							      <td style="vertical-align:middle" class="text-center">
           							<a href="{{route('admin.post.edit' , array('slug' => $post->slug, 'page' => $posts->currentPage()))}}" title="Edit a Post">
                                   <span class="fa fa-pencil-square-o fa-lg"></span>
                               </a>
                               &nbsp;
                               <a href="{{route('admin.post.destroy' , array('slug' => $post->slug, 'page' => $posts->currentPage()))}}" title="Delete a Post" onclick="return confirm('Are you sure?')">
                                 <span class="fa fa-times fa-lg"></span>
                               </a>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $posts->links() }}
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
     	var max = 3

      $('ol.limit-li').each(function(){
        if ($(this).find("li").length > max) {
          $(this)
            .find('li:gt('+max+')')
            .hide()
            .end()
            .append(
              $('<li><a href="javascript:void(0)"><i>Show More...</i></a></li>').click( function(){
                  $(this).closest('td').find('.show_less').css('display', 'block');
                $(this).siblings(':hidden').show().end().remove();
              })
          );
        }
      });

      $('.show_less').click(function() {
         $(this).css('display', 'none');

         $(this).closest('td').find('ol.limit-li').each(function(){
           if ($(this).find("li").length > max) {
             $(this)
               .find('li:gt('+max+')')
               .hide()
               .end()
               .append(
                 $('<li><a href="javascript:void(0)"><i>Show More...</i></a></li>').click( function(){
                     $(this).closest('td').find('.show_less').css('display', 'block');
                   $(this).siblings(':hidden').show().end().remove();
                 })
             );
           }
         });
      });

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
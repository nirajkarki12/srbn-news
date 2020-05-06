@extends('layouts.admin')

@section('title', 'Categories')

@section('content-header')
{{ $parentCategory ? "{$parentCategory->name}'s Categories" : 'List of Categories' }}
@stop

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="{{ $parentCategory ?: 'active' }}"><a href="{{route('admin.category')}}"><i class="fa fa-folder-o"></i> Categories</a></li>
	@if($parentCategory)
		<li class="active"><i class="fa fa-folder-o"></i> {{ $parentCategory->name }}</li>
	@endif
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{ $parentCategory ? 'List of ' .$parentCategory->name ."'s Category" : 'List of Categories' }}</h3>
            <div class="box-tools pull-right">
							@if($parentCategory)
            		<a href="{{route('admin.category.createSubCategory', array('categorySlug' => $parentCategory->slug))}}" class="btn pull-right" title="Add a Category">
            			<span class="fa fa-plus"></span>
            		</a>

            	@else
	            	<a href="{{route('admin.category.create')}}" class="btn pull-right" title="Add a Category">
            			<span class="fa fa-plus"></span>
            		</a>
							@endif
            </div>
        </div>
        <div class="box-body">

        	@if(count($categories) > 0)

          	<table id="example1" class="table table-bordered table-striped">
							<thead>
						    <tr>
						      <th width="4%">#</th>
						      <th>Name</th>
						      <th width="30%">Description</th>
						      <th>Images</th>
						      <th>Status</th>
						      <th class="text-center" width="11%">Action</th>
						    </tr>
							</thead>

							<tbody>
								@foreach($categories as $key => $category)
							    <tr>
						      	<td style="vertical-align:middle">{{ $categories->firstItem() + $key }}</td>
						      	<td style="vertical-align:middle">
                              @if($category->childs && count($category->childs) > 0)
                         	       <a href="{{ route('admin.category' , array('parentSlug' => $category->slug))}}" title='{{ "List {$category->name}'s Sub Categories" }}'>
   				      				    {{ $category->name }}
   					      			</a>
                              @else
   					      			{{ $category->name }}
   					      		@endif
						      	</td>
						      	<td style="vertical-align:middle" class="text-justify">
					      			{!! $category->description ?: '-' !!}
						      	</td>
						      	<td style="vertical-align:middle">
						      		@if($category->image)
						      			<img src="{{ $category->image }}" class="img-responsive" style="width:120px;">
						      		@else
						      			-
						      		@endif
						      	</td>
                           
						      	<td style="vertical-align:middle">{{ $category->status ? 'Enabled' : 'Disabled' }}</td>
							      <td style="vertical-align:middle" class="text-center">
							      	 <a href="{{route('admin.category.createSubCategory' , array('categorySlug' => $category->slug))}}" title='{{ "Add Sub Category of {$category->name}" }}'>
                                 <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                               </a>
                               @if($category->childs && count($category->childs) > 0)
                               &nbsp;
                               <a href="{{route('admin.category' , array('parentSlug' => $category->slug))}}" title='{{ "List {$category->name}'s Sub Categories" }}'>
                                   <i class="fa fa-arrow-right fa-lg" aria-hidden="true"></i>
                               </a>
                               @endif
                               &nbsp;
                 							<a href="{{route('admin.category.edit' , array('slug' => $category->slug, 'page' => $categories->currentPage()))}}" title="Edit a Category">
                                   <span class="fa fa-pencil-square-o fa-lg"></span>
                               </a>
                               &nbsp;
                               <a href="{{route('admin.category.destroy' , array('slug' => $category->slug, 'page' => $categories->currentPage()))}}" title="Delete a Category" onclick="return confirm('Are you sure?')">
                                   <span class="fa fa-times fa-lg"></span>
                               </a>
							      </td>
							    </tr>
								@endforeach
							</tbody>
						</table>
						{{ $categories->links() }}
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
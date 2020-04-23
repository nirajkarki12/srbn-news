@extends('layouts.admin')

@section('title', 'Add a Post')

@section('content-header', 'Add a Post')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.post')}}"><i class="fa fa-newspaper-o"></i> Posts</a></li>
    <li class="active"><i class="fa fa-plus"></i> Add a Post</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Add a Post</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.post')}}" class="btn btn-default pull-right">Posts</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title" class=" control-label">Title</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"  placeholder="Post Title" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="category" class="control-label">Post Category</label>
              </div>
              <div class="col-sm-9 pull-left">
               @php
                  $selectedId = old('category') ?: [];
                @endphp
                <select class="form-control" id="category" name="category[]" multiple="multiple" required>
                  {!! $controller->printCategoryTree($arrCategory, $selectedId) !!}
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="description" class=" control-label">Description</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="description" name="description" rows="3" cols="80" required>{{ old('description') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image_file" class=" control-label">Image</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_file" name="image_file" required>
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="source" class=" control-label">Source</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="source" name="source" value="{{ old('source') }}"  placeholder="Post Source">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="source_url" class=" control-label">Source URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="url" class="form-control" id="source_url" name="source_url" value="{{ old('source_url') }}"  placeholder="Source URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="audio_url" class=" control-label">Audio URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="url" class="form-control" id="audio_url" name="audio_url" value="{{ old('audio_url') }}"  placeholder="Audio URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="yes_option" class=" control-label">Status</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="status" id="yes_option" value="1" @if(old('status') == 1 || !old('status')) checked @endif>
                      Published
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="status" id="no_option" value="0" @if(old('status') == 0 && old('status')) checked @endif>
                      Unpublished
                  </label>
                </div>
              </div>
            </div>

          </div>

          <div class="box-footer">
            <input type="reset" class="btn btn-default" value="Cancel">
            <button type="submit" class="btn btn-success pull-right">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script src="{{ asset('vendor/bower_components/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
  $(function () {
    CKEDITOR.replace('description');
    $("#category").select2();

    $('#category').bind("change", function() {
      var space_offset = 8;
      var matches = $("#category option:selected").text().match(/\s{3}/g);
      var n_spaces = (matches) ? matches.length : 0;
      $(this).css('text-indent', -(n_spaces * space_offset));
    });

  });

</script>
@endsection
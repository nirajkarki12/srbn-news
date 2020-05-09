@extends('layouts.admin')

@section('title', 'Edit a Category')

@section('content-header', 'Edit a Category')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.category')}}"><i class="fa fa-folder-o"></i> Categories</a></li>
    <li class="active"><i class="fa fa-plus"></i> Edit a Category</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Category ({{ $categoryEdit->name }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.category')}}" class="btn btn-default pull-right">Categories</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.category.update', ['slug' => $categoryEdit->slug, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null])}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="name" class=" control-label">Name</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $categoryEdit->name }}"  placeholder="Category Name" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="description" class=" control-label">Description</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="description" name="description" rows="3" cols="80">{{ old('description') ?: $categoryEdit->description }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image_file" class=" control-label">Image</label>
              </div>
              <div class="col-sm-9 pull-left">
                @if($categoryEdit->image)
                  <img class="img-responsive" src="{{ $categoryEdit->image }}" style="margin-bottom:10px;width:150px;">
                @endif

                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_file" name="image_file">
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="yes_option" class=" control-label">Status</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $categoryEdit->status) == 1) checked @endif>
                      Enabled
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $categoryEdit->status) == 0) checked @endif>
                      Disabled
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
<script src="{{ asset('vendor/ckeditor5/build/ckeditor.js') }}"></script>
<script type="text/javascript">
   ClassicEditor
   .create( document.querySelector('#description'), {
      toolbar: {
         items: [
            'bold', 'italic', 'underline', 'strikethrough', '|', 
            'fontColor', 'fontBackgroundColor', 'link', '|', 
            'insertTable', 'bulletedList', 'numberedList','|',
            'blockQuote', 'subscript', 'superscript', 'horizontalLine', 
         ]
      },
   });
   
  $(function () {

  });

</script>
@endsection
@extends('layouts.admin')

@section('title', ($lifehack?"Edit":"Add").' Life Hack')

@section('content-header', ($lifehack?"Edit":"Add").' a Life Hack')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.lifehack')}}"><i class="fa fa-folder-o"></i> Life Hacks</a></li>
    <li class="active"><i class="fa fa-plus"></i> {{$lifehack?'Edit':'Add'}} a Life Hack</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">{{$lifehack?'Edit':'Add'}} a Life Hack</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.lifehack')}}" class="btn btn-default pull-right">Life Hacks</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.lifehack.store', $lifehack)}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="content" class=" control-label">Content English</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="content" name="content" rows="3" cols="80">{{ old('content')?:($lifehack?$lifehack->content:'') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="content_nepali" class=" control-label">Content Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="content_nepali" name="content_nepali" rows="3" cols="80">{{ old('content_nepali')?:(($lifehack&&$lifehack->translation)?$lifehack->translation->content:'') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image" class=" control-label">Image</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image" name="image">
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                @if($lifehack && $lifehack->image)
                  <img src="{{$lifehack->image}}" alt="Life-Hack-Image" class="img-responsive" style="height:100px">
                @endif
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
//    ClassicEditor
//    .create( document.querySelector('#description'), {
//       toolbar: {
//          items: [
//             'bold', 'italic', 'underline', 'strikethrough', '|', 
//             'fontColor', 'fontBackgroundColor', 'link', '|', 
//             'insertTable', 'bulletedList', 'numberedList','|',
//             'blockQuote', 'subscript', 'superscript', 'horizontalLine', 
//          ]
//       },
//    });
//   $(function () {

//   });

</script>
@endsection
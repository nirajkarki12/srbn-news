@extends('layouts.admin')

@section('title', 'Add a Poll')

@section('content-header', 'Add a Poll')

@section('breadcrumb')
   <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
   <li class="active"><a href="{{route('admin.poll')}}"><i class="fa fa-bar-chart"></i> Polls</a></li>
   <li class="active"><i class="fa fa-plus"></i> Add a Poll</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Add a Poll</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.poll')}}" class="btn btn-default pull-right">Polls</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.poll.store')}}" method="POST" role="form">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title" class=" control-label">Title</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Poll Title" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="description" class=" control-label">Description</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="description" name="description" rows="3" cols="80">{{ old('description') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="question" class=" control-label">Question</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <textarea class="form-control" id="question" name="question" rows="2" cols="80" required>{{ old('question') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="option1" class=" control-label">Options</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <div class="col-sm-4" style="padding:0 10px 0 0;">
                     <input type="text" class="form-control" id="option1" name="options[]" value="Yes" required placeholder="Option 1">
                  </div>
                  <div class="col-sm-4" style="padding:0 10px 0 0">
                     <input type="text" class="form-control" id="option2" name="options[]" value="No" required placeholder="Option 2">
                  </div>
                  <div class="col-sm-4" style="padding:0 0 0 0">
                     <input type="text" class="form-control" id="optional" name="optional" value="{{ old('optional') ?: 'Something else' }}"  placeholder="Option 3">
                  </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class="control-label">Type</label>
              </div>
              <div class="col-sm-9 pull-left">
                <select class="form-control" id="type" name="type" required>
                  @foreach(\App\Models\Post::$postTypes as $key => $val)
                     <option value="{{ $key }}" @if($key == old('type')) selected @endif>{{ $val }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="content" class=" control-label">URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <img class="img-responsive" id="image" src="" style="margin-bottom:10px;width:180px;display:none;">
                  <input type="url" class="form-control" id="content" name="content" value="{{ old('content') }}" required placeholder="URL">
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
    var type = $('#type option:selected').val();
    if(type) toggleType(type);

    $('#type').on('change', function() {
      var type = $(this).val();
      toggleType(type);
    });

    function toggleType(type){
      if(type == '{{ \App\Models\Post::TYPE_VIDEO}}') {
         $('#image').css('display', 'none');
         $('#content').parents('.form-group').find('label').html('Video URL');
      }else {
         if($('#image').attr('src')) $('#image').css('display', 'block');
         $('#content').parents('.form-group').find('label').html('Image URL');
      }
    }

   $('#content').on('change', function() {
      var value = $(this).val();
      var type = $('#type option:selected').val();

      if(type == '{{ \App\Models\Post::TYPE_IMAGE}}') {
         $("#overlay").fadeIn(200);

         $('#image').css('display', 'block');
         $('#image').attr('src', value);
         $("#overlay").fadeOut(200);
      }
    });

  });

</script>
@endsection
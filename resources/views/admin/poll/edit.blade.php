@extends('layouts.admin')

@section('title', 'Edit a Poll')

@section('content-header', 'Edit a Poll')

@section('breadcrumb')
   <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
   <li class="active"><a href="{{route('admin.poll')}}"><i class="fa fa-bar-chart"></i> Polls</a></li>
   <li class="active"><i class="fa fa-plus"></i> Edit a Poll</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Poll ({{ $pollEdit->title }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.poll')}}" class="btn btn-default pull-right">Polls</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.poll.update', ['slug' => $pollEdit->slug, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null])}}" method="POST" role="form">
          {{ csrf_field() }}
          <div class="box-body">

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title" class=" control-label">Title</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?: $pollEdit->title }}"  placeholder="Poll Title" required>
              </div>
            </div>

          <div class="form-group">
              <div class="col-sm-2 pull-left">
                  <label for="title_nepali" class=" control-label">Title in Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title_nepali" name="title_nepali" value="{{ old('title_nepali') ?: ($pollEdit->translation ? $pollEdit->translation->title : '') }}"  placeholder="Poll Title in Nepali" required>
              </div>
          </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="description" class=" control-label">Description</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="description" name="description" rows="3" cols="80" required>{{ old('description') ?: $pollEdit->description }}</textarea>
              </div>
            </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="description_nepali" class=" control-label">Description in Nepali</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <textarea class="form-control" id="description_nepali" name="description_nepali" rows="3" cols="80" required>{{ old('description_nepali') ?: ($pollEdit->translation ? $pollEdit->translation->description : '') }}</textarea>
                  </div>
              </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="question" class=" control-label">Question</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <textarea class="form-control" id="question" name="question" rows="2" cols="80" required>{{ old('question') ?: $pollEdit->question }}</textarea>
              </div>
            </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="question_nepali" class=" control-label">Question in Nepali</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <textarea class="form-control" id="question_nepali" name="question_nepali" rows="2" cols="80" required>{{ old('question_nepali') ?: ($pollEdit->translation ? $pollEdit->translation->question : '') }}</textarea>
                  </div>
              </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="options0" class=" control-label">Options</label>
              </div>
              <div class="col-sm-9 pull-left">
                  @foreach($pollEdit->options as $key => $option)
                     <div class="col-sm-4" style="padding:0 10px 0 0;">
                        <input type="text" class="form-control" id="options{{ $key }}" name="options[{{ $option->id }}]" required value="{{ $option->value }}" placeholder="Option {{ $key + 1 }}">
                     </div>
                  @endforeach
              </div>
            </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="options0" class=" control-label">Options in Nepali</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      @foreach($pollEdit->options as $key => $data)
                          <div class="col-sm-4" style="padding:0 10px 0 0;">
                              <input type="text" class="form-control" id="options2{{ $key }}" name="options2[{{ $data->translation->id }}]" required value="{{ $data->translation->value }}" placeholder="Option {{ $key + 1 }}">
                          </div>
                      @endforeach
                  </div>
              </div>


            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class="control-label">Type</label>
              </div>
              <div class="col-sm-9 pull-left">
               @php
                  $selectedType = (old('type') ?: $pollEdit->type);
               @endphp
                <select class="form-control" id="type" name="type" required>
                  @foreach(\App\Models\Post::$postTypes as $key => $val)
                     <option value="{{ $key }}" @if($key == $selectedType) selected @endif>{{ $val }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="content" class=" control-label">URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <img class="img-responsive" id="image" src="@if($selectedType == \App\Models\Post::TYPE_IMAGE) {{ $pollEdit->content }} @endif" style="margin-bottom:10px;width:180px;display:none;">
                  <input type="url" class="form-control" id="content" name="content" value="{{ old('content') ?: $pollEdit->content }}"  placeholder="URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="audio_url" class=" control-label">Audio URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="url" class="form-control" id="audio_url" name="audio_url" value="{{ old('audio_url') ?: $pollEdit->audio_url }}"  placeholder="Audio URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="yes_option" class=" control-label">Status</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $pollEdit->status) == 1) checked @endif>
                      Published
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $pollEdit->status) == 0) checked @endif>
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
   ClassicEditor
       .create( document.querySelector('#description_nepali'), {
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

@extends('layouts.admin')

@section('title', 'Add a Post')

@section('content-header', 'Add a Post')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.post')}}"><i class="fa fa-newspaper-o"></i> Posts</a></li>
    <li class="active"><i class="fa fa-plus"></i> Add a Post</li>
@endsection

@include('ckfinder::setup')
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
                <label for="yes_option" class=" control-label">Language</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="lang" id="yes_option" value="en" @if(old('lang') == 'en' || !old('lang')) checked @endif>
                      English
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="lang" id="no_option" value="ne" @if(old('lang') == 'ne' && old('lang')) checked @endif>
                      Nepali
                  </label>
                </div>
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
                <label for="source" class=" control-label">Source</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="source" name="source" value="{{ old('source') }}"  placeholder="Post Source">
              </div>
            </div>

            <!-- <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="source_nepali" class=" control-label">Source in Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="source_nepali" name="source_nepali" value="{{ old('source_nepali') }}"  placeholder="Post Source in Nepali">
              </div>
            </div> -->

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title" class=" control-label">Title</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"  placeholder="Post Title" required>
              </div>
            </div>

            <!-- <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title_nepali" class=" control-label">Title in Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title_nepali" name="title_nepali" value="{{ old('title_nepali') }}"  placeholder="Post Title in Nepali" required>
              </div>
            </div> -->

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="category" class="control-label">Post Category</label>
              </div>
              <div class="col-sm-9 pull-left">
               @php
                  $selectedId = old('category') ?: [];
                @endphp
                <select class="form-control" id="category" name="category[]" multiple="multiple" required>
                     @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if($selectedId && in_array($category->id, $selectedId)) selected @endif>{{ $category->name }}</option>
                     @endforeach
                </select>
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


            <!-- <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="description_nepali" class=" control-label">Description in Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="description_nepali" name="description_nepali" rows="3" cols="80">{{ old('description_nepali') }}</textarea>
              </div>
            </div> -->

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="note" class=" control-label">Note</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <textarea class="form-control" id="note" name="note" rows="2" cols="80">{{ old('note') }}</textarea>
              </div>
            </div>

            <!-- <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="note_nepali" class=" control-label">Note in Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <textarea class="form-control" id="note_nepali" name="note_nepali" rows="2" cols="80">{{ old('note_nepali') }}</textarea>
              </div>
            </div> -->

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
                  <input type="url" class="form-control" id="content" name="content" value="{{ old('content') }}"  placeholder="URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="audio_url" class=" control-label">Audio</label>
              </div>
              <div class="col-sm-6 pull-left">
                  <input type="url" class="form-control audio_url" id="audio_url" name="audio_url" value="{{ old('audio_url') }}" readonly placeholder="Audio URL">
              </div>
                <div class="col-sm-2 pull-left">
                    <button type="button" class="btn btn-default ckfinder_popup">Upload File</button>
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
   function selectFileWithCKFinder( elementId, selector ) {
       CKFinder.modal( {
           chooseFiles: true,
           width: 800,
           height: 600,
           onInit: function( finder ) {
               finder.on( 'files:choose', function(evt) {
                   let files = evt.data.files.models;
                   $(selector).parents('div.form-group').find('input[type="url"]').attr('value', files[0].getUrl());
               });

               finder.on( 'file:choose:resizedImage', function( evt ) {
                   var output = document.getElementById( elementId );
                   output.value = evt.data.resizedUrl;
               } );
           }
       } );
   }

  $(function () {
      $('.ckfinder_popup').click(function () {
          selectFileWithCKFinder( 'ckfinder-input-1', this );
      });
    $("#category").select2();

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

   $('#source_url').bind('blur', function() {
      var sourceUrl = $(this).val();
      getUrlData(sourceUrl);

   });

   function getUrlData(sourceUrl) {
      $.ajax({
         type: 'post',
         dataType: 'json',
         data: { "_token": "{{ csrf_token() }}", "url": sourceUrl },
         url: '{!! route("admin.post.get-web-content") !!}',
         beforeSend: function() {
            $("#overlay").fadeIn(200);
            $('#title').val('');
            $('#note').val('');
            $('#content').val('');
            $('#source').val('');
            $('#image').css('display', 'none');
         },
         success:function(res){
           $("#overlay").fadeOut(200);
            if(res.status == true) {
               $('#type').val('{{ \App\Models\Post::TYPE_IMAGE }}')
               $('#title').val(res.data.title);
               $('#note').val(res.data.description);
               $('#content').val(res.data.image);
               $('#source').val(res.data.source);
               $('#image').css('display', 'block');
               $('#image').attr('src', res.data.image);
            }else{
               alert(res.message);
            }
         },
         error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            // window.location.href = loginUrl;
         }
      });

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

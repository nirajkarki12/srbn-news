@extends('layouts.admin')

@section('title', 'Edit a Post')

@section('content-header', 'Edit a Post')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.post')}}"><i class="fa fa-newspaper-o"></i> Posts</a></li>
    <li class="active"><i class="fa fa-pencil-square-o"></i> Edit a Post</li>
@endsection

@include('ckfinder::setup')
@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Post ({{ $postEdit->title }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.post')}}" class="btn btn-default pull-right">Posts</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.post.update', ['slug' => $postEdit->slug, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null])}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">

          <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="yes_option" class=" control-label">Language</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="lang" id="yes_option" value="en" @if((old('lang') ?: $postEdit->lang) == 'en') checked @endif>
                      English
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="lang" id="no_option" value="ne" @if((old('lang') ?: $postEdit->lang) == 'ne') checked @endif>
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
                  <input type="url" class="form-control" id="source_url" name="source_url" value="{{ old('source_url') ?: $postEdit->source_url }}"  placeholder="Source URL">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="source" class=" control-label">Source</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="source" name="source" value="{{ old('source') ?: $postEdit->source }}"  placeholder="Post Source">
              </div>
            </div>




            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="title" class=" control-label">Title</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?: $postEdit->title }}"  placeholder="Post Title" required>
              </div>
            </div>



            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="category" class=" control-label">Post Category</label>
              </div>
              <div class="col-sm-9 pull-left">
                @php
                  $selectedId = old('category') ?: ($selectedCategories ?: null);
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
                <textarea class="form-control" id="description" name="description" rows="3" cols="80">{{ old('description') ?: $postEdit->description }}</textarea>
              </div>
            </div>




            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="note" class=" control-label">Note</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <textarea class="form-control" id="note" name="note" rows="2" cols="80">{{ old('note') ?: $postEdit->note }}</textarea>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class="control-label">Type</label>
              </div>
              <div class="col-sm-9 pull-left">
               @php
                  $selectedType = (old('type') ?: $postEdit->type);
               @endphp
                <select class="form-control" id="type" name="type" required>
                  @foreach(\App\Models\Post::$postTypes as $key => $val)
                     <option value="{{ $key }}" @if($key == $selectedType) selected @endif>{{ $val }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group" id="videoWrapper">
              <div class="col-sm-2 pull-left">
                <label for="content" class=" control-label">Youtube URL</label>
              </div>
              <div class="col-sm-9 pull-left">
                  <input type="url" class="form-control" id="content" name="youtubeUrl" value="{{ $postEdit->galleries && count($postEdit->galleries) > 0 ? $postEdit->galleries->first()->url : '' }}"  placeholder="URL">
              </div>
            </div>

            <div class="form-group row" id="galleryWrapper">
                <div class="col-sm-2 pull-left">
                    <label for="content" class=" control-label">Gallery</label>
                </div>
                <div class="col-md-9 pull-left">
                  <div class="dropzone-wrapper">
                      <div class="dropzone-desc">
                          <i class="fa fa-picture-o"></i>
                          <p>Click here to upload.</p>
                      </div>
                      <input type="button" id="ckfinder-popup" class="btn btn-info dropzone">
                  </div>

                  <ul class="row text-center text-lg-left ckfinder-list">
                      @if($postEdit->type != \App\Models\Post::TYPE_VIDEO && $postEdit->galleries && count($postEdit->galleries) > 0)
                          @foreach($postEdit->galleries as $gallery)
                              <li class="col-lg-3 col-md-4 col-6">
                                  <a class="remove-image" href="javascript:void(0)">
                                    <img class="img-fluid img-thumbnail" src="{{ $gallery->url }}" />
                                    <span class="fa fa-times"> Click to remove</span>
                                    <span class="arrows">
                                        <i class="fa fa-angle-double-left" aria-hidden="true"></i> Move to order <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </span>
                                  </a>
                                  <input type="hidden" name="urls[]" value="{{ $gallery->url }}">
                              </li>
                          @endforeach
                      @endif
                  </ul>
                </div>
            </div>

            <div class="form-group" id="full_width_content" style="display: none">
                  <div class="col-sm-2 pull-left">
                      <label for="full_width_yes" class=" control-label">Video Full Width</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <div class="radio">
                          <label>
                              <input type="radio" name="is_full_width" id="full_width_yes" value="1" @if((old('is_full_width') ?: $postEdit->is_full_width) == 1) checked @endif>
                              Yes
                          </label>
                          &nbsp;
                          <label>
                              <input type="radio" name="is_full_width" id="full_width_no" value="0" @if((old('is_full_width') ?: $postEdit->is_full_width) == 0) checked @endif>
                              No
                          </label>
                      </div>
                  </div>
              </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="audio_url" class=" control-label">Audio URL</label>
              </div>
              <div class="col-sm-6 pull-left">
                  <input type="url" class="form-control audio_url" id="audio_url" name="audio_url" value="{{ old('audio_url') ?: $postEdit->audio_url }}" readonly placeholder="Audio URL">
              </div>
                <div class="col-sm-2 pull-left">
                    <button type="button" class="btn btn-default ckfinder_popup">Upload File</button>
                </div>

            </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="source_url2" class=" control-label">Source URL 2</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <input type="url" class="form-control" id="source_url2" name="source_url2" value="{{ old('source_url2') ?: $postEdit->source_url2 }}"  placeholder="Source URL 2">
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="source_url3" class=" control-label">Source URL 3</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <input type="url" class="form-control" id="source_url3" name="source_url3" value="{{ old('source_url3') ?: $postEdit->source_url3 }}"  placeholder="Source URL 3">
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="question" class=" control-label">Poll</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      <textarea class="form-control" id="question" name="question" rows="2" cols="80" placeholder="Poll Question">{{ old('question') ?: ($postEdit->poll ? $postEdit->poll->question : '') }}</textarea>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-2 pull-left">
                      <label for="option1" class=" control-label">Poll Options</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                      @if($postEdit->poll)
                          @foreach($postEdit->poll->options as $key => $option)
                              <div class="col-sm-4" style="padding:0 10px 0 0;">
                                  <input type="text" class="form-control" id="options{{ $key }}" name="options[{{ $option->id }}]" value="{{ $option->value }}" placeholder="Option {{ $key + 1 }}">
                              </div>
                          @endforeach
                      @else
                          <div class="col-sm-4" style="padding:0 10px 0 0;">
                              <input type="text" class="form-control" id="option1" name="options[]" value="{{ old('option1') }}" placeholder="Option 1">
                          </div>
                          <div class="col-sm-4" style="padding:0 10px 0 0">
                              <input type="text" class="form-control" id="option2" name="options[]" value="{{ old('option2') }}" placeholder="Option 2">
                          </div>
                      @endif
                  </div>
              </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="yes_option" class=" control-label">Status</label>
              </div>

              <div class="col-sm-9 pull-left">

                <div class="radio">
                  <label>
                    <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $postEdit->status) == 1) checked @endif>
                      Published
                  </label>
                  &nbsp;&nbsp;
                  <label>
                    <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $postEdit->status) == 0) checked @endif>
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

    let browseButton = document.getElementById( 'ckfinder-popup' );
    let imageHolder = document.getElementsByClassName('ckfinder-list');

    browseButton.onclick = function() {
        galleryPopup( 'ckfinder-input-1' );
    };

    function galleryPopup( elementId ) {
        CKFinder.modal( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function(evt) {
                    let files = evt.data.files.models;
                    for (let i = 0; i < files.length; i++) {
                        let imageUrl = files[i].getUrl();
                        $(imageHolder).append('<li class="col-lg-3 col-md-4 col-6"><a class="remove-image" href="javascript:void(0)"><img class="img-fluid img-thumbnail" src="' + imageUrl + '" /><span class="fa fa-times"> Click to remove</span><span class="arrows"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Move to order <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a><input type="hidden" name="urls[]" value="' + imageUrl +'"></li>');
                    }
                });

                finder.on( 'file:choose:resizedImage', function( evt ) {
                    var output = document.getElementById( elementId );
                    output.value = evt.data.resizedUrl;
                } );
            }
        } );
    }


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
      $('body').on('click', 'a.remove-image', function (e) {
          e.preventDefault();
          $(this).parent('li').remove();
      });

      $('body').find('.ckfinder-list').sortable({
          update: function(event, ui) {
              dropIndex = ui.item.index();
          }
      });

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
         $('#galleryWrapper').css('display', 'none');
          $('#videoWrapper').css('display', 'flex');
          $('#full_width_content').css('display', 'flex');
      }else {
          $('#videoWrapper').css('display', 'none');
          $('#galleryWrapper').css('display', 'flex');
          $('#full_width_content').css('display', 'none');
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

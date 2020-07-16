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

                        <div class="form-group">
                            <div class="col-sm-2 pull-left">
                                <label for="note" class=" control-label">Note</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <textarea class="form-control" id="note" name="note" rows="2" cols="80">{{ old('note') }}</textarea>
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

                        <div class="form-group" id="videoWrapper">
                            <div class="col-sm-2 pull-left">
                                <label for="content" class=" control-label">Youtube URL</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <input type="url" class="form-control" id="content" name="youtubeUrl" value="{{ old('youtubeUrl') }}"  placeholder="URL">
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

                                <ul class="row text-center text-lg-left ckfinder-list"></ul>
                            </div>
                        </div>

                        <div class="form-group" id="full_width_content" style="display: none">
                            <div class="col-sm-2 pull-left">
                                <label for="full_width_yes" class=" control-label">Video Full Width</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_full_width" id="full_width_yes" value="1" @if(old('is_full_width') == '1') checked @endif>
                                        Yes
                                    </label>
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="is_full_width" id="full_width_no" value="0" @if(old('is_full_width') == '0' || !old('is_full_width')) checked @endif>
                                        No
                                    </label>
                                </div>
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
                                <label for="source_url2" class=" control-label">Source URL 2</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <input type="url" class="form-control" id="source_url2" name="source_url2" value="{{ old('source_url2') }}"  placeholder="Source URL 2">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2 pull-left">
                                <label for="source_url3" class=" control-label">Source URL 3</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <input type="url" class="form-control" id="source_url3" name="source_url3" value="{{ old('source_url3') }}"  placeholder="Source URL 3">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2 pull-left">
                                <label for="question" class=" control-label">Poll</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <textarea class="form-control" id="question" name="question" rows="2" cols="80" placeholder="Poll Question">{{ old('question') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-2 pull-left">
                                <label for="option1" class=" control-label">Poll Options</label>
                            </div>
                            <div class="col-sm-9 pull-left">
                                <div class="col-sm-4" style="padding:0 10px 0 0;">
                                    <input type="text" class="form-control" id="option1" name="option1" value="{{ old('option1') }}" placeholder="Option 1">
                                </div>
                                <div class="col-sm-4" style="padding:0 10px 0 0">
                                    <input type="text" class="form-control" id="option2" name="option2" value="{{ old('option2') }}" placeholder="Option 2">
                                </div>
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
                            $(imageHolder).append('<li class="col-lg-3 col-md-4 col-6"><a class="remove-image" href="javascript:void(0)"><img class="img-fluid img-thumbnail" src="' + res.data.image + '" /><span class="fa fa-times"> Click to remove</span><span class="arrows"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Move to order <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a><input type="hidden" name="urls[]" value="' + res.data.image +'"></li>');

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

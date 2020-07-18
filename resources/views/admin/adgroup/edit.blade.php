@extends('layouts.admin')

@section('title', 'Edit a Ads')

@section('content-header', 'Edit a Ads')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.adgroup')}}"><i class="fa fa-picture-o"></i> Adgroup</a></li>
    <li class="active"><i class="fa fa-pencil-square-o"></i> Edit a Ads</li>
@endsection

@include('ckfinder::setup')
@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">Edit a Post ({{ $adgroup->title }})</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.adgroup')}}" class="btn btn-default pull-right">Ads</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.adgroup.update', ['adgroup' => $adgroup->id, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null])}}" method="POST" role="form">
          {{ csrf_field() }}
            <div class="box-body">

                <div class="form-group">
                    <div class="col-sm-2 pull-left">
                        <label for="title" class=" control-label">Title</label>
                    </div>
                    <div class="col-sm-9 pull-left">
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?: $adgroup->title }}"  placeholder="Post Title" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 pull-left">
                        <label for="show_after" class=" control-label">Show After</label>
                    </div>
                    <div class="col-sm-9 pull-left">
                        <input type="number" class="form-control" id="show_after" name="show_after" value="{{ old('show_after') ?: $adgroup->show_after }}"  placeholder="Show after Number of Scroll" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 pull-left">
                        <label for="publish_date" class=" control-label">Publish Date</label>
                    </div>

                    <div class="col-sm-9 pull-left">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="publish_date" name="publish_date" value="{{ old('publish_date') ? old('publish_date')->format('Y-m-d') : $adgroup->publish_date->format('Y-m-d') }}"  placeholder="Pick publish date" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 pull-left">
                        <label for="expiry_date" class=" control-label">Expiry Date</label>
                    </div>

                    <div class="col-sm-9 pull-left">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') ? old('expiry_date')->format('Y-m-d') : $adgroup->expiry_date->format('Y-m-d') }}"  placeholder="Pick expiry date" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="dropzone-wrapper">
                            <div class="dropzone-desc">
                                <i class="fa fa-picture-o"></i>
                                <p>Click here to upload.</p>
                            </div>
                            <input type="button" id="ckfinder-popup" class="btn btn-info dropzone">
                        </div>

                        <ul class="row text-center text-lg-left ckfinder-list">
                            @if($adgroup->ads && count($adgroup->ads) > 0)
                                @foreach($adgroup->ads as $ad)
                                    <li class="col-lg-3 col-md-4 col-6">
                                        <a class="remove-image" href="javascript:void(0)">
                                            <img class="img-fluid img-thumbnail" src="{{ $ad->image }}" />
                                            <span class="fa fa-times"> Click to remove</span>
                                            <span class="arrows">
                                                <i class="fa fa-angle-double-left" aria-hidden="true"></i> Move to order <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                        <input type="hidden" name="images[]" value="{{ $ad->image }}">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="box-footer">
                    <input type="reset" class="btn btn-default" value="Cancel">
                    <button type="submit" class="btn btn-success pull-right">Save</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
<script type="text/javascript">
    let browseButton = document.getElementById( 'ckfinder-popup' );
    let imageHolder = document.getElementsByClassName('ckfinder-list');

    browseButton.onclick = function() {
        selectFileWithCKFinder( 'ckfinder-input-1' );
    };

    function selectFileWithCKFinder( elementId ) {
        CKFinder.modal( {
            chooseFiles: true,
            width: 800,
            height: 600,
            onInit: function( finder ) {
                finder.on( 'files:choose', function(evt) {
                    let files = evt.data.files.models;
                    for (let i = 0; i < files.length; i++) {
                        let imageUrl = files[i].getUrl();
                        $(imageHolder).append('<li class="col-lg-3 col-md-4 col-6"><a class="remove-image" href="javascript:void(0)"><img class="img-fluid img-thumbnail" src="' + imageUrl + '" /><span class="fa fa-times"> Click to remove</span><span class="arrows"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Move to order <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a><input type="hidden" name="images[]" value="' + imageUrl +'"></li>');
                    }
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

        //Date picker
        $('#publish_date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
        });

        $('#expiry_date').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
        });
    });
</script>
@endsection

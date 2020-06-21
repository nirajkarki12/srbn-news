@extends('layouts.admin')

@section('title', ($meme?"Edit":"Add").' Meme')

@section('content-header', ($meme?"Edit":"Add").' a Meme')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.lifehack')}}"><i class="fa fa-folder-o"></i> Meme</a></li>
    <li class="active"><i class="fa fa-plus"></i> {{$meme?'Edit':'Add'}} a Meme</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">{{$meme?'Edit':'Add'}} a Meme</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.meme')}}" class="btn btn-default pull-right">Memes</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.meme.store', $meme)}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image" class=" control-label">Image</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image" name="image">
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                @if($meme && $meme->image)
                  <img src="{{$meme->image}}" alt="Life-Hack-Image" class="img-responsive" style="height:100px">
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="source" class="control-label">Source</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="text" id="source" name="source" class="form-control" placeholder="Enter the source of meme" value="{{old('source')?:($meme?$meme->source:'')}}">
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

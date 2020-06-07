@extends('layouts.admin')

@section('title', ($horoscope?"Edit":"Add").' Horoscope')

@section('content-header', ($horoscope?"Edit":"Add").' a Horoscope')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.horoscope')}}"><i class="fa fa-folder-o"></i> Horoscopes</a></li>
    <li class="active"><i class="fa fa-plus"></i> {{$horoscope?'Edit':'Add'}} a Horoscope</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">{{$horoscope?'Edit':'Add'}} a Horoscope</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.horoscope')}}" class="btn btn-default pull-right">Horoscopes</a>
           </div>
        </div>

        <form class="form-horizontal" action="{{route('admin.horoscope.store', $horoscope)}}" method="POST" enctype="multipart/form-data" role="form">
          {{ csrf_field() }}
          <div class="box-body">

          <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="name_nepali" class=" control-label">Name Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="text" id="name_nepali" name="name_nepali" class="form-control" value="{{old('name_nepali')?:($horoscope?$horoscope->name_nepali:'')}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="name_english" class=" control-label">Name English</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="text" id="name_english" name="name_english" class="form-control" value="{{old('name_english')?:($horoscope?$horoscope->name_english:'')}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image_nepali" class=" control-label">Image Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_nepali" name="image_nepali">
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                @if($horoscope && $horoscope->image_nepali)
                  <img src="{{$horoscope->image_nepali}}" alt="horoscope-image" class="img-responsive" style="height:100px">
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="image_nepali" class=" control-label">Image English</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_english" name="image_english">
                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                @if($horoscope && $horoscope->image_english)
                  <img src="{{$horoscope->image_english}}" alt="horoscope-image" class="img-responsive" style="height:100px">
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="info_nepali" class=" control-label">Info Nepali</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="info_nepali" name="info_nepali" rows="3" cols="80">{{ old('info_nepali')?:($horoscope?$horoscope->info_nepali:'') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="info_english" class=" control-label">Info English</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="info_english" name="info_english" rows="3" cols="80">{{ old('info_english')?:($horoscope?$horoscope->info_english:'') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="info" class=" control-label">Order </label>
              </div>
              <div class="col-sm-9 pull-left">
                <select name="order" id="order">
                    <option value="">Select Horoscope Order</option>
                    @for($i=1; $i<13; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                @if($horoscope)<small>Only if it is different</small> @endif
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

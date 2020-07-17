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
                      <label for="yes_option" class=" control-label">Type</label>
                  </div>

                  <div class="col-sm-9 pull-left">
                      <div class="radio">
                          <label>
                              <input type="radio" name="lang" id="yes_option" value="en" @if((old('lang') == 'en') || ($horoscope && $horoscope->lang == 'en')) checked @endif>
                              Zodiac
                          </label>
                          &nbsp;&nbsp;
                          <label>
                              <input type="radio" name="lang" id="no_option" value="ne" @if((old('lang') == 'ne') || ($horoscope && $horoscope->lang == 'ne')) checked @endif>
                              रशिफल
                          </label>
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-2 pull-left">
                    <label for="name" class=" control-label">Name</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')?:($horoscope?$horoscope->name:'')}}" required>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-2 pull-left">
                    <label for="info" class=" control-label">Info</label>
                  </div>
                  <div class="col-sm-9 pull-left">
                    <textarea class="form-control" id="info" name="info" rows="3" cols="80">{{ old('info')?:($horoscope?$horoscope->info:'') }}</textarea>
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-2 pull-left">
                        <label for="image" class=" control-label">Icon</label>
                    </div>
                    <div class="col-sm-9 pull-left">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" id="image" name="image">
                        <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                        @if($horoscope && $horoscope->image)
                            <img src="{{$horoscope->image}}" alt="horoscope-image" class="img-responsive" style="height:100px">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-2 pull-left">
                    <label for="info" class=" control-label">Order </label>
                  </div>
                  <div class="col-sm-9 pull-left">
                    <select name="order" id="order" class="form-control">
                        <option value="">Select Horoscope Order</option>
                        @for($i=1; $i<13; $i++)
                            <option value="{{$i}}" @if($horoscope && $horoscope->order == $i) selected @endif>{{$i}}</option>
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

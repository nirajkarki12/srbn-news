@extends('layouts.admin')

@section('title', ($prediction?"Edit":"Add").' Prediction')

@section('content-header', ($prediction?"Edit":"Add").' a Prediction')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dasboard</a></li>
    <li><a href="{{route('admin.prediction')}}"><i class="fa fa-folder-o"></i> Predictions</a></li>
    <li class="active"><i class="fa fa-plus"></i> {{$prediction?'Edit':'Add'}} a Prediction</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">
    <div class="col-md-9">
      <div class="box box-primary">

        <div class="box-header with-border">
           <h3 class="box-title">{{$prediction?'Edit':'Add'}} a Prediction</h3>
           <div class="box-tools pull-right">
              <a href="{{route('admin.prediction')}}" class="btn btn-default pull-right">Predictions</a>
           </div>
        </div>

    <form class="form-horizontal" action="{{route('admin.prediction.store', $prediction)}}" method="POST" enctype="multipart/form-data" role="form">
      {{ csrf_field() }}
      <div class="box-body">

          <div class="form-group">
              <div class="col-sm-2 pull-left">
                  <label for="yes_option" class=" control-label">Type</label>
              </div>

              <div class="col-sm-9 pull-left">
                  <div class="radio">
                      <label>
                          <input type="radio" name="lang" id="yes_option" value="en" @if((old('lang') == 'en') || ($prediction && $prediction->horoscope->lang == 'en')) checked @endif>
                          Zodiac
                      </label>
                      &nbsp;&nbsp;
                      <label>
                          <input type="radio" name="lang" id="no_option" value="ne" @if((old('lang') == 'ne') || ($prediction && $prediction->horoscope->lang == 'ne')) checked @endif>
                          रशिफल
                      </label>
                  </div>
              </div>
          </div>

          <div class="form-group" id="group1" style="display: none">
              <div class="col-sm-2 pull-left">
                <label for="zodiac1" class=" control-label">Zodiac </label>
              </div>
              <div class="col-sm-9 pull-left">
                <select name="zodiac1" id="zodiac1" class="form-control" >
                    <option value="">Select Horoscope</option>
                    @foreach($horoscopes1 as $horoscope)
                        <option value="{{$horoscope->id}}" {{( old('zodiac1') ? old('zodiac1') == $horoscope->id : $prediction&&($prediction->horoscope_id==$horoscope->id))?'selected':''}}>{{$horoscope->name}}</option>
                    @endforeach
                </select>
              </div>
            </div>

            <div class="form-group" id="group2" style="display: none">
              <div class="col-sm-2 pull-left">
                  <label for="zodiac2" class=" control-label">रशिफल </label>
              </div>
              <div class="col-sm-9 pull-left">
                  <select name="zodiac2" id="zodiac2" class="form-control" >
                      <option value="">Select Horoscope</option>
                      @foreach($horoscopes2 as $horoscope)
                          <option value="{{$horoscope->id}}" {{ old('zodiac2') ? old('zodiac2') == $horoscope->id : ($prediction&&($prediction->horoscope_id==$horoscope->id))?'selected':''}}>{{$horoscope->name}}</option>
                      @endforeach
                  </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="data" class=" control-label">Data</label>
              </div>
              <div class="col-sm-9 pull-left">
                <textarea class="form-control" id="data" name="data" rows="3" cols="80" required>{{ old('data')?:($prediction?$prediction->data:'') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class=" control-label">Timeline Type </label>
              </div>
              <div class="col-sm-9 pull-left">
                <select name="type" id="type" class="form-control" required>
                    <option value="">Select Timeline</option>
                    <option value="daily" {{ old('type') && old('type') == 'daily' ? 'selected' : ($prediction && ($prediction->type=='daily')?'selected':'')}}>Daily</option>
                    <option value="weekly" {{ old('type') && old('type') == 'weekly' ? 'selected' : ($prediction && ($prediction->type=='weekly')?'selected':'')}}>Weekly</option>
                    <option value="monthly" {{ old('type') && old('type') == 'monthly' ? 'selected' : ($prediction && ($prediction->type=='monthly')?'selected':'')}}>Monthly</option>
                    <option value="yearly" {{ old('type') && old('type') == 'yearly' ? 'selected' : ($prediction && ($prediction->type=='yearly')?'selected':'')}}>Yearly</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class=" control-label">Date/Start Date</label>
              </div>
              <div class="col-sm-9 pull-left">
                <input type="date" class="form-control" name="prediction_date" style="width: 100%;border-radius: 0px;border: solid 1px #ccc;" required value="{{old('prediction_date') ?: ($prediction?\Carbon\Carbon::parse($prediction->prediction_date)->format('Y-m-d'):'')}}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-2 pull-left">
                <label for="type" class=" control-label">Rating</label>
              </div>
              <div class="col-sm-9 pull-left">
              <input id="input-id" name="rating" type="number" class="rating" min=0 max=5 step=0.2 data-size="sm" showCaption="false" value="{{old('rating')?:($prediction?$prediction->rating:0)}}">
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

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        var lang = $('input[name="lang"]:checked').val();
        if(lang == 'ne') {
            $('#group2').css('display', 'flex');
            $('#group1').css('display', 'none');
        }else if(lang == 'en') {
            $('#group1').css('display', 'flex');
            $('#group2').css('display', 'none');
        }

        $('input[name="lang"]').on('change', function () {
            let lang = $(this).val();
            if(lang == 'ne') {
                $('#group2').css('display', 'flex');
                $('#group1').css('display', 'none');
            }else if(lang == 'en') {
                $('#group1').css('display', 'flex');
                $('#group2').css('display', 'none');
            }
        });

    });

</script>
@endsection

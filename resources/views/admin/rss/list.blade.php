@extends('layouts.admin')

@section('title', 'Rss Feed')

@section('content-header', 'Rss Feed')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-bookmark-o"></i>&nbsp; Rss Feed</li>
@endsection

@section('content')

@include('notification.notify')
  <div class="row">

    <div class="col-md-6">

      <div class="box box-primary">

        <div class="box-body box-profile">
          <h3 class="profile-username text-center">List of Rss Feed</h3>
          @if(count($data) > 0)

          <table class="table table-bordered">
            <tbody>
              <tr>
                <th width="5%">#</th>
                <th>Name</th>
                <th>Tagline</th>
                <th>Logo</th>
                <th>Status</th>
                <th class="text-right">Action</th>
              </tr>
              @foreach($data as $key => $rss)
              <tr>
                <td style="vertical-align:middle">{{ $data->firstItem() + $key }}</td>
                <td style="vertical-align:middle"><a href="{{ $rss->url }}" title="RSS Feed: {{ $rss->name }}" target="_new">{{ $rss->name }}</a></td>
                <td style="vertical-align:middle">{{ $rss->tagline }}</td>
                <td style="vertical-align:middle">
                  @if($rss->logo)
                    <img src="{{ $rss->logo }}" class="img-responsive" style="width:70px;">
                  @else
                    -
                  @endif
                </td>
                <td style="vertical-align:middle">{{ $rss->status ? 'Enabled' : 'Disabled' }}</td>

                <td class="text-right" style="vertical-align:middle">
                    <a href="{{route('admin.rss.edit' , array('slug' => $rss->slug, 'page' => $data->currentPage()))}}" title="Edit a Rss">
                        <span class="fa fa-pencil-square-o fa-lg"></span>
                    </a>
                    &nbsp;
                    <a href="{{route('admin.rss.destroy' , array('slug' => $rss->slug, 'page' => $data->currentPage()))}}" title="Delete a Rss" onclick="return confirm('Are you sure?')">
                        <span class="fa fa-times fa-lg"></span>
                    </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $data->links() }}
          @else
              <h3 class="no-result">No record(s) found</h3>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6">
      @if(!isset($rssEdit))
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add a RSS Feed</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-group" action="{{route('admin.rss.store')}}" method="POST" enctype="multipart/form-data" role="form">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="RSS Name">
                </div>

                <div class="form-group">
                  <label for="tagline">Tagline</label>
                  <textarea class="form-control" id="tagline" name="tagline" rows="2" cols="80">{{ old('tagline') }}</textarea>
                </div>

                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required placeholder="RSS Feed URL">
                </div>

              <div class="form-group">
                <div class="col-sm-2 pull-left">
                  <label for="logo_file" class=" control-label">Logo</label>
                </div>
                <div class="col-sm-9 pull-left">
                  <input type="file" accept="image/png, image/jpeg, image/jpg" id="logo_file" name="logo_file">
                  <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr />

              <div class="form-group">
                 <div class="col-sm-2 pull-left">
                    <label for="yes_option" class=" control-label">Status</label>
                 </div>

                 <div class="col-sm-9 pull-left">
                  <div class="radio">
                    <label>
                      <input type="radio" name="status" id="yes_option" value="1" @if(old('status') == 1 || !old('status')) checked @endif>
                        Enabled
                    </label>
                    &nbsp;&nbsp;
                    <label>
                      <input type="radio" name="status" id="no_option" value="0" @if(old('status') == 0 && old('status')) checked @endif>
                        Disabled
                    </label>
                 </div>
              </div>

              <div class="clearfix"></div>

              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="reset" class="btn btn-default" value="Cancel">
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
              </div>

          </form>
        </div>
      @else
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit a RSS Feed({{ $rssEdit->name }})</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-group" action="{{route('admin.rss.update', [ 'slug' => $rssEdit->slug, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null ])}}" method="POST" enctype="multipart/form-data" role="form">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $rssEdit->name }}" required placeholder="RSS Name">
                </div>

                <div class="form-group">
                  <label for="tagline">Tagline</label>
                  <textarea class="form-control" id="tagline" name="tagline" rows="2" cols="80">{{ old('tagline') ?: $rssEdit->tagline }}</textarea>
                </div>

                <div class="form-group">
                  <label for="url">URL</label>
                  <input type="text" class="form-control" id="url" name="url" value="{{ old('url') ?: $rssEdit->tagline }}" required placeholder="RSS Feed URL">
                </div>

              <div class="form-group">
                <div class="col-sm-2 pull-left">
                  <label for="logo_file" class=" control-label">Logo</label>
                </div>
                <div class="col-sm-9 pull-left">
                    @if($rssEdit->logo)
                       <img class="img-responsive" src="{{ $rssEdit->logo }}" style="margin-bottom:10px;width:150px;">
                    @endif

                  <input type="file" accept="image/png, image/jpeg, image/jpg" id="logo_file" name="logo_file">
                  <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                </div>
              </div>

              <div class="clearfix"></div>
              <hr />

              <div class="form-group">
                 <div class="col-sm-2 pull-left">
                    <label for="yes_option" class=" control-label">Status</label>
                 </div>

                 <div class="col-sm-9 pull-left">

                  <div class="radio">
                    <label>
                      <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $rssEdit->status) == 1) checked @endif>
                        Enabled
                    </label>
                    &nbsp;&nbsp;
                    <label>
                      <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $rssEdit->status) == 0) checked @endif>
                        Disabled
                    </label>
                  </div>
                </div>

              <div class="clearfix"></div>
              <!-- /.box-body -->
              <div class="box-footer">
                  <input type="reset" class="btn btn-default" value="Cancel">
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
              </div>

          </form>
        </div>
      @endif
    </div>

  </div>

@endsection

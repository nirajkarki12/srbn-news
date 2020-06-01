@extends('layouts.admin')

@section('title', 'Quotes')

@section('content-header', 'Quotes')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-quote-right"></i>&nbsp; Quotes</li>
@endsection

@section('content')

@include('notification.notify')
<style>
    td blockquote {
        border-left: 5px solid #ccc;
        padding: 0.5em 7px;
        margin: 0;
        quotes: "\201C""\201D""\2018""\2019";

    }
    td blockquote:before {
        color: #6b6b6b;
        content: open-quote;
        font-size: 3em;
        line-height: 0.1em;
        vertical-align: -0.4em;
    }
    blockquote:after {
        visibility: hidden;
        content: close-quote;
    }
</style>
  <div class="row">

    <div class="col-md-6">

      <div class="box box-primary">

        <div class="box-body box-profile">
          <h3 class="profile-username text-center">List of Quotes</h3>
          @if(count($data) > 0)

          <table class="table table-bordered">
            <tbody>
              <tr>
                <th width="5%">#</th>
                <th>Quote</th>
                <th>Likes</th>
                <th>Status</th>
                <th class="text-right" width="10%">Action</th>
              </tr>
              @foreach($data as $key => $quote)
              <tr>
                <td style="vertical-align:middle">{{ $data->firstItem() + $key }}</td>
                <td style="vertical-align:middle">
                    <blockquote>
                        {{ $quote->quote }}
                        @if($quote->author)
                        <footer>
                            {{ $quote->author }}
                        </footer>
                        @endif
                    </blockquote></td>
                <td style="vertical-align:middle">{{ $quote->totalLike }}</td>
                <td style="vertical-align:middle">{{ $quote->status ? 'Enabled' : 'Disabled' }}</td>

                <td class="text-right" style="vertical-align:middle">
                    <a href="{{route('admin.quote.edit' , array('id' => $quote->id, 'page' => $data->currentPage()))}}" title="Edit a Quote">
                        <span class="fa fa-pencil-square-o fa-lg"></span>
                    </a>
                    &nbsp;
                    <a href="{{route('admin.quote.destroy' , array('id' => $quote->id, 'page' => $data->currentPage()))}}" title="Delete a Quote" onclick="return confirm('Are you sure?')">
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
      @if(!isset($quoteEdit))
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add a Quote</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-group" action="{{route('admin.quote.store')}}" method="POST" role="form">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="quote">Quote</label>
                    <textarea id="quote" name="quote" class="form-control" placeholder="Write your Quote">{{ old('quote') }}</textarea>
                </div>

              <div class="form-group">
                  <label for="author">Author</label>
                  <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" placeholder="Quote Author">
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
            <h3 class="box-title">Edit a Quote({{ $quoteEdit->name }})</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-group" action="{{route('admin.quote.update', [ 'id' => $quoteEdit->id, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null ])}}" method="POST" role="form">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="quote">Quote</label>
                    <textarea id="quote" name="quote" class="form-control" placeholder="Write your Quote">{{ old('quote') ?: $quoteEdit->quote }}</textarea>
                </div>

              <div class="form-group">
                  <label for="author">Author</label>
                  <input type="text" class="form-control" id="author" name="author" value="{{ old('author') ?: $quoteEdit->author }}" placeholder="Quote Author">
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
                      <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $quoteEdit->status) == 1) checked @endif>
                        Enabled
                    </label>
                    &nbsp;&nbsp;
                    <label>
                      <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $quoteEdit->status) == 0) checked @endif>
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

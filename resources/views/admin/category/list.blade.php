@extends('layouts.admin')

@section('title', 'Category')

@section('content-header', 'Categories')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-folder-o"></i>&nbsp; Categories</li>
@endsection

@section('content')

@include('notification.notify')
<div class="row">

    <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">List of Categories</h3>
                    @if(count($categories) > 0)

                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th class="text-right" width="10%">Action</th>
                            </tr>
                            @foreach($categories as $key => $category)
                                <tr>
                                    <td style="vertical-align:middle">{{ $categories->firstItem() + $key }}</td>
                                    <td style="vertical-align:middle">{{ $category->name }}</td>
                                    <td style="vertical-align:middle">{{ $category->position }}</td>
                                    <td style="vertical-align:middle">
                                        @if($category->image)
                                            <img src="{{ $category->image }}" class="img-responsive" style="width:120px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td style="vertical-align:middle">{{ $category->status ? 'Enabled' : 'Disabled' }}</td>

                                    <td class="text-right" style="vertical-align:middle">
                                        <a href="{{route('admin.category.edit' , array('slug' => $category->slug, 'page' => $categories->currentPage()))}}" title="Edit a Category">
                                            <span class="fa fa-pencil-square-o fa-lg"></span>
                                        </a>
                                        <a href="{{route('admin.category.destroy' , array('slug' => $category->slug, 'page' => $categories->currentPage()))}}" title="Delete a Category" onclick="return confirm('Are you sure?')">
                                            <span class="fa fa-times fa-lg"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    @else
                        <h3 class="no-result">No record(s) found</h3>
                    @endif
                </div>
            </div>
        </div>

    <div class="col-md-6">
            @if(!isset($categoryEdit))
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add a Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-group" action="{{route('admin.category.store')}}" method="POST" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"  placeholder="Category Name" required>
                            </div>

                            <div class="form-group">
                                <label for="name_np">Name in Nepali</label>
                                <input type="text" class="form-control" id="name_np" name="name_np" value="{{ old('name_np') }}"  placeholder="Category Name in Nepali" required>
                            </div>

                            <div class="form-group">
                                <label for="position">Order</label>
                                <input type="number" class="form-control" id="position" name="position" value="{{ old('position') }}"  placeholder="Category Position" required>
                            </div>

                            <div class="form-group">
                                <label for="image_file">Icon</label>
                                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_file" name="image_file">
                                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
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
                        <h3 class="box-title">Edit a Category({{ $categoryEdit->name }})</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-group" action="{{route('admin.category.update', ['slug' => $categoryEdit->slug, 'page' => isset($_REQUEST['page']) ? $_REQUEST['page'] : null])}}" method="POST" enctype="multipart/form-data" role="form">
                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: $categoryEdit->name }}"  placeholder="Category Name" required>
                            </div>

                            <div class="form-group">
                                <label for="name_np">Name in Nepali</label>
                                <input type="text" class="form-control" id="name_np" name="name_np" value="{{ old('name_np') ?: $categoryEdit->name_np }}"  placeholder="Category Name in Nepali" required>
                            </div>

                            <div class="form-group">
                                <label for="position">Order</label>
                                <input type="number" class="form-control" id="position" name="position" value="{{ old('position') ?: $categoryEdit->position }}"  placeholder="Category Position" required>
                            </div>

                            <div class="form-group">
                                <label for="image_file">Icon</label>
                                @if($categoryEdit->image)
                                    <img class="img-responsive" src="{{ $categoryEdit->image }}" style="margin-bottom:10px;width:150px;">
                                @endif
                                <input type="file" accept="image/png, image/jpeg, image/jpg" id="image_file" name="image_file">
                                <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
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
                                            <input type="radio" name="status" id="yes_option" value="1" @if((old('status') ?: $categoryEdit->status) == 1) checked @endif>
                                            Enabled
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="status" id="no_option" value="0" @if((old('status') ?: $categoryEdit->status) == 0) checked @endif>
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

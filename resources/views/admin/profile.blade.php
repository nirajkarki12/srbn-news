@extends('layouts.admin')

@section('title', 'Profile')

@section('content-header', 'Profile')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-diamond"></i> Account</li>
@endsection

@section('content')

@include('notification.notify')


    <div class="row">

        <div class="col-md-4">

            <div class="box box-primary">

                <div class="box-body box-profile">

                    <img class="profile-user-img img-responsive img-circle" src="@if( $admin->picture) {{ $admin->picture}} @else {{asset('images/placeholder.jpg')}} @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                    <p class="text-muted text-center">Admin</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Full Name</b> <a class="pull-right">{{ $admin->name}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ $admin->email}}</a>
                        </li>

                    </ul>
                
                </div>

            </div>

        </div>

         <div class="col-md-8">
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#adminprofile" data-toggle="tab">Update Profile</a></li>
                    <li><a href="#password" data-toggle="tab">Change Password</a></li>
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="adminprofile">

                        <form class="form-horizontal" action="{{route('admin.profile.save')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $admin->id}}">

                            <div class="form-group">
                                <label for="name" required class="col-sm-2 control-label">Full Name</label>

                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="name"  name="name" value="{{ $admin->name}}" placeholder="Full Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                  <input type="email" required value="{{ $admin->email}}" name="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="password">

                        <form class="form-horizontal" action="{{route('admin.change.password')}}" method="POST" enctype="multipart/form-data" role="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{ $admin->id}}">

                            <div class="form-group">
                                <label for="old_password" class="col-sm-3 control-label">Old Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">New Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="password" id="password" placeholder="New Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>

                                <div class="col-sm-8">
                                  <input required type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
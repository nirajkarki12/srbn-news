@extends('layouts.admin')

@section('title', 'Settings')

@section('content-header', 'Site Configuration')

@section('breadcrumb')
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-cogs"></i> Settings</li>
@endsection

@section('content')

@include('notification.notify')


    <div class="row">

        <div class="col-md-4">

            <div class="box box-primary">

                <div class="box-body box-profile">

                    <img class="profile-user-img img-responsive img-circle" src="@if( Setting::get('site_logo_path')) {{ Setting::get('site_logo_path') }} @else {{asset('images/logo.png')}} @endif">

                    <h3 class="profile-username text-center">{{ Setting::get('site_name', 'SRBN News') }}</h3>
                    <p class="text-muted text-center">All Settings</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>General Settings</b> <a class="pull-right">Site Name, Tagline, Description</a>
                        </li>
                        <li class="list-group-item">
                            <b>Data Format</b> <a class="pull-right">Data Per Page, Date Format, Time Format</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

         <div class="col-md-8">
            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#generalConfig" data-toggle="tab">General</a></li>
                    <li><a href="#dataConfig" data-toggle="tab">Data Format</a></li>
                    <li><a href="#logoConfig" data-toggle="tab">Logo/Icons</a></li>
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="generalConfig">

                        <form class="form-horizontal" action="{{route('admin.config.save')}}" method="POST" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="site_name" required class="col-sm-2 control-label">Site Name</label>

                                <div class="col-sm-10">
                                  <input type="text" class="form-control" id="site_name"  name="site_name" value="{{ Setting::get('site_name', 'SRBN News') }}" placeholder="Site Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="site_tagline" class="col-sm-2 control-label">Tagline</label>

                                <div class="col-sm-10">
                                  <input type="text" id="site_tagline" name="site_tagline" value="{{ Setting::get('site_tagline', 'Buy & Sale') }}" class="form-control" placeholder="Tagline">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="site_description" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                    <textarea id="site_description" name="site_description" class="form-control" placeholder="Short Description">{{ Setting::get('site_description', '') }}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="logoConfig">

                        <form class="form-horizontal" action="{{route('admin.config.save')}}" method="POST" enctype="multipart/form-data" role="form">

                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="site_logo" required class="col-sm-2 control-label">Logo</label>

                                <div class="col-sm-10">
                                    <img class="img-responsive" src="@if( Setting::get('site_logo_path')) {{ Setting::get('site_logo_path') }} @else {{asset('images/logo.png')}} @endif" style="margin-bottom:10px;width:150px;">

                                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="site_logo" name="site_logo">
                                    <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="site_icon" required class="col-sm-2 control-label">Icon</label>

                                <div class="col-sm-10">
                                    <img class="img-responsive" src="@if( Setting::get('site_icon_path')) {{ Setting::get('site_icon_path') }} @else {{asset('images/logo.png')}} @endif" style="margin-bottom:10px;width:150px;">

                                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="site_icon" name="site_icon">
                                    <p class="help-block">Please enter .png .jpeg .jpg images only.</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane" id="dataConfig">
                        <form class="form-horizontal" action="{{route('admin.config.save')}}" method="POST" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="data_per_page" required class="col-sm-2 control-label">Data Per Page</label>

                                <div class="col-sm-10">
                                    <select class="form-control" id="data_per_page" name="data_per_page">
                                        <option @if(Setting::get('data_per_page') == '10') selected @endif value="10">10</option>
                                        <option @if(Setting::get('data_per_page') == '25') selected @endif value="25">25</option>
                                        <option @if(Setting::get('data_per_page') == '50') selected @endif value="50">50</option>
                                        <option @if(Setting::get('data_per_page') == '100') selected @endif value="100">100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_format" class="col-sm-2 control-label">Date Format</label>
                                
                                <div class="col-sm-10">
                                    <select class="form-control" id="date_format" name="date_format">
                                        <option @if(Setting::get('date_format') == 'j F, Y') selected @endif value="j F, Y">{{ date('j F, Y') }}</option>
                                        <option @if(Setting::get('date_format') == 'd/m/Y') selected @endif value="d/m/Y">{{ date('d/m/Y') }}</option>
                                        <option @if(Setting::get('date_format') == 'd-m-Y') selected @endif value="d-m-Y">{{ date('d-m-Y') }}</option>
                                        <option @if(Setting::get('date_format') == 'Y/m/d') selected @endif value="Y/m/d">{{ date('Y/m/d') }}</option>
                                        <option @if(Setting::get('date_format') == 'Y-m-d') selected @endif value="Y-m-d">{{ date('Y-m-d') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_format" class="col-sm-2 control-label">Time Format</label>
                                
                                <div class="col-sm-10">
                                    <select class="form-control" id="time_format" name="time_format">
                                        <option @if(Setting::get('time_format') == 'H:i') selected @endif value="H:i">{{ date('H:i') }}</option>
                                        <option @if(Setting::get('time_format') == 'h:i a') selected @endif value="h:i a">{{ date('h:i a') }}</option>
                                        <option @if(Setting::get('time_format') == 'h:i A') selected @endif value="h:i A">{{ date('h:i A') }}</option>
                                    </select>
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
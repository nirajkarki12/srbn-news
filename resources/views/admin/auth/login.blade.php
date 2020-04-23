@extends('layouts.admin.focused')

@section('title', 'Login')

@section('content')
   <div class="login-box-body" style="height:275px">
      <form class="form-layout" role="form" method="POST" action="{{ route('admin.login.post') }}">
         {{ csrf_field() }}

         <p class="text-center mb30"></p>

         <div class="form-inputs">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <input type="email" class="form-control input-lg" name="email" placeholder="Email" value="{{Setting::get('demo_admin_email')}}">
              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

              <input type="password" class="form-control input-lg" name="password" placeholder="Password" value="{{Setting::get('demo_admin_password')}}">

              @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif

            </div>
         </div>

         <div class="col-md-6 col-md-offset-3">
             <button class="btn btn-success btn-block mb15" type="submit">
                 <h5><span><i class="fa fa-btn fa-sign-in"></i> Login</span></h5>
             </button>
         </div>

     </form>
   </div>
        
@endsection

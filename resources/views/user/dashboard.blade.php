@extends('layouts.user-dashboard')

@section('content')
 <div class="row justify-content-center">
     @include('notification.notify')
     <div class="col-md-12">
         
         <div class="card">
             <div class="card-header">Dashboard</div>

             <div class="card-body">
                 @if (session('status'))
                     <div class="alert alert-success" role="alert">
                         {{ session('status') }}
                     </div>
                 @endif

                 You are logged in!
             </div>
         </div>
     </div>
 </div>
@endsection

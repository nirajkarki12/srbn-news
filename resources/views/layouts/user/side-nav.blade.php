<aside>
   <div class="inner-box">
      <div class="user-panel-sidebar">

         <div class="card mb-3">
             <div class="card-header">My Ads</div>

             <div class="card-body">
               <ul class="side-nav">
                  <li>
                     <a href="{{ route('user.post.create') }}" class="@if(Route::is('user.post.create')) active @endif" title="Post New Ad">
                        <i class="fas fa-plus-circle"></i> Post New Ad
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('user.post') }}" class="@if(Route::is('user.post')) active @endif" title="My Ads">
                        <i class="fas fa-shopping-cart"></i> My Ads
                        <span class="badge badge-pill">
                           0
                        </span>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="" title="Watch Lists">
                        <i class="fas fa-heart"></i> Watch Lists
                        <span class="badge badge-pill">
                           1
                        </span>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="" title="View your Conversations">
                        <i class="far fa-comments"></i> Conversations
                        <span class="badge badge-pill">
                           0
                        </span>
                     </a>
                  </li>

                  <li>
                     <a href="#" class="" title="Sold out Ads">
                        <i class="fas fa-box-open"></i> Sold Out Ads
                        <span class="badge badge-pill">
                           0
                        </span>
                     </a>
                  </li>
                  <li>
                     <a href="#" class="" title="Archived Ad">
                        <i class="fas fa-trash-alt"></i> Archived Ad
                        <span class="badge badge-pill">
                           0
                        </span>
                     </a>
                  </li>
               </ul>
            </div>
         </div>

         <div class="mt-2 card">
             <div class="card-header">Account</div>

             <div class="card-body">
               <ul class="side-nav">
                  <li>
                     <a href="{{ route('user.profile')}}" class="text-info @if(Route::is('user.profile')) active @endif" title="Edit my Profile">
                        <i class="fas fa-user-circle"></i> Edit my Profile
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('user.change-password') }}" class="text-info @if(Route::is('user.change-password')) active @endif" title="Change Password">
                        <i class="fas fa-lock"></i> Change Password
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-info" title="Log out">
                        <i class="fas fa-sign-out-alt"></i> Log out
                     </a>
                  </li>
                  <li>
                     <a href="javascript:void(0)" id="confirm-box" data-redirect-to="{{ route('user.profile') }}" data-msg="Are your sure want to Delete your Account?" class="text-danger" title="Delete your account">
                        <i class="far fa-frown"></i> Delete my account
                     </a>
                  </li>
               </ul>
             </div>
         </div>

      </div>
   </div>
</aside>
 <!-- onclick="showConfirmationBox('Are you sure want to Delete your account?')" -->

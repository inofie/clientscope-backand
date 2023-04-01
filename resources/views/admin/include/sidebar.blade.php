@include('admin.modal.privacy-policy')
@include('admin.modal.terms-conditions')
@if( !empty(get_user()->UserRole->slug) )
<nav id="sidebar" class="active pt-4">
   <ul class="components mb-5 navbar-nav mod-side-bar">
      <li class="nav-item text-center pb-3 gray non-active text-center {{ Request::url() == route('admin.dashboard')  ? 'side-active' : '' }}">
         <a class="nav-link gray" data-name="{{ route('admin.dashboard') }}" href="{{ route('admin.dashboard')  }}">
            <img class="non-active-icon static-img" src="{{ asset('assets/images/dasboard.png')}}" alt="">
            <img class="active-icon active-img" src="{{ asset('assets/images/dasboard-active.png')}}" alt="">
            <p> Dashboard</p>
         </a>
      </li>
      @if( get_user()->UserRole->slug != 'super-admin' )
         
         <li class="nav-item text-center pb-3 gray non-active {{ Request::url() == route('admin.map')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.map') }}" class="nav-link gray" href="{{ route('admin.map')  }}">
            <img class="non-active-icon static-img" src="{{ asset('assets/images/map.png')}}" alt="">
            <img class="active-icon active-img" src="{{ asset('assets/images/map-active.png')}}" alt="">
               <p>Map</p>
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray non-active {{ Request::url() == route('admin.user-pin')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.user-pin') }}" class="nav-link gray" href="{{ route('admin.user-pin') }}">
            <img class="non-active-icon static-img" src="{{ asset('assets/images/list.png')}}" alt=""> 
            <img class="active-icon active-img" src="{{ asset('assets/images/list-active.png')}}" alt=""> 
             <p>List</p>
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray non-active {{ Request::url() == route('admin.calender')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.calender') }}" class="nav-link gray" href="{{ route('admin.calender') }}">
            <img class="non-active-icon static-img" src="{{ asset('assets/images/calender.png')}}" alt="" > 
            <img class="active-icon active-img" src="{{ asset('assets/images/calender-active.png')}}" alt="">         
               <p>Calendar</p>
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray  non-active {{ Request::url() == route('admin.chat')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.chat') }}" class="nav-link gray" href="{{ route('admin.chat') }}">
               <img class="non-active-icon static-img" src="{{ asset('assets/images/message.png')}}" alt="">
               <img class="active-icon active-img" src="{{ asset('assets/images/message-active.png')}}" alt="">
             <p>Messages</p>
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray slide-toggle non-active">
            <a class="nav-link gray">
            <img class="non-active-icon static-img" src="{{ asset('assets/images/setting.png')}}" alt="">
            <img class="active-icon active-img" src="{{ asset('assets/images/setting-active.png')}}" alt="">
               <p>Settings</p>
            </a>
            <div class="menu-box" style="display:none;">
               <div id="accordion">
                  @if( !empty(get_user()->user_meta['is_administrator']) || get_user()->UserRole->slug == 'company' )
                     <div class="card">
                        <div class="card-header">
                           <p class="mb-2 mt-2 white accordion-menu" data-toggle="collapse" data-target="#pinSettings" aria-expanded="false" aria-controls="pinSettings">
                              Pin Settings
                           </p>
                        </div>
                        <div id="pinSettings" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <ul>
                                 <li><a data-name="{{ route('admin.custom-fields') }}" href="{{ route('admin.custom-fields') }}">Fields</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  @endif
                  @if( !empty(get_user()->user_meta['is_administrator']) || !empty(get_user()->user_meta['manage_user']) || get_user()->UserRole->slug == 'company' )
                     <div class="card">
                        <div class="card-header">
                           <p class="mb-2 mt-2 white accordion-menu" data-toggle="collapse" data-target="#usersMenu" aria-expanded="false" aria-controls="usersMenu">
                              Users
                           </p>
                        </div>
                        <div id="usersMenu" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <ul>
                              <li><a data-name="{{ route('admin.manage-user') }}" href="{{ route('admin.manage-user') }}">User Management</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  @endif
                  @if( !empty(get_user()->user_meta['is_administrator']) || !empty(get_user()->user_meta['can_import_pin']) || get_user()->UserRole->slug == 'company' )
                     <div class="card">
                        <div class="card-header">
                           <p class="mb-2 mt-2 white accordion-menu" data-toggle="collapse" data-target="#importData" aria-expanded="false" aria-controls="importData">
                              Import Data
                           </p>
                        </div>
                        <div id="importData" class="collapse" data-parent="#accordion">
                           <div class="card-body">
                              <ul>
                                 <li><a data-name="{{ route('admin.import-history') }}" href="{{ route('admin.import-history') }}">Import</a></li>
                                 <li><a data-name="{{ route('admin.history-data') }}" href="{{ route('admin.history-data') }}">History</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  @endif
                  <div class="card">
                     <div class="card-header">
                        <p class="mb-2 mt-2 white accordion-menu" data-toggle="collapse" data-target="#accountMenu" aria-expanded="false" aria-controls="accountMenu">
                           Account
                        </p>
                     </div>
                     <div id="accountMenu" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           <ul>
                              @if( !empty(get_user()->user_meta['is_administrator']) || get_user()->UserRole->slug == 'company' )
                                 <li><a data-name="{{ route('admin.account-details') }}" href="{{ route('admin.account-details') }}">Account Details</a></li>
                              @endif
   {{--                           <li><a href="#">Notification</a></li>--}}
                              <li><a data-name="{{ route('admin.leader-board') }}" href="{{ route('admin.leader-board') }}">Leader board</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-header">
                        <p class="mb-2 mt-2 white accordion-menu" data-toggle="collapse" data-target="#aboutMenu" aria-expanded="false" aria-controls="aboutMenu">
                           About
                        </p>
                     </div>
                     <div id="aboutMenu" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                           <ul>
                           <li><a data-name="{{ route('admin.faq') }}" href="{{ route('admin.faq') }}">Help & FAQs</a></li>
                           <li><a  href="{{ URL::to('admin/terms-condition/index') }}">Privacy Policy</a></li>
                           <li><a  href="{{ URL::to('admin/privacy-policy/index') }}">Terms of Use</a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </li>
         @if( !empty(get_user()->user_meta['is_administrator']) || get_user()->UserRole->slug == 'company' )
            <li class="nav-item text-center pb-3 gray  non-active {{ Request::url() == route('admin.statuses')  ? 'active' : '' }}">
               <a data-name="{{ route('admin.statuses') }}" class="nav-link gray" href="{{ route('admin.statuses') }}">
               <img class="non-active-icon static-img" src="{{ asset('assets/images/maps-and-flags.png')}}" alt="">
               <img class="active-icon active-img" src="{{ asset('assets/images/status-active.png')}}" alt="">
              <p> Statuses</p>
               </a>
            </li>
		    <li class="nav-item text-center pb-3 gray  non-active {{ Request::url() == route('admin.company-sales')  ? 'active' : '' }}">
			  <a data-name="{{ route('admin.company-sales') }}" class="nav-link gray" href="{{ route('admin.company-sales') }}">
			  <!-- <span class="fa fa-bullseye mb-2"></span> -->
           <img class="non-active-icon static-img" src="{{ asset('assets/images/sale-manager.png')}}" alt="">
           <img class="active-icon active-img" src="{{ asset('assets/images/sale-active.png')}}" alt="">
			  <p>Sales Plan</p>
			  </a>
		    </li>
         @endif
		   @if( !empty(get_user()->user_meta['is_administrator']) || get_user()->UserRole->slug == 'team-lead' || get_user()->UserRole->slug == 'company' )
			 <li class="non-active">
				<a data-name="{{ route('admin.user-track') }}" class="nav-link gray" href="{{ route('admin.user-track') }}">
               <img class="non-active-icon static-img" src="{{ asset('assets/images/track.png')}}" alt="">
               <img class="active-icon active-img" src="{{ asset('assets/images/track-active.png')}}" alt="">
				  <p>User Track</p>
				</a>
			 </li>
		   @endif
         @if( get_user()->UserRole->slug == 'company' )
            <li class="non-active">
               <a data-name="{{ route('admin.team') }}" class="nav-link gray" href="{{ route('admin.team') }}">
                  <img class="non-active-icon static-img" src="{{ asset('assets/images/team-management.png')}}" alt="">
                  <img class="active-icon active-img" src="{{ asset('assets/images/team-management-active.png')}}" alt="">
                 <p>Team management</p>
               </a>
			   </li>	
         @endif    
      @else 
         {{-- master admin sidebar --}}
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.user.company')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.user.company') }}" class="nav-link gray" href="{{ route('admin.user.company')  }}">
            <span class="fa fa-industry mb-2"></span>
               Company
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.user.team-lead')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.user.team-lead') }}" class="nav-link gray" href="{{ route('admin.user.team-lead')  }}">
            <span class="fa fa-users mb-2"></span>
               Team Lead
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.user.sale-reps')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.user.sale-reps') }}" data-name="{{ route('admin.user.sale-reps') }}" class="nav-link gray" href="{{ route('admin.user.sale-reps')  }}">
            <span class="fa fa-users mb-2"></span>
               Sale Representative
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.subscription.index')  ? 'active' : '' }}">
            <a data-name="{{ route('admin.subscription.index') }}" class="nav-link gray" href="{{ route('admin.subscription.index')  }}">
            <span class="fa fa-id-card mb-2"></span>
               Subscriptions
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.package.index')  ? 'active' : '' }}">
            <a class="nav-link gray" data-name="{{ route('admin.package.index') }}" href="{{ route('admin.package.index')  }}">
            <span class="fa fa-money mb-2"></span>
               Packages
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin.transactions.index')  ? 'active' : '' }}">
            <a class="nav-link gray" data-name="{{ route('admin.transactions.index') }}" href="{{ route('admin.transactions.index')  }}">
            <span class="fa fa-money mb-2"></span>
               Transactions
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin-faq-index')  ? 'active' : '' }}">
            <a class="nav-link gray" data-name="{{ route('admin-faq-index') }}" href="{{ route('admin-faq-index')  }}">
            <span class="fa fa-question-circle mb-2"></span>
               FAQ's
            </a>
         </li>
         <li class="nav-item text-center pb-3 gray {{ Request::url() == route('admin-content-index')  ? 'active' : '' }}">
            <a class="nav-link gray" data-name="{{ route('admin-content-index') }}" href="{{ route('admin-content-index')  }}">
            <span class="fa fa-edit mb-2"></span>
               Content Management
            </a>
         </li>
      @endif   
   </ul>
</nav>
@endif


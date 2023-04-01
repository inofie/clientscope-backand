<nav class="navbar navbar-expand-md navbar-light bg-nav container-fluid">
    <a class="navbar-brand m-0 p-0" href="{{ route('admin.dashboard') }}"><img class="img-fluid" src="{{ base_url('/assets/images/logo.png')}}" style="height:43px;width: 175px;" /></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-top ml-auto align-items-lg-center">
            @if( get_user()->UserRole->slug != 'super-admin' )
                @if( !empty(get_user()->UserRole->slug) )
                    @if( get_user()->UserRole->slug == 'company' || !empty(get_user()->user_meta['is_administrator']) || !empty(get_user()->user_meta['manage_user']) )
                        <li class="nav-item active">
                            <a class="nav-link _add_user" href="{{ route('admin.add-user') }}" data-target="#addUser">
                              <button class="btn btn-black  d-flex align-items-center btn-theme white-color-hover">
                                <img src="{{ asset('assets/images/ic_person_add.png')}}" alt="" class="pr-2 img-fluid"> Add User</button>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link _add_pin" href="{{ route('admin.add-pin') }}"  data-target="#addPin">
                          <button class="btn btn-black  d-flex align-items-center btn-theme white-color-hover">
                           <img src="{{ asset('assets/images/ic_add_location.png')}}" alt="" class="pr-2 img-fluid">
                           Add Pin
                          </button>
                        </a>
                    </li>
                    <li class="nav-item dropdown mr-3 ml-1">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                          <span class="bell d-flex align-items-center justify-content-center btn-color"><i class="fa fa-bell"></i></span>
                        </a>
                      <div style="max-height:415px; overflow-y:scroll;" class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="notificationDropdown">
                          <div id="notification_list"></div>
                          <div id="notification_pagination"></div>
                      </div>
                    </li>
                @endif
            @endif
            <li class="nav-item user-drop-down dropdown d-flex align-items-center">
              <div class="user-profile-pic">
                  <img src="{{ asset('assets/images/user-img.jpg') }}" alt="{{ get_user()->name }}">
                </div>
                <a class="nav-link dropdown-toggle dropdown-icon font-20 btn-color" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ get_user()->name }}
                </a>
                
                <div class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#editProfile">View or edit profile</a>
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#changePassword">Change Password</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
   
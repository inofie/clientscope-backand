@extends('admin.master') 
@section('content')
     @include('admin.include.navbar')
        <div class="wrapper d-flex align-items-stretch">
            @include('admin.include.sidebar')
            <div id="content" class="p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="heading2 font-30 color-f58719">Manage Users</h5>
                    </div>
                    <div class="col-12">
                        <div class="table-header mt-5">
                            <div>
                                <div class="chat-detail d-flex align-items-center">
                                    <div>
                                        <div class="other-chat-img">
                                            <img src="{{ get_user()->image_url }}" title="{{ get_user()->name }}" alt="{{ get_user()->name }}" />
                                        </div>
                                    </div>
                                    <div class="other-user-names ml-3 chat-time">
                                        <h2 class="font-18">{{ get_user()->name }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="input-group territories-input user-search">
                                    <input type="text" name="search" class="form-control manage-input autocomplete" placeholder="Find people and conversations" autocomplete="off" />
                                    <div class="search-icon manage-icon">
                                        <span>
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="manage-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="w-20">Profile</th>
                                        <th scope="col" class="w-20">Status</th>
                                        <th class="w-60"></th>
                                    </tr>
                                </thead>
                                <tbody id="manage_user">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('scripts')
            <script src="{{ asset('assets/admin/js/manage-user.js') }}"></script>
        @endpush 
@endsection
</div>
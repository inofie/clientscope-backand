@extends('admin.master')
@section('content')
    @include('admin.include.navbar')
    <div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
        <div id="content" class="p-4">
            <div class="row pb-3">
                <div class="col-md-6">
                    <h4 class="font-weight-bold">User Subscriptions List</h4>
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="GET">
                        <div class="input-group mb-3 pull-right">
                            <input name="keyword" type="text" class="form-control filter_keyword" placeholder="Search" value="{{ \Request::input('keyword') }}">
                            <div class="input-group-append">
                                <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Mobile No</th>
                        <th>Package Name</th>
                        <th>Package Status</th>
                        <th>Expire Date</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if( count($UserSubscriptions) )
                            @foreach( $UserSubscriptions as $UserSubscription )
                                <tr>
                                    <td>{{ $UserSubscription->name }}</td>
                                    <td>{{ $UserSubscription->mobile_no }}</td>
                                    <td>{{ $UserSubscription->title }}</td>
                                    <td>{{ $UserSubscription->status }}</td>
                                    <td>{{ $UserSubscription->expire_date }}</td>
                                    <td>{{ date(config('constants.ADMIN_DATE_TIME_FORMAT'),strtotime($UserSubscription->created_at)) }}</td>
                                    <td><a id="{{ $UserSubscription->id }}" data-id="{{ $UserSubscription->expire_date }}"  class="_edit_admin_subscription_btn btn btn-warning" href="#"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No record found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{-- {{ $companies->appends($_GET)->links() }} --}}
            </div>
        </div>
    </div>
@include('admin.modal.edit-subscription')
@push('scripts')
<script>
    $('._edit_admin_subscription_btn').click( function(e){
        e.preventDefault();
        let subscription_id = $(this).attr('id');
        let expire_date = $(this).data('id');
        $('input[name="subscription_id"]').val(subscription_id);
        $('input[name="expire_date"]').val(expire_date);
        $('#edit_admin_subscription_modal').modal('show');
    })
</script>
@endpush
@endsection
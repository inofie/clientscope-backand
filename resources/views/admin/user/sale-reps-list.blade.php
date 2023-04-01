@extends('admin.master')
@section('content')
<style>
.pagination li {
    position: relative;
    display: block;
    padding: 10px 10px;
}

.input-group .form-control {
    border-left: 1px solid #ced4da;
}
</style>
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-4">
        <div class="row pb-3">
            <div class="col-md-6">
                <h4 class="font-weight-bold">Sale Representative Listing</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form method="GET">
                    <div class="input-group mb-3 pull-right">
                        <input name="keyword" type="text" class="form-control filter_keyword" placeholder="Search"
                            value="{{ \Request::input('keyword') }}">
                        <div class="input-group-append">
                            <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( count($salesReps) )
                            @foreach( $salesReps as $saleRep )
                            <tr>
                                <td>{{ $saleRep->company }}</td>
                                <td>{{ $saleRep->name }}</td>
                                <td>{{ $saleRep->email }}</td>
                                <td>{{ $saleRep->mobile_no }}</td>
                                @if( $saleRep->status_id == 1 )
                                <td><span class="text-success">{{ $saleRep->status }}</span></td>
                                @else
                                <td><span class="text-danger">{{ $saleRep->status }}</span></td>
                                @endif
                                <td>{{ date(config('constants.ADMIN_DATE_TIME_FORMAT'),strtotime($saleRep->created_at)) }}
                                </td>
                                <td><a id="{{ $saleRep->id }}" class="_edit_admin_user_btn btn btn-warning" href="#"><i
                                            class="fa fa-edit"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7">No record found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Total {{ $salesReps->total() }} entries</p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                                {{ $salesReps->appends($_GET)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.edit-admin-user')
@push('scripts')
<script>
$('._edit_admin_user_btn').click(function(e) {
    e.preventDefault();
    let user_id = $(this).attr('id');
    $('input[name="user_id"]').val(user_id);
    $('#edit_admin_user_modal').modal('show');
})
</script>
@endpush
@endsection
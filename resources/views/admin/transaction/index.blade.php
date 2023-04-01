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
                    <h4 class="font-weight-bold">Transactions Listing</h4>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form method="GET">
                        <div class="input-group mb-3 pull-right">
                            <input name="keyword" 
                             class="form-control filter_keyword" placeholder="Search" value="{{ \Request::input('keyword') }}">
                            <div class="input-group-append">
                                <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has("success"))
                        <div class="alert alert-primary" role="alert">
                            {{Session::get("success")}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Getway Type</th>
                                <th>Module Name</th>
                                <th>Package Name</th>
                                <th>Amount</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if( count($transactions) )
                                    @foreach( $transactions as $transaction )

                                        <tr>
                                            <td>{{ $transaction->name }}</td>
                                            <td>{{ $transaction->gateway_type }}</td>
                                            <td>{{ $transaction->module }}</td>
                                            <td>{{ $transaction->title }}</td>
                                            <td>{{ $transaction->amount }}</td>
                                            <td>{{ date(config('constants.ADMIN_DATE_TIME_FORMAT'),strtotime($transaction->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No record found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <p>Total {{ $transactions->total() }} entries</p> --}}
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    {{-- {{ $transactions->appends($_GET)->links() }} --}}
                                </div>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('._edit_admin_user_btn').click( function(e){
                e.preventDefault();
                let user_id = $(this).attr('id');
                $('input[name="user_id"]').val(user_id);
                $('#edit_admin_user_modal').modal('show');
            })
        </script>
    @endpush
@endsection
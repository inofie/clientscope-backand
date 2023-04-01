@extends('admin.master')
@section('content')
    @include('admin.include.navbar')
    <div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
        <div id="content" class="p-4">
            <div class="row pb-3">
                <div class="col-md-6">
                    <h4 class="font-weight-bold">Subscription Package Listing</h4>
                </div>
            </div>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Month Per User ($)</th>
                        <th>Trial Period (Days)</th>
                        <th>Discount (%)</th>
                        <th>Minimum User Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if( count($packages) )
                            @foreach( $packages as $package )
                                <tr>
                                    <td>{{ $package->title }}</td>
                                    <td>{!! nl2br($package->description) !!}</td>
                                    <td>{{ $package->month_per_user_amount }}</td>
                                    <td>{{ $package->trial_period }}</td>
                                    <td>{{ $package->discount }}</td>
                                    <td>{{ $package->minimum_user_discount }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">No record found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
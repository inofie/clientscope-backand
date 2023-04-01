@extends('admin.master')
@section('content')
@include('admin.include.navbar')
<div class="wrapper d-flex align-items-stretch">
    @include('admin.include.sidebar')
    <div id="content" class="p-4">
        <div class="row pb-3">
            <div class="col-md-6">
                <h4 class="font-weight-bold">User List</h4>
            </div>
            <div class="col-md-6 text-lg-right">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#addCompany"><button
                        class="btn btn-black">Add Company</button></a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
{{--@include('admin.modal.add-company')--}}
@endsection
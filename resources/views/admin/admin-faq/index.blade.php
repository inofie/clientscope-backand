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
                    <h4 class="font-weight-bold">FAQ Listing</h4>
                </div>
                <div class="col-md-6 pull-right">
                    <a href="javascript:void(0)" class="pull-right" data-toggle="modal" data-target="#addCompanyFAQ">
                        <button class="btn btn-black company-btn">Add FAQ</button>
                    </a>
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
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               @if( count($faqs) )
                                    @foreach( $faqs as $faq )
                                        <tr>
                                            <td>{{ $faq->question }}</td>
                                            <td>{{ $faq->answer }}</td>
                                            <td><a id="{{ $faq->id }}" class="_delete_faq" href="javascript:void(0);"><i class="fa fa-trash"></i></a></td>
                                        </tr>
                                    @endforeach    
                               @else
                                    <tr>
                                        <td colspan="3">No Data Found</td>
                                    </tr>
                               @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modal.add-admin-faq')
    @push('scripts')
        <script>
            $('._delete_faq').click( function(e){
                e.preventDefault();
                let ele    = $(this);
                let faq_id = $(this).attr('id');
                var msg = confirm('Are you sure you want to continue?');
                if( msg ){
                    $.ajax({
                        type:'POST',
                        url: '{{ route("admin-faq-delete") }}',
                        data:{faq_id:faq_id},
                        success: function(data){
                            ele.parent().parent().remove();        
                        }
                    });
                } else {
                    return false
                }
            })
        </script>
    @endpush
@endsection
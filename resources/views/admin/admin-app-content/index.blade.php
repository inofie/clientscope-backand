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
                    <h4 class="font-weight-bold">App Content Listing</h4>
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
                                <th>Identifier</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                               @if( count($getContents) )
                                    @foreach( $getContents as $content )
                                        <tr>
                                            <td>{{ $content->identifier }}</td>
                                            <td>
                                                <p id="content{{ $content->id }}" class="d-none">{{ $content->content }}</p>
                                                <a id="{{ $content->id }}" class="_edit_content" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>
                                            </td>
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
    <div id="_edit_content_container"></div>
    @push('scripts')
        <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
        <script>
            $('._edit_content').click( function(e){
                e.preventDefault();
                let ele    = $(this);
                let content_id = $(this).attr('id');
                $.ajax({
                    type:'GET',
                    url: '{{ route("admin-content-edit") }}',
                    data: { content_id:content_id },
                    success: function(res){
                        $('#_edit_content_container').html(res);   
                        $('#edtCompanyContent').modal('show');             
                    }
                });
            })
        </script>
    @endpush
@endsection
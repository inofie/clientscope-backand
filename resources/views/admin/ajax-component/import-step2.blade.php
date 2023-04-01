<form method="POST" id="step_2_form">
    <div class="card-body">
        <div class="d-flex configDetails">
            @foreach( $data as $key => $values )
                <div class="importBox p-3 border-green">
                    <div class="form-group">
                        <label>Column: {{ $key }}</label>
                    </div>
                    {{--<div class="form-group d-flex">--}}
                    {{--<div><button class="btn btn-primary ft-14">Ignore</button></div>--}}
                    {{--<div class="pl-2 align-self-center ft-14">csv title: {{ $key }}</div>--}}
                    {{--</div>--}}
                    <div class="importFields">
                        @foreach( $values as $value )
                            <div class="ft-14">
                                <input type="text" name="{{ $key . '[]'  }}" class="form-control" value="{{ $value }}">
                                <hr class="hr"/>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="button" id="step_2_btn" class="btn btn-save mt-2 text-capitalize ml-3 mb-2">Next</button>
            </div>
        </div>
    </div>
</form>
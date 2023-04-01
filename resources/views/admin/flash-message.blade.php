@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if( Session::has('error') )
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif
@if( Session::has('success') )
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
@if( Session::has('info') )
    <div class="alert alert-info">
        {{ Session::get('info') }}
    </div>
@endif
@if( Session::has('warning') )
    <div class="alert alert-warning">
        {{ Session::get('warning') }}
    </div>
@endif
@if( Session::has('api_error') )
    <div class="alert alert-danger">
        <ul>
            @foreach( Session::get('api_error') as $errors )
                <li>{{ $errors }}</li>
            @endforeach
        </ul>
    </div>         
@endif
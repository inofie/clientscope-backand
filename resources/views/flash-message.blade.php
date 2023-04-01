@if(Session::has('errors'))
   <div class="alert alert-danger">
       @foreach( Session::get('errors') as $errors )
           <p>{{ $errors }}</p>
       @endforeach
   </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif
@if(Session::has('info'))
    <div class="alert alert-info">
        <p>{{ Session::get('info') }}</p>
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning">
        <p>{{ Session::get('warning') }}</p>
    </div>
@endif
<div id="ajax-error" class="alert alert-danger" style="display: none;"></div>
<div id="ajax-success" class="alert alert-success" style="display: none;"></div>
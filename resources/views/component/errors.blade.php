@if(Session::has('errors'))
    <div class="alert alert-danger">
        {{ Session::get('errors') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif
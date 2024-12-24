<div class="clear-both"></div>

@if(!empty(session('success')))
    <div class="alert alert-success alert-dismiss mt-1" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(!empty(session('error')))
    <div class="alert alert-danger alert-dismiss" role="alert">
        {{ session('error') }}
    </div>
@endif

@if(!empty(session('payment-error')))
    <div class="alert alert-error alert-dismiss" role="alert">
        {{ session('payment-error') }}
    </div>
@endif

@if(!empty(session('warning')))
    <div class="alert alert-warning alert-dismiss" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if(!empty(session('info')))
    <div class="alert alert-info alert-dismiss" role="alert">
        {{ session('info') }}
    </div>
@endif

@if(!empty(session('secondary')))
    <div class="alert alert-secondary alert-dismiss" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if(!empty(session('primary')))
    <div class="alert alert-primary alert-dismiss" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if(!empty(session('light')))
    <div class="alert alert-light alert-dismiss" role="alert">
        {{ session('light') }}
    </div>
@endif

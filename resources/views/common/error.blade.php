@if ($errors->any())
    <div class="container">
        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
    </div>
@endif
@if(session()->has('success_message'))
    <div class="container">
        <div class="alert alert-success" role="alert">{!! session('success_message') !!}</div>
    </div>
@endif
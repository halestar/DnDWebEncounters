@if ($errors->any())
    <div class="container">
        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
    </div>
@endif
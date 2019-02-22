@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="alert alert-danger">
                        <h1>Restration Temporarily Closed!</h1>
                        <p>Registration is temporarily closed while the system is on BETA.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

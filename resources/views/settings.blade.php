@extends('layouts.app')

@section('content')
<form action="{{ route('settings.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="card">
            <div class="card-header">
                User Settings
            </div>
            <div class="card-body">
                <h3>Personal Information</h3>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="email_label">EMail:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="email" aria-label="email" aria-describedby="email_label" name="email" disabled aria-disabled="true" value="{{$user->email}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="name_label">Name:</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="name_label" name="name" value="{{$user->name}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="password_label">New Password:</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password_label" name="password">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="confirm_password_label">Confirm Password:</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="confirm_password_label" name="password_confirmation">
                </div>
                <h3>Account Settings</h3>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload Avatar:</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                        <label class="custom-file-label" for="avatar">Choose file</label>
                    </div>
                </div>

                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="1"
                            id="monster_initiative"
                            name="monster_initiative"
                            @if($user->monster_initiative) checked @endif
                    >
                    <label class="form-check-label" for="monster_initiative">
                        Default to Assign Individual Monster Initiative
                    </label>
                </div>

                <div class="form-check">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value="1"
                            id="monster_hp"
                            name="monster_hp"
                            @if($user->monster_hp) checked @endif
                    >
                    <label class="form-check-label" for="monster_hp">
                        Default to Assign Individual Monster HP
                    </label>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-block">Save Setttings</button>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
    <script>
        jQuery(document).ready(function(){
            bsCustomFileInput.init();
        })
    </script>
@endpush
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Add New User
                        </div>
                        <div class="card-body">
                            <h3>Personal Information</h3>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="email_label">EMail:</span>
                                </div>
                                <input type="text" class="form-control" placeholder="E-Mail" aria-label="E-Mail"
                                       aria-describedby="email_label" name="email">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="name_label">Name:</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                       aria-describedby="name_label" name="name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="password_label">Password:</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Password" aria-label="Password"
                                       aria-describedby="password_label" name="password">
                            </div>
                            <h3>Account Settings</h3>
                            <div class="form-check mb-3 mt-3">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    id="make_admin"
                                    name="make_admin"
                                >
                                <label class="form-check-label" for="make_admin">
                                    User is an Administrator
                                </label>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="avatar_url_label">Avatar URL:</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Avatar URL" aria-label="Avatar URL"
                                       aria-describedby="avatar_url_label" name="avatar_url">
                            </div>

                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    id="monster_initiative"
                                    name="monster_initiative"
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
                                >
                                <label class="form-check-label" for="monster_hp">
                                    Default to Assign Individual Monster HP
                                </label>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Add New User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

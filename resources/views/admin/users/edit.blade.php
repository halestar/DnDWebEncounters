@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Edit User "{{ $user->name }}"
                    </div>
                    <div class="card-body">
                        <h3>Personal Information</h3>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email_label">EMail:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="email" aria-label="email" aria-describedby="email_label" name="email" value="{{$user->email}}">
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
                            <input type="text" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password_label" name="password">
                        </div>
                        <h3>Account Settings</h3>
                        <div class="form-check mb-3 mt-3">
                            <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    id="make_admin"
                                    name="make_admin"
                                    @if($user->hasPermissionTo('admin'))
                                    checked
                                    @endif
                            >
                            <label class="form-check-label" for="make_admin">
                                User is an Administrator
                            </label>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="avatar_url_label">Avatar URL:</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Avatar URL" aria-label="Avatar URL" aria-describedby="avatar_url_label" name="avatar_url" value="{{ $user->avatar_url }}">
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

                        <h3>Statistics</h3>

                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    Player entered
                                    <span class="badge badge-primary badge-pill">{{ $user->players()->count() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    PC's entered
                                    <span class="badge badge-primary badge-pill">{{ \App\Players\Pc::select('characters.*')->join('players', 'characters.player_id', '=', 'players.id')->where('players.user_id', '=', $user->id)->count() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    Custom Monsters entered
                                    <span class="badge badge-primary badge-pill">{{ $user->customMonsters()->count() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    Monster Tokens entered
                                    <span class="badge badge-primary badge-pill">{{ $user->monsterTokens()->count() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    Modules entered
                                    <span class="badge badge-primary badge-pill">{{ $user->modules()->count() }}</span>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    Encounters entered
                                    <span class="badge badge-primary badge-pill">{{ $user->encounters()->count() }}</span>
                                </div>
                            </li>
                        </ul>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="nav nav-tabs mb-5">
            <li class="nav-item">
                <a class="nav-link @if(app('request')->is('admin/users*')) active @endif" href="{{ route('admin.users') }}">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" @if(app('request')->is('admin/permissions*')) active @endif href="{{ route('admin.permissions') }}">Permissions</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active">
                @yield('admin_content')
            </div>
        </div>
    </div>
@endsection
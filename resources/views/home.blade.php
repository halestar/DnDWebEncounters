@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Adventure Manager</div>
                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Auth::user()->canStartAdventure())
                        @if($lastActiveSession != null)
                            <div class="alert alert-info">
                                <h5 class="alert-heading">Still Playing an Adventure!</h5>
                                <div class="d-flex justify-content-between">
                                <span class="party-name font-weight-bold">
                                    @if($lastActiveSession->party != null)
                                        {{ $lastActiveSession->party->name }}
                                    @else
                                        No Party Created
                                    @endif
                                </span>
                                    <span class="last-played small">Last Played: {{ $lastActiveSession->updated_at->diffForHumans() }}</span>
                                </div>
                                <hr>
                                <a href="{{ route('adventure.continue', ['play_session_id' => $lastActiveSession->id]) }}" class="btn btn-warning btn-block">Continue Last Adventure</a>
                            </div>
                        @endif
                        <a href="{{ route('adventure.begin') }}" class="btn btn-primary btn-block">Begin New Adventure</a>

                        @if($playSessions != null && $playSessions->count() > 0)
                            <h4 class="mt-3">Active Adventures</h4>
                            <div class="list-group">
                                @foreach($playSessions as $pSession)
                                    <a href="{{ route('adventure.continue', ['play_session_id' => $pSession->id]) }}" class="list-group-item list-group-item-action d-flex justify-content-between">
                                <span class="party-name font-weight-bold">
                                @if($pSession->party != null)
                                        {{ $pSession->party->name }} Adventure
                                    @else
                                        No Party Created
                                    @endif
                                </span>
                                        <span class="last-played small">Last Played: {{ $pSession->updated_at->diffForHumans() }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="alert alert-danger">
                            You cannot start an adventure until all the necessary things have been entered.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">User Inventory</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                Player entered
                                <span class="badge @if($numPlayers == 0) badge-danger @else badge-success @endif badge-pill">{{ $numPlayers }}</span>
                            </div>
                            @if($numPlayers == 0)
                                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                    You must enter at least 1 player to play an adventure.
                                    <a href="{{ route('players.create') }}" class="btn-outline-info"><span class="fa fa-caret-square-right"></span></a>
                                </div>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                PC's entered
                                <span class="badge @if($numPcs == 0) badge-danger @else badge-success @endif badge-pill">{{ $numPcs }}</span>
                            </div>
                            @if($numPcs == 0)
                                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                    You must enter at least 1 PC to play an adventure.
                                    <a href="{{ route('pcs.create') }}" class="btn-outline-info"><span class="fa fa-caret-square-right"></span></a>
                                </div>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                Custom Monsters entered
                                <span class="badge @if($numCustomMonsters == 0) badge-danger @else badge-success @endif badge-pill">{{ $numCustomMonsters }}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                Monster Tokens entered
                                <span class="badge @if($numMonsterTokens == 0) badge-danger @else badge-success @endif badge-pill">{{ $numMonsterTokens }}</span>
                            </div>
                            @if( $numMonsterTokens == 0)
                                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                    You must enter at least 1 Monster Token to play an adventure.
                                    <a href="{{ route('monster_tokens.create') }}" class="btn-outline-info"><span class="fa fa-caret-square-right"></span></a>
                                </div>
                            @endif
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                Modules entered
                                <span class="badge @if($numModules == 0) badge-danger @else badge-success @endif badge-pill">{{ $numModules }}</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                Encounters entered
                                <span class="badge @if($numEncounters == 0) badge-danger @else badge-success @endif badge-pill">{{ $numEncounters }}</span>
                            </div>
                            @if($numEncounters == 0)
                                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                    You must enter at least 1 Encounter to play an adventure.
                                    <a href="{{ route('encounters.create') }}" class="btn-outline-info"><span class="fa fa-caret-square-right"></span></a>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

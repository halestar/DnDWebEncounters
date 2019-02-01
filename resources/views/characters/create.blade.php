@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-5">
            <form action="{{ route('pcs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Add a New PC
                    </div>
                    <div class="card-body">
                        <div class="from-group mb-3">
                            <label for="player_id">Player</label>
                            <select class="custom-select" name="player_id" id="player_id">
                                @foreach($players as $player)
                                    <option value="{{ $player->id }}">{{ $player->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Player Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="characterRace">Race</label>
                            <input type="text" class="form-control" id="characterRace" name="characterRace">
                        </div>
                        <div class="form-group">
                            <label for="characterClass">Class</label>
                            <input type="text" class="form-control" id="characterClass" name="characterClass">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="level">Level</label>
                                    <input type="text" class="form-control" id="level" name="level">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ac">AC</label>
                                    <input type="text" class="form-control" id="ac" name="ac">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="pp">PP</label>
                                    <input type="text" class="form-control" id="pp" name="pp">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="spellDc">Spell DC</label>
                                    <input type="text" class="form-control" id="spellDc" name="spellDc">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
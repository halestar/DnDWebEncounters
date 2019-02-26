@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('pcs.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Add a New PC
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info mb-3">
                            <div class="form-check-inline">
                                <input type="radio" name="player_type" id="player_type_existing" class="form-check-input" value="EXISTING" checked onclick="jQuery('#existing_player_container').show();jQuery('#new_player_container').hide();">
                                <label for="player_type_existing" class="form-check-label">Existing Player</label>
                            </div>
                            <div class="form-check-inline">
                                <input type="radio" name="player_type" id="player_type_new" class="form-check-input" value="NEW" onclick="jQuery('#existing_player_container').hide();jQuery('#new_player_container').show();">
                                <label for="player_type_existing" class="form-check-label">New Player</label>
                            </div>
                            <hr class="my-2" />
                            <div class="from-group mb-3" id="existing_player_container">
                                <label for="player_id">Existing Player</label>
                                <select class="custom-select" name="player_id" id="player_id">
                                    @foreach($players as $player)
                                        <option value="{{ $player->id }}">{{ $player->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="new_player_container" style="display: none;">
                                <label for="new_player_name">New Player Name</label>
                                <input type="text" class="form-control" id="new_player_name" name="new_player_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">PC Name</label>
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

@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('pcs.update', ['id' => $pc->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-header">
                Update PC
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Player Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $pc->name }}">
                </div>
                <div class="form-group">
                    <label for="characterRace">Race</label>
                    <input type="text" class="form-control" id="characterRace" name="characterRace"
                           value="{{ $pc->characterRace }}">
                </div>
                <div class="form-group">
                    <label for="characterClass">Class</label>
                    <input type="text" class="form-control" id="characterClass" name="characterClass"
                           value="{{ $pc->characterClass }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="text" class="form-control" id="level" name="level" value="{{ $pc->level }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="ac">AC</label>
                            <input type="text" class="form-control" id="ac" name="ac" value="{{ $pc->ac }}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="hp">HP</label>
                            <input type="text" class="form-control" id="hp" name="hp" value="{{ $pc->hp }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="pp">PP</label>
                            <input type="text" class="form-control" id="pp" name="pp" value="{{ $pc->pp }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="spellDc">Spell DC</label>
                            <input type="text" class="form-control" id="spellDc" name="spellDc"
                                   value="{{ $pc->spellDc }}">
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
@endsection

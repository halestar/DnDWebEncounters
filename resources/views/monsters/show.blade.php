@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="d-flex justify-content-between">
            SR Monster
            <a href="{{ route('monsters.create', ['idx' => $monster->idx]) }}" role="button" class="btn btn-primary">Make
                a Custom Monster Based on this Monster</a>
        </h3>
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Monster Stats
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Monster Name</label>
                            <input type="text" class="form-control disabled" id="name" name="name"
                                   value="{{ $monster->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="monsterType">Type</label>
                            <input type="text" class="form-control disabled" id="monsterType" name="monsterType"
                                   value="{{ $monster->monsterType }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="monsterSize">Size</label>
                            <input type="text" class="form-control disabled" id="monsterSize" name="monsterSize"
                                   value="{{ $monster->monsterSize }}" disabled>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="str">STR</label>
                                    <input type="text" class="form-control disabled" id="str" name="str"
                                           value="{{ $monster->str }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dex">DEX</label>
                                    <input type="text" class="form-control disabled" id="dex" name="dex"
                                           value="{{ $monster->dex }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="con">CON</label>
                                    <input type="text" class="form-control disabled" id="con" name="con"
                                           value="{{ $monster->con }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="int">INT</label>
                                    <input type="text" class="form-control disabled" id="int" name="int"
                                           value="{{ $monster->int }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="wis">WIS</label>
                                    <input type="text" class="form-control disabled" id="wis" name="wis"
                                           value="{{ $monster->wis }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cha">CHA</label>
                                    <input type="text" class="form-control disabled" id="cha" name="cha"
                                           value="{{ $monster->cha }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control disabled" id="hp" name="hp"
                                           value="{{ $monster->hp }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ac">AC</label>
                                    <input type="text" class="form-control disabled" id="ac" name="ac"
                                           value="{{ $monster->ac }}" disabled>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cr">CR</label>
                                    <input type="text" class="form-control disabled" id="cr" name="cr"
                                           value="{{ $monster->cr }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Hit Dice</label>
                            <input type="text" class="form-control disabled" id="hd" name="hd"
                                   value="{{ $monster->hd }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Monster Properties
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="speed">Speed</label>
                            <input type="text" class="form-control disabled" id="speed" name="speed"
                                   value="{{ $monster->speed }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="alignment">Alignment</label>
                            <input type="text" class="form-control disabled" id="alignment" name="alignment"
                                   value="{{ $monster->alignment }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="resistances">Resistances</label>
                            <input type="text" class="form-control" id="resistances disabled" name="resistances"
                                   value="{{ $monster->resistances }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="immunities">Immunities</label>
                            <input type="text" class="form-control" id="immunities disabled" name="immunities"
                                   value="{{ $monster->immunities }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="vulnerabilities">Vulnerabilities</label>
                            <input type="text" class="form-control disabled" id="vulnerabilities" name="vulnerabilities"
                                   value="{{ $monster->vulnerabilities }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <input type="text" class="form-control disabled" id="languages" name="languages"
                                   value="{{ $monster->languages }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="senses">Senses</label>
                            <input type="text" class="form-control disabled" id="senses" name="senses"
                                   value="{{ $monster->senses }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Monster Properties
                    </div>
                    <div class="card-body">
                        <h4>
                            Special Abilities
                        </h4>
                        <div id="special_abilities_container"></div>
                        <h4>
                            Actions
                        </h4>
                        <div id="actions_container"></div>
                        <h4>
                            Legendary Abilities
                        </h4>
                        <div id="legendary_abilities_container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var special_abilities_manager = new AbilityManager('special_abilities_container', 'special_abilities', true);
        special_abilities_manager.loadAbilities(
            [
                    @foreach($monster->specialAbilities as $ability)
                {
                    name: '{{ $ability['name'] }}',
                    description: '{{ $ability['desc'] }}',
                },
                @endforeach
            ]
        );
        var action_manager = new AbilityManager('actions_container', 'actions', true);
        action_manager.loadAbilities(
            [
                    @foreach($monster->actions as $ability)
                {
                    name: '{{ $ability['name'] }}',
                    description: '{{ $ability['desc'] }}',
                },
                @endforeach
            ]
        );
        var legendary_abilities_manager = new AbilityManager('legendary_abilities_container', 'legendary_abilities', true);
        legendary_abilities_manager.loadAbilities(
            [
                    @foreach($monster->legendaryAbilities as $ability)
                {
                    name: '{{ $ability['name'] }}',
                    description: '{{ $ability['desc'] }}',
                },
                @endforeach
            ]
        );
    </script>
@endpush

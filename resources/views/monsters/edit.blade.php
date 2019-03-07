@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('monsters.update', ['id' => $monster->id]) }}" method="POST" id="update_form">
        @method('PUT')
        @csrf
        <input type="hidden" name="special_abilities" id="special_abilities" />
        <input type="hidden" name="actions" id="actions" />
        <input type="hidden" name="legendary_abilities" id="legendary_abilities" />
        <h3>Update a Custom Monster</h3>
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Monster Stats
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Monster Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $monster->name }}">
                        </div>
                        <div class="form-group">
                            <label for="monsterType">Type</label>
                            <input type="text" class="form-control" id="monsterType" name="monsterType" value="{{ $monster->monsterType }}">
                        </div>
                        <div class="form-group">
                            <label for="monsterSize">Size</label>
                            <input type="text" class="form-control" id="monsterSize" name="monsterSize" value="{{ $monster->monsterSize }}">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="str">STR</label>
                                    <input type="text" class="form-control" id="str" name="str" value="{{ $monster->str }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dex">DEX</label>
                                    <input type="text" class="form-control" id="dex" name="dex" value="{{ $monster->dex }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="con">CON</label>
                                    <input type="text" class="form-control" id="con" name="con" value="{{ $monster->con }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="int">INT</label>
                                    <input type="text" class="form-control" id="int" name="int" value="{{ $monster->int }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="wis">WIS</label>
                                    <input type="text" class="form-control" id="wis" name="wis" value="{{ $monster->wis }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cha">CHA</label>
                                    <input type="text" class="form-control" id="cha" name="cha" value="{{ $monster->cha }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp" value="{{ $monster->hp }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ac">AC</label>
                                    <input type="text" class="form-control" id="ac" name="ac" value="{{ $monster->ac }}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cr">CR</label>
                                    <input type="text" class="form-control" id="cr" name="cr" value="{{ $monster->cr }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Hit Dice</label>
                            <input type="text" class="form-control" id="hd" name="hd" value="{{ $monster->hd }}">
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
                            <input type="text" class="form-control" id="speed" name="speed" value="{{ $monster->speed }}">
                        </div>
                        <div class="form-group">
                            <label for="alignment">Alignment</label>
                            <input type="text" class="form-control" id="alignment" name="alignment" value="{{ $monster->alignment }}">
                        </div>
                        <div class="form-group">
                            <label for="resistances">Resistances</label>
                            <input type="text" class="form-control" id="resistances" name="resistances" value="{{ $monster->resistances }}">
                        </div>
                        <div class="form-group">
                            <label for="immunities">Immunities</label>
                            <input type="text" class="form-control" id="immunities" name="immunities" value="{{ $monster->immunities }}">
                        </div>
                        <div class="form-group">
                            <label for="vulnerabilities">Vulnerabilities</label>
                            <input type="text" class="form-control" id="vulnerabilities" name="vulnerabilities" value="{{ $monster->vulnerabilities }}">
                        </div>
                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <input type="text" class="form-control" id="languages" name="languages" value="{{ $monster->languages }}">
                        </div>
                        <div class="form-group">
                            <label for="senses">Senses</label>
                            <input type="text" class="form-control" id="senses" name="senses" value="{{ $monster->senses }}">
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
                            <small>
                                <button type="button" class="btn btn-primary btn-sm" onclick="special_abilities_manager.addAbility()">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </small>
                        </h4>
                        <div id="special_abilities_container"></div>
                        <h4>
                            Actions
                            <small>
                                <button type="button" class="btn btn-primary btn-sm" onclick="action_manager.addAbility()">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </small>
                        </h4>
                        <div id="actions_container"></div>
                        <h4>
                            Legendary Abilities
                            <small>
                                <button type="button" class="btn btn-primary btn-sm" onclick="legendary_abilities_manager.addAbility()">
                                    <span class="fa fa-plus"></span>
                                </button>
                            </small>
                        </h4>
                        <div id="legendary_abilities_container"></div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Update Custom Monster</button>
    </form>
</div>
@endsection
@push('scripts')
    <script>
        var special_abilities_manager = new AbilityManager('special_abilities_container', 'special_abilities');
        special_abilities_manager.loadAbilities(
            [
                @foreach($monster->specialAbilities as $ability)
                {
                  id: '{{ $ability->id }}',
                  name: '{{ trim(preg_replace('/\s+/', ' ', $ability->name)) }}',
                  description: '{{ trim(preg_replace('/\s+/', ' ', $ability->description)) }}',
                },
                @endforeach
            ]
        );
        var action_manager = new AbilityManager('actions_container', 'actions');
        action_manager.loadAbilities(
            [
                    @foreach($monster->actions as $ability)
                {
                    id: '{{ $ability->id }}',
                    name: '{{ trim(preg_replace('/\s+/', ' ', $ability->name)) }}',
                    description: '{{ trim(preg_replace('/\s+/', ' ', $ability->description)) }}',
                },
                @endforeach
            ]
        );
        var legendary_abilities_manager = new AbilityManager('legendary_abilities_container', 'legendary_abilities');
        legendary_abilities_manager.loadAbilities(
            [
                    @foreach($monster->legendaryAbilities as $ability)
                {
                    id: '{{ $ability->id }}',
                    name: '{{ trim(preg_replace('/\s+/', ' ', $ability->name)) }}',
                    description: '{{ trim(preg_replace('/\s+/', ' ', $ability->description)) }}',
                },
                @endforeach
            ]
        );

        function submitForm()
        {
            var form = jQuery('#update_form');
            jQuery('#special_abilities').val(JSON.stringify(special_abilities_manager.getAbilities()));
            jQuery('#actions').val(JSON.stringify(action_manager.getAbilities()));
            jQuery('#legendary_abilities').val(JSON.stringify(legendary_abilities_manager.getAbilities()));
            form.submit();
        }
    </script>
@endpush
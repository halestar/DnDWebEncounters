@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('monsters.store') }}" method="post" enctype="multipart/form-data" id="create_form">
        @csrf
        <input type="hidden" name="special_abilities" id="special_abilities" />
        <input type="hidden" name="actions" id="actions" />
        <input type="hidden" name="legendary_abilities" id="legendary_abilities" />
        <h3>Add a New Custom Monster</h3>
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        Monster Stats
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Monster Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="monsterType">Type</label>
                            <input type="text" class="form-control" id="monsterType" name="monsterType">
                        </div>
                        <div class="form-group">
                            <label for="monsterSize">Size</label>
                            <input type="text" class="form-control" id="monsterSize" name="monsterSize">
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="str">STR</label>
                                    <input type="text" class="form-control" id="str" name="str">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dex">DEX</label>
                                    <input type="text" class="form-control" id="dex" name="dex">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="con">CON</label>
                                    <input type="text" class="form-control" id="con" name="con">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="int">INT</label>
                                    <input type="text" class="form-control" id="int" name="int">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="wis">WIS</label>
                                    <input type="text" class="form-control" id="wis" name="wis">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cha">CHA</label>
                                    <input type="text" class="form-control" id="cha" name="cha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="hp">HP</label>
                                    <input type="text" class="form-control" id="hp" name="hp">
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
                                    <label for="cr">CR</label>
                                    <input type="text" class="form-control" id="cr" name="cr">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Hit Dice</label>
                            <input type="text" class="form-control" id="hd" name="hd">
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
                            <input type="text" class="form-control" id="speed" name="speed">
                        </div>
                        <div class="form-group">
                            <label for="alignment">Alignment</label>
                            <input type="text" class="form-control" id="alignment" name="alignment">
                        </div>
                        <div class="form-group">
                            <label for="resistances">Resistances</label>
                            <input type="text" class="form-control" id="resistances" name="resistances">
                        </div>
                        <div class="form-group">
                            <label for="immunities">Immunities</label>
                            <input type="text" class="form-control" id="immunities" name="immunities">
                        </div>
                        <div class="form-group">
                            <label for="vulnerabilities">Vulnerabilities</label>
                            <input type="text" class="form-control" id="vulnerabilities" name="vulnerabilities">
                        </div>
                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <input type="text" class="form-control" id="languages" name="languages">
                        </div>
                        <div class="form-group">
                            <label for="senses">Senses</label>
                            <input type="text" class="form-control" id="senses" name="senses">
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

        <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Add Custom Monster</button>
    </form>
</div>
@endsection
@push('scripts')
    <script>
        var special_abilities_manager = new AbilityManager('special_abilities_container', 'special_abilities');
        var action_manager = new AbilityManager('actions_container', 'actions');
        var legendary_abilities_manager = new AbilityManager('legendary_abilities_container', 'legendary_abilities');

        function submitForm()
        {
            var form = jQuery('#create_form');
            jQuery('#special_abilities').val(JSON.stringify(special_abilities_manager.getAbilities()));
            jQuery('#actions').val(JSON.stringify(action_manager.getAbilities()));
            jQuery('#legendary_abilities').val(JSON.stringify(legendary_abilities_manager.getAbilities()));
            form.submit();
        }
    </script>
@endpush
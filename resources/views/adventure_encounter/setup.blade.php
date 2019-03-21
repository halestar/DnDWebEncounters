@extends('layouts.app')

@section('content')
<form action="{{ route('play.setup.complete', ['id' => $adventureEncounter->id]) }}" method="POST">
    @csrf
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">Player Initiative</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($adventureEncounter->playSession->party->pcs as $pc)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $pc->name }}
                                <div class="input-group mb-2 ml-2" style="flex: 0 0 50%;">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Initiative: </div>
                                    </div>
                                    <input type="text" class="form-control" id="initiative_{{ $pc->id }}" name="initiative_{{ $pc->id }}">
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">Monster Tokens</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($adventureEncounter->encounter->srMonsters as $srMonster)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <input type="hidden" name="monster_target_{{ $loop->index }}" id="monster_target_{{ $loop->index }}" value='{{ $srMonster['monsterJSON'] }}' />
                                {{ $srMonster['name'] }}
                                <select
                                        name="monster_token_{{ $loop->index }}"
                                        id="monster_token_{{ $loop->index }}"
                                        class="custom-select ml-5 "
                                        onchange="jQuery('#token_monster_thumb_{{ $loop->index }}').prop('src', '/monster_tokens/' + jQuery(this).val());"
                                >
                                    @foreach($tokens as $token)
                                    <option value="{{ $token->id }}">{{ $token->name }}</option>
                                    @endforeach
                                </select>
                                <img src="{{ route('monster_tokens.show', ['id' => $tokens->first()->id]) }}" class="img-thumbnail ml-3" id="token_monster_thumb_{{ $loop->index }}">
                            </li>
                            @endforeach
                            @foreach($adventureEncounter->encounter->customMonsters as $customMonster)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $customMonster->name }}
                                    <select
                                            name="custom_monster_token_{{ $loop->index }}"
                                            id="custom_monster_token_{{ $loop->index }}"
                                            class="custom-select ml-5 "
                                            onchange="jQuery('#custom_token_monster_thumb_{{ $loop->index }}').prop('src', '/monster_tokens/' + jQuery(this).val());"
                                    >
                                        @foreach($tokens as $token)
                                            <option value="{{ $token->id }}">{{ $token->name }}</option>
                                        @endforeach
                                    </select>
                                    <img src="{{ route('monster_tokens.show', ['id' => $tokens->first()->id]) }}" class="img-thumbnail ml-3" id="custom_token_monster_thumb_{{ $loop->index }}">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">Encounter Options</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="monster_initiative"
                                   id="monster_initiative" value="1"
                                   @if(Auth::user()->monster_initiative) checked @endif />
                            <label for="monster_initiative" class="form-check-label">Assign Individual Monster Initiative</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="monster_hp" id="monster_hp" value="1"
                                   @if(Auth::user()->monster_hp) checked @endif />
                            <label for="monster_hp" class="form-check-label">Roll for Each Monster's HP</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Complete Setup</button>
    </div>
</form>

@endsection

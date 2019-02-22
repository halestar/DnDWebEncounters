<h4 class="mt-3">Available Players</h4>
<table class="table">
    <thead>
        <tr>
            <td>Name</td>
            <td>AC</td>
            <td>Max HP</td>
            <td>PP</td>
            <td>Spell DC</td>
        </tr>
    </thead>
    <tbody>
    @foreach($adventureEncounter->pcActors() as $pc)
        <tr>
            <th>{{ $pc->pc->name }}</th>
            <th>{{ $pc->pc->ac }}</th>
            <th>{{ $pc->pc->hp }}</th>
            <th>{{ $pc->pc->pp }}</th>
            <th>{{ $pc->pc->spellDc }}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<hr />
<div class="row monster-header mb-2">
    <div class="col-2">
        <img src="{{ route('monster_tokens.show', ['id' => $currentActor->token->id]) }}" class="img-thumbnail" style="width: 64px;">
    </div>
    <div class="col-7 font-weight-bold">
        {{ $currentActor->name }}
        <br>
        @if($currentActor->isSrMonster())
        {{ $currentActor->srMonster()->monsterSize }} {{ $currentActor->srMonster()->monsterType }}
        @else
        {{ $currentActor->customMonster->monsterSize }} {{ $currentActor->customMonster->monsterType }}
        @endif
    </div>
    <div class="col-3 h2">
        <strong>AC: </strong>
        @if($currentActor->isSrMonster())
            {{ $currentActor->srMonster()->ac }}
        @else
            {{ $currentActor->customMonster->ac }}
        @endif
    </div>
</div>
<form action="{{ route('play.finish.monster_turn', ['adventure_encounter' => $adventureEncounter->id, 'adventure_actor' => $currentActor->id]) }}" method="POST" id="monster_turn_form">
    @csrf
    <input type="hidden" name="status" id="status" value="ALIVE" />
    <div class="border border-info rounded p-2 monster-health-widget mb-3">
        <div class="row font-weight-bold">
            <div class="col-2 text-center">
                <h4>HP</h4>
            </div>
            <div class="col-10 text-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dmg_type" id="dmg_type_dmg" value="DMG" checked>
                    <label class="form-check-label" for="dmg_type_dmg">Damage</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="dmg_type" id="dmg_type_heal" value="HEAL">
                    <label class="form-check-label" for="dmg_type_heal">Healing</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-center">
                <input type="text" class="border border-dark rounded text-center p-1" name="current_hp" id="current_hp" value="{{ $currentActor->current_hp }}" style="width: 64px; height:64px; font-size: 32px" />
            </div>
            <div class="col-10">
                <div class="w-100 d-flex align-content-stretch flex-nowrap mb-2">
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 1, {{ $currentActor->max_hp }})">1</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 2, {{ $currentActor->max_hp }})">2</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 3, {{ $currentActor->max_hp }})">3</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 4, {{ $currentActor->max_hp }})">4</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 5, {{ $currentActor->max_hp }})">5</button>
                </div>
                <div class="d-flex align-content-stretch flex-nowrap mb-2">
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 6, {{ $currentActor->max_hp }})">6</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 7, {{ $currentActor->max_hp }})">7</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 8, {{ $currentActor->max_hp }})">8</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 9, {{ $currentActor->max_hp }})">9</button>
                    <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 10, {{ $currentActor->max_hp }})">10</button>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block">Finish with Monster</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-danger btn-block" onclick="kill_turn_monster()">Mark Monster Dead</button>
            </div>
        </div>
    </div>
</form>
<div class="d-flex justify-content-between flex-nowrap mb-2 h4">
        <span class="attr-display">
            <strong>STR:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->str_mod }} @else {{ $currentActor->customMonster->strMod }} @endif
        </span>
        <span class="attr-display">
            <strong>DEX:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->dex_mod }} @else {{ $currentActor->customMonster->dexMod }} @endif
        </span>
        <span class="attr-display">
            <strong>CON:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->con_mod }} @else {{ $currentActor->customMonster->conMod }} @endif
        </span>
</div>
<div class="d-flex justify-content-between flex-nowrap mb-2 h4">
        <span class="attr-display">
            <strong>INT:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->int_mod }} @else {{ $currentActor->customMonster->intMod }} @endif
        </span>
    <span class="attr-display">
            <strong>WIS:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->wis_mod }} @else {{ $currentActor->customMonster->wisMod }} @endif
        </span>
    <span class="attr-display">
            <strong>CHA:</strong>
            @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->cha_mod }} @else {{ $currentActor->customMonster->chaMod }} @endif
        </span>
</div>
<ul class="list-group list-group-flush mb-3">
    <li class="list-group-item">
        <strong>Speed:</strong>
        @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->speed }} @else {{ $currentActor->customMonster->speed }} @endif
    </li>
    <li class="list-group-item">
        <strong>Alignment:</strong>
        @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->alignment }} @else {{ $currentActor->customMonster->alignment }} @endif
    </li>
    <li class="list-group-item">
        <strong>Vulnerabilities:</strong>
        @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->vulnerabilities }} @else {{ $currentActor->customMonster->vulnerabilities }} @endif
    </li>
    <li class="list-group-item">
        <strong>Languages:</strong>
        @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->languages }} @else {{ $currentActor->customMonster->languages }} @endif
    </li>
    <li class="list-group-item">
        <strong>Senses:</strong>
        @if($currentActor->isSrMonster()) {{ $currentActor->srMonster()->senses }} @else {{ $currentActor->customMonster->senses }} @endif
    </li>
</ul>
@if(($currentActor->isSrMonster() && count($currentActor->srMonster()->specialAbilities) > 0) || ($currentActor->isCustomMonster() && $currentActor->customMonster->specialAbilities->count() > 0))
<h5>Special Abilities</h5>
@if($currentActor->isSrMonster())
    @foreach($currentActor->srMonster()->specialAbilities as $ability)
        <div class="alert alert-info">
            <h4 class="alert-heading border-bottom">
                {{ $ability['name'] }}
            </h4>
            <p>
                {{ $ability['desc'] }}
            </p>
            <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                    <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                        {{ $dice->getDiceStr() }}
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
@else
    @foreach($currentActor->customMonster->specialAbilities as $ability)
        <div class="alert alert-info">
            <h4 class="alert-heading border-bottom">
                {{ $ability['name'] }}
            </h4>
            <p>
                {{ $ability['desc'] }}
            </p>
            <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                    <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                        {{ $dice->getDiceStr() }}
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
@endif
@if(($currentActor->isSrMonster() && count($currentActor->srMonster()->actions) > 0) || ($currentActor->isCustomMonster() && $currentActor->customMonster->actions->count() > 0))
<h5>Actions</h5>
@if($currentActor->isSrMonster())
    @foreach($currentActor->srMonster()->actions as $ability)
        <div class="alert alert-info">
            <h4 class="alert-heading border-bottom">
                {{ $ability['name'] }}
            </h4>
            <p>
                {{ $ability['desc'] }}
            </p>
            <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                    <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                        {{ $dice->getDiceStr() }}
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
@else
    @foreach($currentActor->customMonster->actions as $ability)
        <div class="alert alert-info">
            <h4 class="alert-heading border-bottom">
                {{ $ability['name'] }}
            </h4>
            <p>
                {{ $ability['desc'] }}
            </p>
            <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                    <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                        {{ $dice->getDiceStr() }}
                    </button>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
@endif
@if(($currentActor->isSrMonster() && count($currentActor->srMonster()->legendaryAbilities) > 0) || ($currentActor->isCustomMonster() && $currentActor->customMonster->legendaryAbilities->count() > 0))
    <h5>Legendary Abilities</h5>
    @if($currentActor->isSrMonster())
        @foreach($currentActor->srMonster()->legendaryAbilities as $ability)
            <div class="alert alert-info">
                <h4 class="alert-heading border-bottom">
                    {{ $ability['name'] }}
                </h4>
                <p>
                    {{ $ability['desc'] }}
                </p>
                <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                    @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                        <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                            {{ $dice->getDiceStr() }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        @foreach($currentActor->customMonster->legendaryAbilities as $ability)
            <div class="alert alert-info">
                <h4 class="alert-heading border-bottom">
                    {{ $ability['name'] }}
                </h4>
                <p>
                    {{ $ability['desc'] }}
                </p>
                <div class="border-top border-dark small pt-2 d-flex justify-content-around">
                    @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                        <button type="button" class="btn btn-secondary btn-sm" onclick="quickRoll('{{ $dice->getDiceStr() }}')">
                            {{ $dice->getDiceStr() }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
@endif

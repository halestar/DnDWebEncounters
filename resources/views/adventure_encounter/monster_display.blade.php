<div class="row monster-header mb-2">
    <div class="col-2">
        <img src="{{ route('monster_tokens.show', ['id' => $actor->token->id]) }}" class="img-thumbnail" style="width: 64px;">
    </div>
    <div class="col-7 font-weight-bold">
        {{ $actor->name }}
        <br>
        @if($actor->isSrMonster())
        {{ $actor->srMonster()->monsterSize }} {{ $actor->srMonster()->monsterType }}
        @else
        {{ $actor->customMonster->monsterSize }} {{ $actor->customMonster->monsterType }}
        @endif
    </div>
    <div class="col-3 h2">
        <strong>AC: </strong>
        @if($actor->isSrMonster())
            {{ $actor->srMonster()->ac }}
        @else
            {{ $actor->customMonster->ac }}
        @endif
    </div>
</div>
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
            <input type="text" class="border border-dark rounded text-center p-1" name="current_hp" id="current_hp" value="{{ $actor->current_hp }}" style="width: 64px; height:64px; font-size: 32px" />
        </div>
        <div class="col-10">
            <div class="w-100 d-flex align-content-stretch flex-nowrap mb-2">
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 1, {{ $actor->max_hp }})">1</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 2, {{ $actor->max_hp }})">2</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 3, {{ $actor->max_hp }})">3</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 4, {{ $actor->max_hp }})">4</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 5, {{ $actor->max_hp }})">5</button>
            </div>
            <div class="d-flex align-content-stretch flex-nowrap mb-2">
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 6, {{ $actor->max_hp }})">6</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 7, {{ $actor->max_hp }})">7</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 8, {{ $actor->max_hp }})">8</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 9, {{ $actor->max_hp }})">9</button>
                <button type="button" class="flex-grow-1 btn btn-secondary m-1" onclick="update_monster_hp(jQuery('input[name=dmg_type]:checked').val(), 10, {{ $actor->max_hp }})">10</button>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <button type="button" class="btn btn-primary btn-block" onclick="finish_monster({{ $actor->id }})">Finish with Monster</button>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-danger btn-block" onclick="kill_monster({{ $actor->id }})">Mark Monster Dead</button>
        </div>
    </div>
</div>
<div class="d-flex justify-content-between flex-nowrap mb-2 h4">
        <span class="attr-display">
            <strong>STR:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->str_mod }} @else {{ $actor->customMonster->strMod }} @endif
        </span>
        <span class="attr-display">
            <strong>DEX:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->dex_mod }} @else {{ $actor->customMonster->dexMod }} @endif
        </span>
        <span class="attr-display">
            <strong>CON:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->con_mod }} @else {{ $actor->customMonster->conMod }} @endif
        </span>
</div>
<div class="d-flex justify-content-between flex-nowrap mb-2 h4">
        <span class="attr-display">
            <strong>INT:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->int_mod }} @else {{ $actor->customMonster->intMod }} @endif
        </span>
    <span class="attr-display">
            <strong>WIS:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->wis_mod }} @else {{ $actor->customMonster->wisMod }} @endif
        </span>
    <span class="attr-display">
            <strong>CHA:</strong>
            @if($actor->isSrMonster()) {{ $actor->srMonster()->cha_mod }} @else {{ $actor->customMonster->chaMod }} @endif
        </span>
</div>
<ul class="list-group list-group-flush mb-3">
    <li class="list-group-item">
        <strong>Speed:</strong>
        @if($actor->isSrMonster()) {{ $actor->srMonster()->speed }} @else {{ $actor->customMonster->speed }} @endif
    </li>
    <li class="list-group-item">
        <strong>Alignment:</strong>
        @if($actor->isSrMonster()) {{ $actor->srMonster()->alignment }} @else {{ $actor->customMonster->alignment }} @endif
    </li>
    <li class="list-group-item">
        <strong>Vulnerabilities:</strong>
        @if($actor->isSrMonster()) {{ $actor->srMonster()->vulnerabilities }} @else {{ $actor->customMonster->vulnerabilities }} @endif
    </li>
    <li class="list-group-item">
        <strong>Languages:</strong>
        @if($actor->isSrMonster()) {{ $actor->srMonster()->languages }} @else {{ $actor->customMonster->languages }} @endif
    </li>
    <li class="list-group-item">
        <strong>Senses:</strong>
        @if($actor->isSrMonster()) {{ $actor->srMonster()->senses }} @else {{ $actor->customMonster->senses }} @endif
    </li>
</ul>
@if(($actor->isSrMonster() && count($actor->srMonster()->specialAbilities) > 0) || ($actor->isCustomMonster() && $actor->customMonster->specialAbilities->count() > 0))
<h5>Special Abilities</h5>
@if($actor->isSrMonster())
    @foreach($actor->srMonster()->specialAbilities as $ability)
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
    @foreach($actor->customMonster->specialAbilities as $ability)
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
@if(($actor->isSrMonster() && count($actor->srMonster()->actions) > 0) || ($actor->isCustomMonster() && $actor->customMonster->actions->count() > 0))
<h5>Actions</h5>
@if($actor->isSrMonster())
    @foreach($actor->srMonster()->actions as $ability)
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
    @foreach($actor->customMonster->actions as $ability)
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
@if(($actor->isSrMonster() && count($actor->srMonster()->legendaryAbilities) > 0) || ($actor->isCustomMonster() && $actor->customMonster->legendaryAbilities->count() > 0))
    <h5>Legendary Abilities</h5>
    @if($actor->isSrMonster())
        @foreach($actor->srMonster()->legendaryAbilities as $ability)
            <div class="alert alert-info">
                <h4 class="alert-heading border-bottom">
                    {{ $ability['name'] }}
                </h4>
                <p>
                    {{ $ability['desc'] }}
                </p>
                <div class="border-top border-dark small">
                    @foreach (\App\Dice\DiceParser::parseString($ability['desc']) as $dice)
                    <button type="button" class="btn btn-secondary btn-sm">
                        {{ $dice->getDiceStr() }}
                    </button>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        @foreach($actor->customMonster->legendaryAbilities as $ability)
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

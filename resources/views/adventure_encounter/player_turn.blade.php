<div class="rounded bg-info d-flex justify-content-around my-2 player-stats-container">
    <span class="ac-container">
        <strong>AC: </strong>{{ $currentActor->pc->ac }}
    </span>
    <span class="ac-container">
        <strong>Spell DC: </strong>{{ $currentActor->pc->spellDc }}
    </span>
</div>
<hr />
<div id="current-player-container" class="mt-3">
    <h5>Available Targets</h5>
    <div class="list-group mb-2">
        @foreach($adventureEncounter->monsterActors() as $actor)
        <a href="#" onclick="load_monster_target({{ $actor->id }})" class="list-group-item d-flex list-group-item-action justify-content-between align-items-center">
            <span class="monster-target-name">
                <img src="{{ route('monster_tokens.show', ['id' => $actor->token->id]) }}" class="img-thumbnail" style="width: 32px;">
                {{ $actor->name }}
            </span>
            <span class="monster-target-stats">
                @if($actor->isSrMonster())
                <strong>AC: </strong>{{ $actor->srMonster()->ac }}
                @else
                <strong>AC: </strong>{{ $actor->customMonster->ac }}
                @endif
                <strong>HP: </strong>{{ $actor->current_hp }} / {{ $actor->max_hp }}
            </span>
        </a>
        @endforeach
    </div>
    <a href="{{ route('play.finish.player', ['adventure_encounter' => $adventureEncounter->id, 'adventure_actor' => $currentActor->id]) }}" role="button" class="btn btn-primary btn-block">Finish Player's Turn</a>
</div>
<div id="monster-target-container"></div>
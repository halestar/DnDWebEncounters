@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Encounter Turn</div>
                <div class="card-body">
                    <h4 class="d-flex justify-content-between">
                        <span class="turn-display">Turn #{{ $adventureEncounter->turn_number }}</span>
                        @if($currentActor != null && $currentActor->isPC())
                            <span class="text-primary turn-faction-display font-weight-bolder">
                            PLAYER TURN
                        </span>
                        @elseif($currentActor != null)
                            <span class="text-danger turn-faction-display font-weight-bolder">
                            MONSTER TURN
                        </span>
                        @else
                            <span class="text-success turn-faction-display font-weight-bolder">
                            END OF TURN
                        </span>
                        @endif
                    </h4>
                    <h5>Next Up: <strong>{{ $currentActor == null? "End of Turn!": $currentActor->name }}</strong></h5>
                    @if($currentActor != null)
                        <div id="turn_display_container">
                            @if($currentActor->isPc())
                                @include('adventure_encounter.player_turn')
                            @else
                                @include('adventure_encounter.monster_turn')
                            @endif
                        </div>
                    @else
                        <a href="{{ route('play.finish.turn', ['id' => $adventureEncounter->id]) }}" role="button" class="btn btn-primary btn-block">Finish Turn</a>
                        <a href="{{ route('play.finish.encounter', ['id' => $adventureEncounter->id]) }}" role="button" class="btn btn-danger btn-block">Finish Encounter</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Encounter Information</div>
                <div class="card-body">
                    <div class="text-center">
                        <h5>
                            <a href="{{ route('play.party.edit', ['id' => $adventureEncounter->id]) }}" class="text-primary"><span class="fa fa-edit"></span></a>
                            {{ $adventureEncounter->playSession->party->name }}
                        </h5>
                        <h4>&mdash; VS &mdash;</h4>
                        <h5>
                            {{ $adventureEncounter->encounter->name }}
                            <a href="{{ route('play.monsters.edit', ['id' => $adventureEncounter->id]) }}" class="text-danger"><span class="fa fa-edit"></span></a>
                        </h5>
                    </div>
                    <ul class="list-group mb-2" id="encounter-initiative-display">
                        @foreach($adventureEncounter->actors()->orderBy('initiative', 'DESC')->get() as $actor)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center @if(!$actor->isAlive()) list-group-item-danger @elseif($actor->has_acted) list-group-item-secondary @elseif($adventureEncounter->isCurrentActor($actor)) list-group-item-success @endif"
                                actor_id="{{$actor->id}}"
                            >
                            <span class="actor-info">
                                @if($actor->isSrMonster() || $actor->isCustomMonster())
                                    <img src="{{ route('monster_tokens.show', ['id' => $actor->token->id]) }}" class="img-thumbnail" style="width: 32px;">
                                @else
                                    <img src="/players/{{ $actor->pc->player_id }}" class='img-thumbnail' style="width: 32px;">
                                @endif
                                {{ $actor->name }}
                            </span>
                                <span class="initiative-container"><strong>Initiative:</strong> {{ $actor->initiative }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h5>Legend</h5>
                    <div class="d-flex align-self-center">
                        <div class="bg-success border border-dark legend-box mx-2">&nbsp;</div>: Up Next
                        <div class="bg-secondary border border-dark legend-box mx-2">&nbsp;</div>: Already Acted
                        <div class="bg-danger border border-dark legend-box mx-2">&nbsp;</div>: Dead Monster
                        <div class="border border-dark legend-box mx-2">&nbsp;</div>: Not yet Acted
                    </div>
                    <a href="{{ route('play.finish.encounter', ['id' => $adventureEncounter->id]) }}" role="button" class="btn btn-danger btn-block">Finish Encounter</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        function load_monster_target(actor_id)
        {
            let url = "/play/{{ $adventureEncounter->id }}/monster-target/" + actor_id;
            axios.get(url)
                .then(function (response)
                {
                    jQuery('#monster-target-container').html(response.data);
                    jQuery('#monster-target-container').show();
                    jQuery('#current-player-container').hide();
                })
                .catch(function (error)
                {
                    console.log(error);
                });
        }

        function update_monster_hp(damage_type, dmg, max)
        {
            let hp = parseInt(jQuery('#current_hp').val(), 10);
            if(damage_type == "DMG")
                hp -= dmg;
            else
                hp += dmg;
            if(hp < 0)
                hp = 0;
            if(hp > max)
                hp = max;
            jQuery('#current_hp').val(hp);

        }

        function finish_monster(actor_id)
        {
            let hp = parseInt(jQuery('#current_hp').val(), 10);
            let url = "/play/{{ $adventureEncounter->id }}/finish/monster/" + actor_id;
            let data = { 'hp': hp };
            axios.post(url, data)
                .then(function (response)
                {
                    jQuery('#turn_display_container').html(response.data)
                    jQuery('#monster-target-container').hide();
                    jQuery('#current-player-container').show();
                })
                .catch(function (error)
                {
                    console.log(error);
                });
        }

        function kill_monster(actor_id)
        {
            let hp = parseInt(jQuery('#current_hp').val(), 10);
            let url = "/play/{{ $adventureEncounter->id }}/finish/dead/" + actor_id;
            axios.get(url)
                .then(function (response)
                {
                    jQuery('#turn_display_container').html(response.data);
                    jQuery('#encounter-initiative-display li[actor_id=' + actor_id + ']').addClass('list-group-item-danger');
                    jQuery('#monster-target-container').hide();
                    jQuery('#current-player-container').show();
                })
                .catch(function (error)
                {
                    console.log(error);
                });
        }

        function kill_turn_monster()
        {
            jQuery('#status').val('DEAD');
            jQuery('#monster_turn_form').submit();
        }
    </script>
@endpush

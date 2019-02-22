@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-8">
                <form action="{{ route('play.monsters.update', ['id' => $adventureEncounter->id]) }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">Adventuring Encounter</div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($adventureEncounter->allMonsterActors() as $actor)
                                    <li class="list-group-item d-flex justify-content-between align-items-center" actor_id="{{ $actor->id }}">
                                        <div class="monster-info">
                                            <h5>{{ $actor->name }}</h5>
                                            <div class="input-group mb-2 ml-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Initiative: </div>
                                                </div>
                                                <input type="text" class="form-control" id="initiative_{{ $actor->id }}" name="initiative_{{ $actor->id }}" value="{{ $actor->initiative }}">
                                            </div>
                                            <div class="input-group mb-2 ml-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Initiative Position: </div>
                                                </div>
                                                <input type="text" class="form-control" id="initiative_pos_{{ $actor->id }}" name="initiative_pos_{{ $actor->id }}" value="{{ $actor->initiative_pos }}">
                                            </div>
                                            <div class="input-group mb-2 ml-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">HP: </div>
                                                </div>
                                                <input type="text" class="form-control" id="hp_{{ $actor->id }}" name="hp_{{ $actor->id }}" value="{{ $actor->current_hp }}">
                                            </div>
                                            <div class="input-group mb-2 ml-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Token: </div>
                                                </div>
                                                <select
                                                    class="custom-select"
                                                    name="token_{{ $actor->id }}"
                                                    id="token_{{ $actor->id }}"
                                                    onchange="jQuery('#token_monster_thumb_{{ $actor->id }}').prop('src', '/monster_tokens/' + jQuery(this).val());"
                                                >
                                                    @foreach($tokens as $token)
                                                        <option value="{{ $token->id }}" @if($token->id == $actor->token_id) selected @endif>{{ $token->name }}
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="monster-controls text-right">
                                            <input type="hidden" name="remove_{{ $actor->id }}" id="remove_{{ $actor->id }}" value="0" />
                                            <button
                                                type="button"
                                                class="btn btn-danger mb-2"
                                                onclick="toggleRemove({{ $actor->id }})"
                                                id="remove_btn_{{ $actor->id }}"
                                            ><span class="fa fa-trash"></span></button>
                                            <br>
                                            <input type="hidden" name="dead_{{ $actor->id }}" id="dead_{{ $actor->id }}" value="{{ $actor->isAlive()? '0': '1' }}" />
                                            <button
                                                    type="button"
                                                    @if($actor->isAlive())
                                                    class="btn btn-success mb-2"
                                                    @else
                                                    class="btn btn-danger"
                                                    @endif
                                                    onclick="toggle_dead({{ $actor->id }})"
                                                    id="dead_btn_{{ $actor->id }}"
                                            >
                                                @if($actor->isAlive())
                                                    ALIVE
                                                @else
                                                    DEAD
                                                @endif
                                            </button>
                                            <br>
                                            <input type="hidden" name="acted_{{ $actor->id }}" id="acted_{{ $actor->id }}" value="{{ $actor->has_acted? '1': '0' }}" />
                                            <button
                                                    type="button"
                                                    @if(!$actor->has_acted)
                                                    class="btn btn-success mb-2"
                                                    @else
                                                    class="btn btn-secondary"
                                                    @endif
                                                    onclick="toggle_acted({{ $actor->id }})"
                                                    id="acted_btn_{{ $actor->id }}"
                                            >
                                                @if($actor->has_acted)
                                                    Acted
                                                @else
                                                    Not Acted
                                                @endif
                                            </button>
                                            <br>
                                            <img src="{{ route('monster_tokens.show', ['id' => $actor->token_id]) }}" class="img-thumbnail ml-3" id="token_monster_thumb_{{ $actor->id }}">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update Adventuring Encounter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function toggle_dead(actor_id)
        {
            let isAlive = (jQuery('#dead_' + actor_id).val() == "1")? false: true;
            isAlive = !isAlive;
            let aliveBtn = jQuery('#dead_btn_' + actor_id);
            jQuery('#dead_' + actor_id).val((isAlive? '0': '1'));
            if(isAlive)
            {
                aliveBtn.removeClass('btn-danger');
                aliveBtn.addClass('btn-success');
                aliveBtn.text('ALIVE');
            }
            else
            {
                aliveBtn.removeClass('btn-success');
                aliveBtn.addClass('btn-danger');
                aliveBtn.text('DEAD');
            }
        }

        function toggleRemove(actor_id)
        {
            let isRemoved = (jQuery('#remove_' + actor_id).val() == "1")? true: false;
            isRemoved = !isRemoved;
            let removedBtn = jQuery('#remove_btn_' + actor_id);
            let removeSpan = jQuery('#remove_btn_' + actor_id + ' span');
            let liContainer = jQuery('li[actor_id=' + actor_id + ']');
            jQuery('#remove_' + actor_id).val((isRemoved? '1': '0'));
            if(isRemoved)
            {
                removedBtn.removeClass('btn-danger');
                removedBtn.addClass('btn-success');
                removeSpan.removeClass('fa-trash');
                removeSpan.addClass('fa-check');
                liContainer.addClass('bg-secondary');
            }
            else
            {
                removedBtn.removeClass('btn-success');
                removedBtn.addClass('btn-danger');
                removeSpan.removeClass('fa-check');
                removeSpan.addClass('fa-trash');
                liContainer.removeClass('bg-secondary');
            }
        }

        function toggle_acted(actor_id)
        {
            let hasActed = (jQuery('#acted_' + actor_id).val() == "1")? true: false;
            hasActed = !hasActed;
            let actedBtn = jQuery('#acted_btn_' + actor_id);
            jQuery('#acted_' + actor_id).val((hasActed? '1': '0'));
            if(hasActed)
            {
                actedBtn.removeClass('btn-success');
                actedBtn.addClass('btn-secondary');
                actedBtn.text('Acted');
            }
            else
            {
                actedBtn.removeClass('btn-secondary');
                actedBtn.addClass('btn-success');
                actedBtn.text('Not Acted');
            }
        }
    </script>
@endpush
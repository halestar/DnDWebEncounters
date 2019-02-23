@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-8">
                <form
                    action="{{ route('play.monster.update', ['adventure_encounter' => $adventureEncounter->id, 'actor_id' => $actor->id]) }}"
                    method="POST">

                    @csrf
                    <div class="card">
                        <div class="card-header">Editing {{ $actor->name }}</div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center"
                                    actor_id="{{ $actor->id }}">
                                    <div class="monster-info">
                                        <h5>{{ $actor->name }}</h5>
                                        <div class="input-group mb-2 ml-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Initiative:</div>
                                            </div>
                                            <input type="text" class="form-control" id="initiative" name="initiative"
                                                   value="{{ $actor->initiative }}">
                                        </div>
                                        <div class="input-group mb-2 ml-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Initiative Position:</div>
                                            </div>
                                            <input type="text" class="form-control" id="initiative_pos"
                                                   name="initiative_pos" value="{{ $actor->initiative_pos }}">
                                        </div>
                                        <div class="input-group mb-2 ml-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">HP:</div>
                                            </div>
                                            <input type="text" class="form-control" id="hp" name="hp"
                                                   value="{{ $actor->current_hp }}">
                                        </div>
                                        <div class="input-group mb-2 ml-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Token:</div>
                                            </div>
                                            <select
                                                class="custom-select"
                                                name="token"
                                                id="token"
                                                onchange="jQuery('#token_monster_thumb').prop('src', '/monster_tokens/' + jQuery(this).val());"
                                            >
                                                @foreach($tokens as $token)
                                                    <option value="{{ $token->id }}"
                                                            @if($token->id == $actor->token_id) selected @endif>{{ $token->name }}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="monster-controls text-right">
                                        <input type="hidden" name="dead" id="dead"
                                               value="{{ $actor->isAlive()? '0': '1' }}"/>
                                        <button
                                            type="button"
                                            @if($actor->isAlive())
                                            class="btn btn-success mb-2"
                                            @else
                                            class="btn btn-danger"
                                            @endif
                                            onclick="toggle_dead()"
                                            id="dead_btn"
                                        >
                                            @if($actor->isAlive())
                                                ALIVE
                                            @else
                                                DEAD
                                            @endif
                                        </button>
                                        <br>
                                        <input type="hidden" name="acted" id="acted"
                                               value="{{ $actor->has_acted? '1': '0' }}"/>
                                        <button
                                            type="button"
                                            @if(!$actor->has_acted)
                                            class="btn btn-success mb-2"
                                            @else
                                            class="btn btn-secondary"
                                            @endif
                                            onclick="toggle_acted()"
                                            id="acted_btn"
                                        >
                                            @if($actor->has_acted)
                                                Acted
                                            @else
                                                Not Acted
                                            @endif
                                        </button>
                                        <br>
                                        <img src="{{ route('monster_tokens.show', ['id' => $actor->token_id]) }}"
                                             class="img-thumbnail ml-3" id="token_monster_thumb">
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update Monster</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function toggle_dead() {
            let isAlive = (jQuery('#dead').val() == "1") ? false : true;
            isAlive = !isAlive;
            let aliveBtn = jQuery('#dead_btn');
            jQuery('#dead').val((isAlive ? '0' : '1'));
            if (isAlive) {
                aliveBtn.removeClass('btn-danger');
                aliveBtn.addClass('btn-success');
                aliveBtn.text('ALIVE');
            } else {
                aliveBtn.removeClass('btn-success');
                aliveBtn.addClass('btn-danger');
                aliveBtn.text('DEAD');
            }
        }

        function toggle_acted() {
            let hasActed = (jQuery('#acted').val() == "1") ? true : false;
            hasActed = !hasActed;
            let actedBtn = jQuery('#acted_btn');
            jQuery('#acted').val((hasActed ? '1' : '0'));
            if (hasActed) {
                actedBtn.removeClass('btn-success');
                actedBtn.addClass('btn-secondary');
                actedBtn.text('Acted');
            } else {
                actedBtn.removeClass('btn-secondary');
                actedBtn.addClass('btn-success');
                actedBtn.text('Not Acted');
            }
        }
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <form action="{{ route('play.party.update', ['adventure_encounter' => $adventureEncounter->id]) }}"
                  method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Adventuring Party</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($adventureEncounter->pcActors() as $actor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $actor->pc->name }}
                                    <div class="form-group ml-1 text-center border rounded p-1">
                                        <label for="ac_{{ $actor->id }}">AC</label>
                                        <input type="text" style="width: 60px;" class="form-control text-center"
                                               id="ac_{{ $actor->id }}" name="ac_{{ $actor->id }}"
                                               value="{{ $actor->pc->ac }}">
                                    </div>
                                    <div class="form-group ml-1 text-center border rounded p-1">
                                        <label for="pp_{{ $actor->id }}">PP</label>
                                        <input type="text" style="width: 60px;" class="form-control text-center"
                                               id="pp_{{ $actor->id }}" name="pp_{{ $actor->id }}"
                                               value="{{ $actor->pc->pp }}">
                                    </div>
                                    <div class="form-group ml-1 text-center border rounded p-1">
                                        <label for="spell_dc_{{ $actor->id }}">Spell DC</label>
                                        <input type="text" style="width: 60px;" class="form-control text-center"
                                               id="spell_dc_{{ $actor->id }}" name="spell_dc_{{ $actor->id }}"
                                               value="{{ $actor->pc->spellDc }}">
                                    </div>
                                    <div class="form-group ml-1 text-center border rounded p-1">
                                        <label for="initiative_pos_{{ $actor->id }}">Position</label>
                                        <input type="text" style="width: 60px;" class="form-control text-center"
                                               id="initiative_pos_{{ $actor->id }}"
                                               name="initiative_pos_{{ $actor->id }}"
                                               value="{{ $actor->initiative_pos }}">
                                    </div>
                                    <div class="form-group ml-1 text-center border rounded p-1">
                                        <label for="initiative_{{ $actor->id }}">Initiative</label>
                                        <input type="text" style="width: 60px;" class="form-control text-center"
                                               id="initiative_{{ $actor->id }}" name="initiative_{{ $actor->id }}"
                                               value="{{ $actor->initiative }}">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Update Adventuring Party</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

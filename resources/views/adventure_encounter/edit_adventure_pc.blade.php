@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <form
                    action="{{ route('play.pc.update', ['id' => $adventureEncounter->id, 'actor_id' => $actor->id]) }}"
                    method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">Editing {{ $actor->name }}</div>
                        <div class="card-body p-1">
                            <ul class="list-group">
                                <li class="list-group-item p-1">
                                    <h4>{{ $actor->pc->name }}</h4>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                        <div class="form-group ml-1 text-center border rounded p-1">
                                            <label for="ac">AC</label>
                                            <input type="text" style="width: 60px;" class="form-control text-center" id="ac"
                                                   name="ac" value="{{ $actor->pc->ac }}">
                                        </div>
                                        <div class="form-group ml-1 text-center border rounded p-1">
                                            <label for="pp">PP</label>
                                            <input type="text" style="width: 60px;" class="form-control text-center" id="pp"
                                                   name="pp" value="{{ $actor->pc->pp }}">
                                        </div>
                                        <div class="form-group ml-1 text-center border rounded p-1">
                                            <label for="spell_dc">Spell DC</label>
                                            <input type="text" style="width: 60px;" class="form-control text-center"
                                                   id="spell_dc" name="spell_dc" value="{{ $actor->pc->spellDc }}">
                                        </div>
                                        <div class="form-group ml-1 text-center border rounded p-1">
                                            <label for="initiative_pos}">Position</label>
                                            <input type="text" style="width: 60px;" class="form-control text-center"
                                                   id="initiative_pos" name="initiative_pos"
                                                   value="{{ $actor->initiative_pos }}">
                                        </div>
                                        <div class="form-group ml-1 text-center border rounded p-1">
                                            <label for="initiative">Initiative</label>
                                            <input type="text" style="width: 60px;" class="form-control text-center"
                                                   id="initiative" name="initiative" value="{{ $actor->initiative }}">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block">Update PC</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

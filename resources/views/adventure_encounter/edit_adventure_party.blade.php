@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <form action="{{ route('play.party.update', ['id' => $adventureEncounter->id]) }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Adventuring Party</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($adventureEncounter->pcActors() as $actor)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $actor->pc->name }}
                                    <div class="input-group mb-2 ml-2" style="flex: 0 0 35%;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Initiative: </div>
                                        </div>
                                        <input type="text" class="form-control" id="initiative_{{ $actor->id }}" name="initiative_{{ $actor->id }}" value="{{ $actor->initiative }}">
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
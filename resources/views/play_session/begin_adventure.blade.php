@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Adventure Party
                </div>
                <div class="card-body">
                    <h5 class="border-bottom">
                        <strong>Current Party: </strong>
                        @if($playSession->party == null)
                            None.
                        @else
                            {{ $playSession->party->name }}
                            <button class="btn btn-primary btn-sm ml-3" onclick="jQuery('#party_builder').show();jQuery('#party_display').hide();"><span class="fa fa-edit"></span></button>
                        @endif
                    </h5>
                    <div id="party_builder" class="mt-3" @if($playSession->party != null) style="display: none; @endif">
                        <form action="{{ route('adventure.party.assign', ['play_session_id' => $playSession->id]) }}" method="POST">
                            @csrf
                            <h6>Import Existing Party</h6>
                            <div class="input-group">
                                <select class="custom-select form-control" id="party_id" name="party_id">
                                    <option value=""></option>
                                    @foreach($parties as $party)
                                    <option value="{{ $party->id }}" @if($playSession->party != null && $playSession->party->id == $party->id) selected @endif>{{ $party->name }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <input type="submit" class="btn btn-outline-primary" value="Assign" />
                                </div>
                            </div>
                        </form>
                        <p class="text-center my-3">
                            &mdash; OR &mdash;
                        </p>
                        <h6>Select Party Members</h6>
                        <form action="{{ route('adventure.party.create', ['play_session_id' => $playSession->id]) }}" method="POST">
                            @csrf
                            @if($playSession->party != null)
                                <input type="hidden" name="party_id" id="party_id" value="{{ $playSession->party->id }}" />
                            @endif
                            <div class="form-group">
                                <label for="name">Party Name</label>
                                <input type="text" name="name" id="name" class="form-control" @if($playSession->party != null) value="{{ $playSession->party->name }}" @endif />
                            </div>
                            <p class="border-bottom">Party Members</p>
                            <ul class="list-group mb-3" style="max-height: 600px; overflow:auto;">
                                @foreach($pcs as $pc)
                                <li class="list-group-item @if($playSession->party != null && $playSession->party->pcs->contains('id', $pc->id)) active @endif" pc_id="{{ $pc->id }}" >
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="pcs[]"
                                                @if($playSession->party != null && $playSession->party->pcs->contains('id', $pc->id)) checked @endif
                                                id="pc_{{ $pc->id }}"
                                                value="{{ $pc->id }}"
                                                onclick="toggleActive(this)"
                                            />
                                            <label class="form-check-label" for="pc_{{ $pc->id }}">{{ $pc->name }}</label>
                                        </div>
                                        <span class="level-span"><strong>Level: </strong>{{ $pc->level }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <input type="submit" class="btn btn-primary btn-block" value="Use this Party" />
                            @if($playSession->party != null)
                                <button type="button" class="btn btn-danger btn-block" onclick="jQuery('#party_builder').hide();jQuery('#party_display').show();">Cancel</button>
                            @endif
                        </form>
                    </div>
                    @if($playSession->party != null)
                    <div id="party_display">
                        <strong>APL: </strong>{{ $playSession->party->apl }}
                        <ul class="list-group">
                            @foreach($playSession->party->pcs as $pc)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $pc->name }}
                                <span class="level-span"><strong>Level: </strong>{{ $pc->level }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Current Encounter
                </div>
                <div class="card-body">
                    @if($playSession->currentEncounter())
                        <a href="{{ route('play', ['adventure_encounter' => $playSession->currentEncounter()->id]) }}" role="button" class="btn btn-warning btn-block">Continue Adventure</a>
                    @else
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Quickplay Encounter:</span>
                        </div>
                        <select name="quick_encounter_id" id="quick_encounter_id" class="custom-select">
                            <option value=""></option>
                            @foreach($encounters as $encounter)
                                <option value="{{ $encounter->id }}">{{ $encounter->name }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-primary" onclick="window.location='/adventure/encounter/play/{{ $playSession->id }}/'+jQuery('#quick_encounter_id').val();"><span class="fa fa-play"></span></button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    Adventure Encounters
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="module_id">Current Module:</label>
                        </div>
                        <form action="{{ route('adventure.module.assign', ['play_session_id' => $playSession->id]) }}" method="POST" id="module_assign_form">
                            @csrf
                            <select name="module_id" id="module_id" class="custom-select" onchange="jQuery('form#module_assign_form').submit();">
                                <option value="">None</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" @if($module->id == $playSession->module_id) selected @endif>{{ $module->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <hr>
                    <h6>Encounter Queue</h6>
                    <ul class="list-group mb-3">
                        @foreach($playSession->encounters as $encounter)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $encounter->name }}
                            <span class="encounter_control d-flex">
                                @if(!$playSession->currentEncounter())
                                <a role="button" class="btn btn-outline-primary btn-sm" href="{{ route('adventure.encounter.play', ['play_session_id' => $playSession->id, 'encounter_id' => $encounter->id]) }}"><span class="fa fa-play"></span></a>
                                @endif
                                <form action="{{ route('adventure.encounter.remove', ['play_session_id' => $playSession->id]) }}" method="POST" class="form-inline ml-1">
                                    @csrf
                                    <input type="hidden" name="encounter_id" value="{{ $encounter->id }}" />
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash"></span></button>
                                </form>
                            </span>
                        </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('adventure.encounter.add', ['play_session_id' => $playSession->id]) }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Encounter:</span>
                            </div>
                            <select name="encounter_id" id="encounter_id" class="custom-select">
                                <option value=""></option>
                                @foreach($encounters as $encounter)
                                <option value="{{ $encounter->id }}">{{ $encounter->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <input type="submit" class="btn btn-outline-primary" value="Add" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function toggleActive(element)
        {
            if(jQuery(element).is(':checked'))
                jQuery('li[pc_id=' + jQuery(element).val() + ']').addClass('active');
            else
                jQuery('li[pc_id=' + jQuery(element).val() + ']').removeClass('active');
        }
    </script>
@endpush

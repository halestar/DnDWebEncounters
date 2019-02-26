@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
                <form action="{{ route('modules.update', ['id' => $module->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            Update Module
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Module Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $module->name }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Description</label>
                                <textarea class="form-control" id="description"
                                          name="description">{{ $module->description }}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Tier</label>
                                        <select class="custom-select" id="tier" name="tier">
                                            <option value="1" @if($module->tier == 1) selected @endif>1</option>
                                            <option value="2" @if($module->tier == 2) selected @endif>2</option>
                                            <option value="3" @if($module->tier == 3) selected @endif>3</option>
                                            <option value="4" @if($module->tier == 4) selected @endif>4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name">Optimized for Level</label>
                                        <input type="text" class="form-control" id="optimized_level" name="optimized_level"
                                               value="{{ $module->optimized_level }}">
                                    </div>
                                </div>
                            </div>
                            <h4 class="d-flex justify-content-between border-bottom border-dark">
                                Encounters
                            </h4>
                            <div id="encounter_manager_containter" style="max-height: 600px; overflow: auto;"></div>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary btn-block" value="Update Module"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var encounterManager = new EncounterManager('encounter_manager_containter', "{{ route('modules.encounter_data') }}");
        encounterManager.loadSelection({{ $module->encounters()->pluck('id') }});
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('modules.store') }}" method="post" id="create_form">
                @csrf
                <div class="card">
                    <div class="card-header">
                        Add a New Module
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Module Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Tier</label>
                                    <select class="custom-select" id="tier" name="tier">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Optimized for Level</label>
                                    <input type="text" class="form-control" id="optimized_level" name="optimized_level">
                                </div>
                            </div>
                        </div>
                        <h4 class="d-flex justify-content-between border-bottom border-dark">
                            Encounters
                        </h4>
                        <div id="encounter_manager_container" style="max-height: 600px; overflow: auto;"></div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Module"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var encounterManager = new EncounterManager('encounter_manager_container', "{{ route('modules.encounter_data') }}");
    </script>
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('encounters.store') }}" method="post" id="create_form">
        @csrf
        <input type="hidden" name="monsters" id="monsters"/>
        <input type="hidden" name="cr" id="cr"/>
        <div class="card">
            <div class="card-header">
                Add a New Encounter
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Encounter Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <h4 class="d-flex justify-content-between border-bottom border-dark">
                    Monsters
                    <small>
                        <strong>CR:</strong>
                        <span id="cr_display">0</span>
                    </small>
                </h4>
                <label class="font-weight-bold">Search for Monster to Add: </label>
                <input type="text" id="monster_search" class="form-control" placeholder="Monster Name"
                       aria-label="Monster Name" aria-describedby="add_prepend">
                <div class="list-group mt-3" id="encounter_monster_container"></div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Add Encounter</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        var monsterManager = new MonsterManager('encounter_monster_container', 'monster_search', "{{ route('monsters.search') }}", 'cr_display');

        function submitForm()
        {
            var form = jQuery('#create_form');
            jQuery('#monsters').val(JSON.stringify(monsterManager.getMonsters()));
            jQuery('#cr').val(jQuery('#cr_display').html());
            form.submit();
        }
    </script>
@endpush

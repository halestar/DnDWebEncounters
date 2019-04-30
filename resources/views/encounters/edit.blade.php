@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('encounters.update', ['id' => $encounter->id]) }}" method="POST" id="update_form">
                @method('PUT')
                @csrf
                <input type="hidden" name="monsters" id="monsters"/>
                <input type="hidden" name="cr" id="cr"/>
                <div class="card">
                    <div class="card-header">
                        Update Encounter
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Encounter Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="{{ $encounter->name }}">
                        </div>
                        <h4 class="d-flex justify-content-between border-bottom border-dark">
                            Monsters
                            <small>
                                <strong>CR:</strong>
                                <span id="cr_display">{{ $encounter->cr }}</span>
                            </small>
                        </h4>
                        <label class="font-weight-bold">Search for Monster to Add: </label>
                        <input type="text" id="monster_search" class="form-control" placeholder="Monster Name"
                               aria-label="Monster Name" aria-describedby="add_prepend">
                        <div class="list-group mt-3" id="encounter_monster_container"></div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary btn-block" onclick="submitForm()">Update
                            Encounter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var monsterManager = new MonsterManager('encounter_monster_container', 'monster_search', "{{ route('monsters.search') }}", 'cr_display');
        monsterManager.loadMonsters(
            [
                @foreach($encounter->customMonsters as $monster)
                {
                    monster_id: '{{ $monster->id }}',
                    name: '{{ $monster->name }}',
                    cr: '{{ $monster->cr }}',
                },
                @endforeach
                @foreach($encounter->srMonsters as $monster)
                {!! json_encode($monster) !!},
                @endforeach
            ]
        );
        function submitForm()
        {
            var form = jQuery('#update_form');
            jQuery('#monsters').val(JSON.stringify(monsterManager.getMonsters()));
            jQuery('#cr').val(jQuery('#cr_display').html());
            form.submit();
        }
    </script>
@endpush

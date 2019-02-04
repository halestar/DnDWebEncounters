@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-8">
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
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <select class="custom-select" id="tier" name="tier">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
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
                        <div id="encounter_manager_containter" style="max-height: 600px; overflow: auto;"></div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-block" value="Add Module" />
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

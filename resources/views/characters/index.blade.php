@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h3>
                    PC's
                    <a href="{{ route('pcs.create') }}" class="text-primary small"><span class="fa fa-plus"></span></a>
                    <small>
                        <label for="player_selection">View for player:</label>
                        <select name="player_selection" id="player_selection" onchange="updatePlayerFilter(jQuery(this).val())">
                            <option value="ALL" @if($selectedPlayer == "ALL") selected @endif>All Players</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}" @if($selectedPlayer == $player->id) selected @endif>{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </small>
                </h3>
                <table class="table table-bordered" id="players-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Class</th>
                            <th>Race</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
<script>
    function updatePlayerFilter(filter)
    {
        var url;
        if(filter == "ALL")
            url = '{!! route('pcs.index') !!}';
        else
            url = '/players/pcs/' + filter;
        window.location = url;
    }

    function promptDelete(id)
    {
        if(confirm('Are you sure you wish to delete this PC?'))
        {
            var form = makeDeleteForm('/pcs/'+ id);
            form.submit();
        }
    }

    jQuery('#players-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/pcs/data/{{ $selectedPlayer }}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'level', name: 'level' },
            { data: 'characterClass', name: 'class' },
            { data: 'characterRace', name: 'race' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/pcs/" + id + "/edit' class='text-primary mr-2'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

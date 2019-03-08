@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <div class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    <span class="h4 align-self-end">Player Characters</span>
                    <a href="{{ route('pcs.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New PC</a>
                </div>
                <small>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="player_selection">View PC's for player:</label>
                        </div>
                        <select name="player_selection" id="player_selection" onchange="updatePlayerFilter(jQuery(this).val())" class="custom-select">
                            <option value="ALL" @if($selectedPlayer == "ALL") selected @endif>All Players</option>
                            @foreach($players as $player)
                                <option value="{{ $player->id }}" @if($selectedPlayer == $player->id) selected @endif>{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </small>
                <table class="table table-responsive table-bordered" id="players-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Type</th>
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
            {
                data: null,
                render: function(data)
                {
                    return data.characterRace + " " + data.characterClass;
                }
            },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/pcs/" + id + "/edit' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

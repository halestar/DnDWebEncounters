@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h3>
                    Players
                    <a href="{{ route('players.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </h3>
                <table class="table table-bordered" id="players-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>DCI</th>
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
    function promptDelete(id)
    {
        if(confirm('Are you sure you wish to delete this player?'))
        {
            var form = makeDeleteForm('/players/'+ id);
            form.submit();
        }
    }

    jQuery('#players-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('players.data') !!}',
        columns: [
            {
                data: 'id',
                name: 'portrait',
                render: function(data)
                {
                    return "<img src='/players/" + data + "' class='img-thumbnail'>";
                }
            },
            { data: 'name', name: 'name' },
            { data: 'dci', name: 'dci' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/players/" + id + "/edit' class='btn btn-sm btn-primary mr-1'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='btn btn-sm btn-danger mr-1'><span class='fa fa-trash'></span></a>" +
                    "<a href='/players/pcs/" + id + "' class='btn btn-sm btn-info'><span class='fa fa-eye'></span></a>"
                }
            }
        ]
    });
</script>
@endpush

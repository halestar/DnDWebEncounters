@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    Players
                    <a href="{{ route('players.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New Player</a>
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="players-table" style="width: 100%;">
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
                    return "<a href='/players/" + id + "/edit' class='h4 text-primary mr-2'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='h4 text-danger mr-2'><span class='fa fa-trash'></span></a>" +
                    "<a href='/players/pcs/" + id + "' class='h4 text-info'><span class='fa fa-eye'></span></a>"
                }
            }
        ]
    });
</script>
@endpush

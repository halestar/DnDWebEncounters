@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    Parties
                    <a href="{{ route('parties.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New Party</a>
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="players-table" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Party Name</th>
                            <th>APL</th>
                            <th># Players</th>
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
        if(confirm('Are you sure you wish to delete this party?'))
        {
            var form = makeDeleteForm('/parties/'+ id);
            form.submit();
        }
    }

    jQuery('#players-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('parties.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'apl', name: 'apl' },
            {
                data: null,
                render: function (data)
                {
                    return data.pcs.length;
                }
            },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/parties/" + id + "/edit' class='h4 text-primary mr-2'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='h4 text-danger mr-2'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

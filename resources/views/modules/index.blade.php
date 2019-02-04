@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <h3>
                    Modules
                    <a href="{{ route('modules.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </h3>
                <table class="table table-bordered" id="modules-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Tier</th>
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
        if(confirm('Are you sure you wish to delete this module?'))
        {
            var form = makeDeleteForm('/modules/'+ id);
            form.submit();
        }
    }

    jQuery('#modules-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('modules.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'tier', name: 'tier' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/modules/" + id + "/edit' class='btn btn-sm btn-primary mr-1'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='btn btn-sm btn-danger mr-1'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

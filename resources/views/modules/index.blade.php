@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    Modules
                    <a href="{{ route('modules.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New Module</a>
                </h3>
                <table class="table table-bordered" id="modules-table" style="width: 100%;">
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
                    return "<a href='/modules/" + id + "/edit' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

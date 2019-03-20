@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    Encounters
                    <a href="{{ route('encounters.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New Encounter</a>
                </h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="encounters-table" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>CR</th>
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
        if(confirm('Are you sure you wish to delete this encounter?'))
        {
            var form = makeDeleteForm('/encounters/'+ id);
            form.submit();
        }
    }

    jQuery('#encounters-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('encounters.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cr', name: 'cr' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/encounters/" + id + "/edit' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

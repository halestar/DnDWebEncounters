@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h3>
                    Encounters
                    <a href="{{ route('encounters.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                </h3>
                <table class="table table-bordered" id="encounters-table">
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
                    return "<a href='/encounters/" + id + "/edit' class='btn btn-sm btn-primary mr-1'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='btn btn-sm btn-danger mr-1'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

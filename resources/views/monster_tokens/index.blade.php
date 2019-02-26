@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                    Monster Tokens
                    <a href="{{ route('monster_tokens.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New Monster Token</a>
                </h3>
                <table class="table table-bordered" id="tokens-table" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>Token</th>
                        <th>Name</th>
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
        if(confirm('Are you sure you wish to delete this token?'))
        {
            var form = makeDeleteForm('/monster_tokens/'+ id);
            form.submit();
        }
    }

    jQuery('#tokens-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('monster_tokens.data') !!}',
        columns: [
            {
                data: 'id',
                render: function(id)
                {
                    return "<img src='/monster_tokens/" + id + "' class='img-thumbnail'>";
                }
            },
            { data: 'name', name: 'name' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/monster_tokens/" + id + "/edit' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

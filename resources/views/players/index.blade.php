@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-5">
                <h3>
                    Players
                    <a href="{{ route('players.add') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
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
                    return "<img src='/players/portrait/" + data + "' class='img-thumbnail'>";
                }
            },
            { data: 'name', name: 'name' },
            { data: 'dci', name: 'dci' },
            {
                render: function(data)
                {
                    return "<a href='#' class='btn btn-sm btn-primary mr-2'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' class='btn btn-sm btn-danger'><span class='fa fa-trash'></span></a>";''
                }
            }
        ]
    });
</script>
@endpush
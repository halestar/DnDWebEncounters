@extends('layouts.admin')

@section('admin_content')
    <table class="table table-bordered" id="user-table">
        <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Last Logon</th>
            <th></th>
        </tr>
        </thead>
    </table>
@endsection
@push('scripts')
    <script>
        jQuery('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.users.table') !!}',
            columns: [
                {
                    className: 'dt-body-center',
                    data: 'avatar_url',
                    name: 'portrait',
                    render: function(data)
                    {
                        if(data == "")
                            return "<img src='/players/" + data + "' class='img-thumbnail' style='width: 32px;'>";
                        return "<img src='"+ data + "' class='img-thumbnail' style='width: 32px;'>";
                    }
                },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    render: function(data)
                    {
                        let last_login = new Date(Date.parse(data));
                        return last_login.getMonth() + "/" + last_login.getDate() + "/" + last_login.getFullYear() + " @ " + last_login.getHours() + ":" + last_login.getMinutes();
                    }
                },
                {
                    className: 'dt-body-center',
                    data: 'id',
                    render: function(id)
                    {
                        return "<a href='/admin/users/edit/" + id + "' class='text-primary mr-1'><span class='fa fa-edit'></span></a>" +
                            "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger mr-1'><span class='fa fa-trash'></span></a>";
                    }
                }
            ]
        });
    </script>
@endpush
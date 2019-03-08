@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                Users
                <a href="{{ route('admin.users.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New User</a>
            </h3>
            <table class="table table-responsive table-bordered" id="user-table" style="width: 100%;">
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function promptDelete(id)
        {
            if(confirm('Are you sure you wish to delete this user?'))
            {
                var form = makeDeleteForm('/admin/users/delete/'+ id);
                form.submit();
            }
        }

        jQuery('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.users.table') !!}',
            columns: [
                {
                    className: 'dt-body-center',
                    data: 'avatar_url',
                    render: function(data)
                    {
                        if(data == null)
                            return "<img src='/img/players_icon.png' class='img-thumbnail' style='width: 32px;'>";
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
                        return (last_login.getMonth() + 1) + "/" + last_login.getDate() + "/" + last_login.getFullYear() + " @ " + last_login.getHours() + ":" + ('00' + last_login.getMinutes()).slice(-2);
                    }
                },
                {
                    className: 'dt-body-center',
                    data: 'id',
                    render: function(id)
                    {
                        return "<a href='/admin/users/edit/" + id + "' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                            "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                    }
                }
            ]
        });
    </script>
@endpush
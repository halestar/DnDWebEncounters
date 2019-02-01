@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12">
                <ul class="nav nav-tabs" id="monsterTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-monsters" data-toggle="tab" href="#custom_monsters" role="tab" aria-control="custom_monsters" aria-selected="true">
                            Custom Monsters
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sr-monsters" data-toggle="tab" href="#sr_monsters" role="tab" aria-control="sr_monsters">
                            SR Monsters
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="monsterTabContent">
                    <div class="tab-pane fade show active" id="custom_monsters" role="tabpanel" aria-labelledby="custom-monsters">
                        <h3>
                            Custom Monsters
                            <a href="{{ route('monsters.create') }}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                        </h3>
                        <table class="table table-bordered" id="custom_monster_table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>CR</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="sr_monsters" role="tabpanel" aria-labelledby="sr-monsters">
                        <table class="table table-bordered" id="sr_monster_table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>CR</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
<script>
    function promptDelete(id)
    {
        if(confirm('Are you sure you wish to delete this Custom Monster?'))
        {
            var form = makeDeleteForm('/monsters/'+ id);
            form.submit();
        }
    }

    jQuery('#sr_monster_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('pcs.srdata') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cr', name: 'cr' },
        ]
    });

    jQuery('#custom_monster_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('pcs.customdata') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cr', name: 'cr' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/monsters/" + id + "/edit' class='btn btn-sm btn-primary mr-2'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='btn btn-sm btn-danger'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

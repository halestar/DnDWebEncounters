@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
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
                <div class="tab-content pt-3" id="monsterTabContent">
                    <div class="tab-pane fade show active" id="custom_monsters" role="tabpanel" aria-labelledby="custom-monsters">
                        <h3 class="d-flex justify-content-between border-bottom pb-1 mb-3">
                            Custom Monsters
                            <a href="{{ route('monsters.create') }}" role="button"
                               class="btn btn-primary btn-sm align-self-end"><span
                                    class="fa fa-plus border-right pr-1 mr-1"></span>Add New Custom Monster</a>
                        </h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="custom_monster_table" style="width: 100%;">
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
                    <div class="tab-pane fade" id="sr_monsters" role="tabpanel" aria-labelledby="sr-monsters">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="sr_monster_table" style="width: 100%;">
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
        ajax: '{!! route('monsters.srdata') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cr', name: 'cr' },
        ],
        'fnRowCallback': function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            jQuery(nRow).click(function () {
                window.location = "/monsters/show-sr/" + aData.idx;
            });
            jQuery(nRow).addClass('cursor-pointer');
            return nRow;
        }
    });

    jQuery('#custom_monster_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('monsters.customdata') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'cr', name: 'cr' },
            {
                data: 'id',
                render: function(id)
                {
                    return "<a href='/monsters/" + id + "/edit' class='text-primary mr-2 h4'><span class='fa fa-edit'></span></a>" +
                        "<a href='#' onclick='promptDelete(" + id + ")' class='text-danger h4'><span class='fa fa-trash'></span></a>";
                }
            }
        ]
    });
</script>
@endpush

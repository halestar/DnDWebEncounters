@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('parties.update', ['id' => $party->id]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name">Party Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $party->name }}" />
                </div>
                <div class="border-bottom mb-2 pb-1 d-flex justify-content-between">
                    Party Members
                    <div class="pc_control">
                        <a href="{{ route('pcs.create') }}" role="button" class="btn btn-primary btn-sm"><span class="fa fa-plus border-right pr-1 mr-1"></span>Add New PC</a>
                    </div>
                </div>
                <div id="pc_manager_container"></div>
                <input type="submit" class="btn btn-primary btn-block" value="Use this Party"/>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
    <script>
        var playerManager = new PlayerManager('pc_manager_container', "{{ route('pcs.pc_data') }}");
        playerManager.loadSelection({{ $party->pcs()->pluck('id') }});
    </script>
@endpush
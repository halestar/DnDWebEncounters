@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col col-lg-8">
            <form action="{{ route('players.update', ['id' => $player->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        Update Player
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Player Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $player->name }}">
                        </div>
                        <div class="form-group">
                            <label for="dci">DCI</label>
                            <input type="text" class="form-control" id="dci" name="dci" value="{{ $player->dci }}">
                        </div>
                        <img class="img-thumbnail mx-auto d-block" src="{{ route('players.show', ['id' => $player->id]) }}"
                             alt="portrait"/>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="portrait" name="portrait">
                            <label class="custom-file-label" for="portrait">Player Portrait</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

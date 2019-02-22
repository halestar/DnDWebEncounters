<form action="{{ route('adventure.party.create', ['play_session_id' => $playSession->id]) }}" method="POST">
    @csrf
    @if($party_edit != null)
        <input type="hidden" name="party_id" id="party_id" value="{{ $party_edit->id }}" />
    @endif
    <div class="form-group">
        <label for="name">Party Name</label>
        <input type="text" name="name" id="name" class="form-control" @if($party_edit != null) value="{{ $party_edit->name }}" @endif />
    </div>
    <p class="border-bottom">Party Members</p>
    <div class="list-group mb-3" style="max-height: 600px; overflow:auto;">
        @foreach($pcs as $pc)
            <label for="pc_{{ $pc->id }}" class="list-group-item @if($party_edit != null && $party_edit->pcs->contains('id', $pc->id)) active @endif" pc_id="{{ $pc->id }}" >
                <div class="d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input
                                class="form-check-input"
                                type="checkbox"
                                name="pcs[]"
                                @if($party_edit != null && $party_edit->pcs->contains('id', $pc->id)) checked @endif
                                id="pc_{{ $pc->id }}"
                                value="{{ $pc->id }}"
                                onclick="toggleActive(this)"
                        />
                        {{ $pc->name }}
                    </div>
                    <span class="level-span"><strong>Level: </strong>{{ $pc->level }}</span>
                </div>
            </label>
        @endforeach
    </div>
    <input type="submit" class="btn btn-primary btn-block" value="Use this Party" />
</form>
<div class="container" id="spell_search_container">
    <div class="row justify-content-md-center">
        <div class="col-8">
            <div class="input-group mb-3">
                <input
                    id="spell_search_query"
                    type="text"
                    class="form-control"
                    placeholder="Spell Search..."
                    aria-label="Spell Search..."
                    aria-describedby="spell_search_btn"
                    @isset($query) value="{{ $query }}" @endisset
                    onkeypress="javascript: if(event.keyCode == 13) searchSpells(jQuery('#spell_search_query').val());"
                >
                <div class="input-group-append">
                    <button type="button" id="spell_search_btn" class="btn btn-outline-success" onclick="searchSpells(jQuery('#spell_search_query').val())">
                        <span class="fa fa-search"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @isset($spells)
            <div class="list-group" style="max-height: 500px; overflow: auto;">
            @foreach($spells as $spell)
                <a href="#" onclick="selectSpell({{ $spell->idx }})" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        {{ $spell->name }}
                        <span class="spell-level">{{ $spell->level }}</span>
                    </div>
                </a>
            @endforeach
            </div>
            @endisset
        </div>
    </div>
</div>
<div id="spell_display_container" style="display: none;"></div>
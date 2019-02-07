<div class="container">
    <div class="row align-middle">
        <div class="col-8">
            <h4>{{$spell->name}}</h4>
            <strong>Range: </strong>{{ $spell->range }}
            <br/>
            <strong>Casting Time: </strong>{{ $spell->casting_time }}
        </div>
        <div class="col-4">
            {{ $spell->level }}
            @if($spell->ritual)
                <span class="text-primary">RITUAL</span>
            @endif
            @if($spell->concentration)
                <span class="text-danger">CONCENTRATION</span>
            @endif
        </div>
    </div>
    {!! $spell->description !!}
    {!! $spell->higher_level !!}
    <strong>Duration: </strong>{{ $spell->duration }} <br/>
    <strong>Classes: </strong>{{ $spell->spellClass }} <br/>
    <strong>Components: </strong>{{ $spell->components }} <br/>
    <strong>Materials: </strong>{{ $spell->material }} <br/>
    <strong>School: </strong>{{ $spell->school }} <br/>
    <strong>Page: </strong>{{ $spell->page }} <br/>
    <hr>
    <button type="button" class="btn btn-primary btn-block" onclick="jQuery('#spell_search_container').show();jQuery('#spell_display_container').hide();">Back to Spell Search</button>
</div>
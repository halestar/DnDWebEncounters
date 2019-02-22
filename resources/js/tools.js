function makeDeleteForm(url)
{
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    var delInput = document.createElement('input');
    delInput.type = 'hidden';
    delInput.name = '_method';
    delInput.value = 'DELETE';
    form.appendChild(delInput);
    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = jQuery('meta[name="csrf-token"]').attr('content');
    form.appendChild(csrf);
    document.body.appendChild(form);
    return form;
}

function debounce(fn, delay = 300) {
    var timeoutID = null;

    return function () {
        clearTimeout(timeoutID);

        var args = arguments;
        var that = this;

        timeoutID = setTimeout(function () {
            fn.apply(that, args);
        }, delay);
    }
}

function showDiceRoller()
{
    jQuery('#modal_dialog_title').text('Dice Roller');
    axios.get('/dice/dialog')
        .then(function (response)
        {
            jQuery('#modal_dialog_body').html(response.data);
            jQuery('#global_modal_dialog').modal();
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

function rollDice()
{
    let num_dice = jQuery('input[name="dice_num"]:checked').val();
    let dice_type = jQuery('input[name="dice_type"]:checked').val();
    let other_dice_num = jQuery('#other_dice_num').val();
    let mod = jQuery('#dice_mod').val();
    let data =
        {
            'num_dice': num_dice,
            'dice_type': dice_type,
            'other_dice_num': other_dice_num,
            'mod': mod
        };
    axios.post('/dice/roll', data)
        .then(function (response)
        {
            jQuery('#global_modal_dialog').modal('hide');
            let msg = "";
            if(num_dice == 11)
                msg = "Rolled " + other_dice_num + 'd' + dice_type;
            else
                msg = "Rolled " + num_dice + 'd' + dice_type;
            if(mod > 0)
                msg += '+' + mod;
            else if(mod < 0)
                msg += mod;
            msg += ': ' + response.data;
            alert(msg);
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

function quickRoll(roll)
{
    let data = { 'roll': roll };
    axios.post('/dice/quick', data)
        .then(function (response)
        {
            alert("Rolled " + roll + ': ' + response.data);
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

function showSpellSearch()
{
    jQuery('#modal_dialog_title').text('Spell Search');
    axios.get('/spells/dialog')
        .then(function (response)
        {
            jQuery('#modal_dialog_body').html(response.data);
            jQuery('#global_modal_dialog').modal();
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

function searchSpells(query)
{
    let data = { 'query': query };
    axios.post('/spells/search', data)
        .then(function (response)
        {
            jQuery('#modal_dialog_body').html(response.data);
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

function selectSpell(idx)
{
    let url = "/spells/show/" + idx;
    axios.get(url)
        .then(function (response)
        {
            jQuery('#spell_display_container').html(response.data);
            jQuery('#spell_display_container').show();
            jQuery('#spell_search_container').hide();
        })
        .catch(function (error)
        {
            console.log(error);
        });
}

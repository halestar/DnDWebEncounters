let EncounterManager = (function()
{
    function EncounterManager(container_id, data_url)
    {
        this.container = jQuery('#' + container_id);
        this.dataUrl = data_url;
        this.encounters = [];
        this.loaded = false;
        this.selection = null;

        let inputContainer = jQuery('<div class="input-group mb-3"><div class="input-group-prepend">' +
            '<span class="input-group-text" id="encounterSearchLabel">Filter Encounters: </span></div>');
        this.filterInput = jQuery('<input type="text" class="form-control" placeholder="Encounter" ' +
            'aria-label="Encounter" aria-describedby="encounterSearchLabel" name="encounterSearch" id="encounterSearch">');
        this.filterInput.keyup(debounce($.proxy(this.filterEncounters, this)));
        inputContainer.append(this.filterInput);
        this.container.append(inputContainer);
        this.encounterContainer = jQuery('<ul class="list-group"></ul>');
        this.container.append(this.encounterContainer);
        var self = this;
        axios.get(this.dataUrl)
            .then(function (response)
            {
                self.encounters = response.data;
                self.buildEncounters();
            })
            .catch(function (error)
            {
                console.log(error);
            })
    }

    EncounterManager.prototype.buildEncounters = function()
    {
        this.encounterContainer.empty();
        for(let i = 0; i < this.encounters.length; i++)
        {
            let il_container = jQuery('<li class="list-group-item" encounter_id="' + this.encounters[i].id + '"></li>');
            let div_container = jQuery('<div class="d-flex justify-content-between align-items-center"></div>')
            let formCheck = jQuery('<div class="form-check"></div>')
            let selectInput = jQuery('<input class="form-check-input" type="checkbox" name="encounters[]" value="' + this.encounters[i].id + '" id="encounters_' + this.encounters[i].id + '">');
            formCheck.append(selectInput);
            formCheck.append('<label class="form-check-label" for="encounters_' + this.encounters[i].id + '">' + this.encounters[i].name + '</label>');
            selectInput.click(function()
            {
                if(jQuery(this).is(':checked'))
                    jQuery('li[encounter_id=' + jQuery(this).val() + ']').addClass('active');
                else
                    jQuery('li[encounter_id=' + jQuery(this).val() + ']').removeClass('active');
            });

            div_container.append(formCheck);
            div_container.append('<span class="tier_span"><strong>CR: </strong>' + this.encounters[i].cr + '</span>');

            il_container.append(div_container);
            this.encounterContainer.append(il_container);
        }
        this.loaded = true;
        this.selectEncounters();
    }

    EncounterManager.prototype.selectEncounters = function()
    {
        if(this.loaded && this.selection != null)
        {
            this.encounterContainer.find('li').removeClass('active');
            this.encounterContainer.find('li input[type=checkbox]').removeAttr('checked');
            for(let i = 0; i < this.selection.length; i++)
            {
                this.encounterContainer.find('li[encounter_id=' + this.selection[i] + ']').addClass('active');
                this.encounterContainer.find('li[encounter_id=' + this.selection[i] + '] input[type=checkbox]').attr('checked', 'checked');
            }
        }
    }

    EncounterManager.prototype.filterEncounters = function()
    {
        jQuery.expr[':'].contains = function(a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
        };

        let query = this.filterInput.val();
        let lis = this.encounterContainer.find('li');
        lis.hide();
        this.encounterContainer.find('li:contains("' + query + '")').show();
    }

    EncounterManager.prototype.loadSelection = function(encounter_ids)
    {
        this.selection = encounter_ids;
        this.selectEncounters();
    }

    return EncounterManager;
})();

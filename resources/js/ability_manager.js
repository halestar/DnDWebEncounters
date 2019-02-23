let AbilityManager = (function()
{
    function AbilityManager(container_id, class_prefix, edit_only = false)
    {
        this.container = jQuery('#' + container_id);
        this.class_prefix = class_prefix;
        this.abilities = [];
        this.edit_only = edit_only;
    }

    AbilityManager.prototype.addAbility = function()
    {
        let index = this.abilities.length;
        let ability_container = jQuery('<div class="' + this.class_prefix + '_container border border-info rounded p-2 m-2" id="' + this.class_prefix + '_' + index + '"></div>');
        ability_container.append('<input type="hidden" name="' + this.class_prefix + '_id_' + this.index + '_input" ' +
            'id="' + this.class_prefix + '_id_' + this.index + '_input" class="ability_id" />');
        let ability_name_container = jQuery('<div class="form-group"></div>');
        ability_name_container.append(jQuery('<label for="'+ this.class_prefix + '_name_' + this.index + '_input">Name</label>'));
        ability_name_container.append(jQuery('<input type="text" name="'+ this.class_prefix + '_name_' + this.index + '_input" ' +
            'id="'+ this.class_prefix + '_name_' + this.index + '_input" class="form-control ability_name" />'));
        ability_container.append(ability_name_container);

        let ability_description_container = jQuery('<div class="form-group"></div>');
        ability_description_container.append(jQuery('<label for="'+ this.class_prefix + '_desc_' + this.index + '_input">Description</label>'));
        ability_description_container.append(jQuery('<textarea name="'+ this.class_prefix + '_desc_' + this.index + '_input" ' +
            'id="'+ this.class_prefix + '_desc_' + this.index + '_input" class="form-control ability_description"></textarea>'));
        ability_container.append(ability_description_container);

        let removeBtn = jQuery('<button type="button" class="btn btn-danger btn-block">Remove This Ability</button>');
        removeBtn.click($.proxy(this.removeAbility, this, index));
        ability_container.append(removeBtn);
        this.container.append(ability_container);
        this.abilities.push(ability_container);

    };

    AbilityManager.prototype.removeAbility = function(index)
    {
        let container = this.abilities.splice(index, 1);
        jQuery(container).remove();
        jQuery('#' + this.class_prefix + '_' + index).remove();
    };

    AbilityManager.prototype.getAbilities = function()
    {
        let ab = [];
        for(let i = 0; i< this.abilities.length; i++)
        {
            ab.push(
                {
                    name: this.abilities[i].find('.ability_name').val(),
                    description: this.abilities[i].find('.ability_description').val(),
                    id: this.abilities[i].find('.ability_id').val()
                }
            );
        }
        return ab;
    };

    AbilityManager.prototype.loadAbilities = function(abilities)
    {
        let base_index = this.abilities.length;
        for(var i = 0; i < abilities.length; i++)
        {
            let index = base_index + i;


            let ability_container = "";

            if (!this.edit_only) {
                ability_container = jQuery('<div class="' + this.class_prefix + '_container border border-info rounded p-2 m-2" id="' + this.class_prefix + '_' + index + '"></div>');
                ability_container.append('<input type="hidden" name="' + this.class_prefix + '_id_' + this.index + '_input" ' +
                    'id="' + this.class_prefix + '_id_' + this.index + '_input" value="' + abilities[i].id + '" class="ability_id" />');
                let ability_name_container = jQuery('<div class="form-group"></div>');
                ability_name_container.append(jQuery('<label for="' + this.class_prefix + '_name_' + this.index + '_input">Name</label>'));
                ability_name_container.append(jQuery('<input type="text" name="' + this.class_prefix + '_name_' + this.index + '_input" ' +
                    'id="' + this.class_prefix + '_name_' + this.index + '_input" class="form-control ability_name" value="' + abilities[i].name + '"/>'));
                ability_container.append(ability_name_container);
                let ability_description_container = jQuery('<div class="form-group"></div>');
                ability_description_container.append(jQuery('<label for="' + this.class_prefix + '_desc_' + this.index + '_input">Description</label>'));
                ability_description_container.append(jQuery('<textarea name="' + this.class_prefix + '_desc_' + this.index + '_input" ' +
                    'id="' + this.class_prefix + '_desc_' + this.index + '_input" class="form-control ability_description">' + abilities[i].description + '</textarea>'));
                ability_container.append(ability_description_container);
                let removeBtn = jQuery('<button type="button" class="btn btn-danger btn-block">Remove This Ability</button>');
                removeBtn.click($.proxy(this.removeAbility, this, index));
                ability_container.append(removeBtn);
            } else {
                ability_container = jQuery('<div class="alert alert-info"></div>');
                ability_container.append(jQuery('<h4 class="alert-heading border-bottom">' + abilities[i].name + '</h4>'));
                ability_container.append(jQuery('<p>' + abilities[i].description + '</p>'));
            }

            this.container.append(ability_container);
            this.abilities.push(ability_container);
        }
    };

    return AbilityManager;
})();

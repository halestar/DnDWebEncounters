let MonsterManager = (function()
{
    function MonsterManager(container_id, text_input_id, data_url, cr_container)
    {
        this.container = jQuery('#' + container_id);
        this.textInput = jQuery('#' + text_input_id);
        this.dataUrl = data_url;
        this.cr_container = jQuery('#' + cr_container);
        this.monsters = [];
        let self = this;

        this.textInput.typeahead(
            {
                minLength: 3,
                highlight: true,
            },
            {
                name: 'monsters',
                async: true,
                limit: 10,
                display: function(monster_data)
                {
                    return monster_data.name;
                },
                source:  function (query, syncResults, asyncResults)
                {
                    return jQuery.get(self.dataUrl, { query: query }, function (monster_data)
                    {
                        return asyncResults(monster_data);
                    });
                }
            });
        this.textInput.bind('typeahead:select', function (ev, suggestion)
            {
                self.addMonster(suggestion);
            });


    }

    MonsterManager.prototype.buildMonsterList = function()
    {
        this.monsters.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));
        let ul_container = jQuery('<ul class="list-group"></ul>');
        let cr = 0;
        for(let i = 0; i < this.monsters.length; i++)
        {
            let il_container = jQuery('<li class="list-group-item d-flex justify-content-between align-items-center" idx="' + i + '"></li>');
            il_container.append('<h5>' + this.monsters[i].name) + "</h5>";
            let control_span = jQuery('<span class="monster_control_span"></span>');
            let copy_button = jQuery('<button type="button" class="btn btn-primary btn-sm mr-2"><span class="fa fa-copy"></span></button>');
            copy_button.click($.proxy(this.copyMonster, this, i));
            control_span.append(copy_button);
            let delete_button = jQuery('<button type="button" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>');
            delete_button.click($.proxy(this.removeMonster, this, i));
            control_span.append(delete_button);

            il_container.append(control_span);
            ul_container.append(il_container);

            cr += eval(this.monsters[i].cr);
        }
        this.container.empty();
        this.container.append(ul_container);
        this.cr_container.html(Math.floor(cr).toString());
    }

    MonsterManager.prototype.addMonster = function(monster)
    {
        this.monsters.push(monster);
        this.buildMonsterList();
        this.textInput.typeahead('val', '');
        this.textInput.typeahead('close');

    }

    MonsterManager.prototype.removeMonster = function(idx)
    {
        this.monsters.splice(idx, 1);
        this.buildMonsterList();
    }

    MonsterManager.prototype.copyMonster = function(idx)
    {
        this.monsters.push(JSON.parse(JSON.stringify(this.monsters[idx])));
        this.buildMonsterList();
    }

    MonsterManager.prototype.getMonsters = function()
    {
        return this.monsters;
    }

    MonsterManager.prototype.loadMonsters = function(monsters)
    {
        this.monsters = monsters;
        this.buildMonsterList();
    }

    return MonsterManager;
})();

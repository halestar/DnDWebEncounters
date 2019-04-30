let PlayerManager = (function () {
    function PlayerManager(container_id, data_url) {
        this.container = jQuery('#' + container_id);
        this.dataUrl = data_url;
        this.players = [];
        this.loaded = false;
        this.selection = null;

        let inputContainer = jQuery('<div class="input-group mb-3"><div class="input-group-prepend">' +
            '<span class="input-group-text" id="pcSearchLabel">Filter Players: </span></div>');
        this.filterInput = jQuery('<input type="search" class="form-control" placeholder="PC" ' +
            'aria-label="PC" aria-describedby="pcSearchLabel" name="pcSearch" id="pcSearch">');
        this.filterInput.keyup(debounce($.proxy(this.filterPcs, this)));
        inputContainer.append(this.filterInput);
        this.container.append(inputContainer);
        this.pcContainer = jQuery('<div class="list-group"></div>');
        this.container.append(this.pcContainer);
        var self = this;
        axios.get(this.dataUrl)
            .then(function (response) {
                self.players = response.data;
                self.buildPCs();
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    PlayerManager.prototype.buildPCs = function () {
        this.pcContainer.empty();
        for (let i = 0; i < this.players.length; i++) {
            let il_container = jQuery('<label class="list-group-item" pc_id="' + this.players[i].id + '" for="pcs_' + this.players[i].id + '"></label>');
            let div_container = jQuery('<div class="d-flex justify-content-between align-items-center"></div>');
            let formCheck = jQuery('<div class="form-check"></div>');
            let selectInput = jQuery('<input class="form-check-input" type="checkbox" name="pcs[]" value="' + this.players[i].id + '" id="pcs_' + this.players[i].id + '">');
            formCheck.append(selectInput);
            formCheck.append('<span>' + this.players[i].name + ' (' + this.players[i].player.name + ')</span>');
            selectInput.click(function () {
                if (jQuery(this).is(':checked'))
                    jQuery('label[pc_id=' + jQuery(this).val() + ']').addClass('active');
                else
                    jQuery('label[pc_id=' + jQuery(this).val() + ']').removeClass('active');
            });

            div_container.append(formCheck);
            div_container.append('<span class="tier_span"><strong>Lv: </strong>' + this.players[i].level + '</span>');

            il_container.append(div_container);
            this.pcContainer.append(il_container);
        }
        this.loaded = true;
        this.selectPcs();
    };

    PlayerManager.prototype.selectPcs = function () {
        if (this.loaded && this.selection != null) {
            this.pcContainer.find('label').removeClass('active');
            this.pcContainer.find('label input[type=checkbox]').removeAttr('checked');
            for (let i = 0; i < this.selection.length; i++) {
                this.pcContainer.find('label[pc_id=' + this.selection[i] + ']').addClass('active');
                this.pcContainer.find('label[pc_id=' + this.selection[i] + '] input[type=checkbox]').attr('checked', 'checked');
            }
        }
    };

    PlayerManager.prototype.filterPcs = function () {
        jQuery.expr[':'].contains = function (a, i, m) {
            return jQuery(a).text().toUpperCase()
                .indexOf(m[3].toUpperCase()) >= 0;
        };

        let query = this.filterInput.val();
        let labels = this.pcContainer.find('label');
        labels.hide();
        this.pcContainer.find('label:contains("' + query + '")').show();
    };

    PlayerManager.prototype.loadSelection = function (pc_ids) {
        this.selection = pc_ids;
        this.selectPcs();
    };

    return PlayerManager;
})();

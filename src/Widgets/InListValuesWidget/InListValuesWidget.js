(function () {
    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    var templates = x/*widget.toJson('templates')*/;
    var sortBy = "x/* widget.field('sortBy') */";
    window.x/*widget.field('widgetName')*/ = {
        el: $('#' + "x/*widget.field('id')*/"),
        elId: '#' + "x/*widget.field('id')*/",
        items: x/*widget.toJson('allValues')*/,
        init: function () {
            this.handleSaveButton();
            this.handleDeleteButton();
            this.renderItems();
        },
        handleSaveButton: function () {
            var self = this;
            $('body').on('click', this.elId + ' .save-button', function () {
                var form = $(self.elId + ' input, ' + self.elId + ' select');
                var newItem = getFormData(form);
                self.items.push(newItem);
                self.renderItems();
                $(self.elId+' .modal').modal('hide');
                form.val(null);
            });
        },
        handleDeleteButton: function () {
            var self = this;
            $('body').on('click', this.elId + ' .delete-button', function () {
                var position = $(this).parent().attr('data-position');
                self.items.splice(position, 1);
                self.renderItems();
            });
        },
        getItems: function() {
            return this.items;
        },
        addItem: function (item) {
            this.items.push(item);
            this.renderItems();
        },
        renderItems: function () {
            var itemsContainer = this.el.find('.list-items');
            var resultTemplate = '';
            this.items = _.sortBy(this.items, sortBy);
            for (var i in this.items) {
                var deleteTemplate = _.template(templates.deleteButton);
                var itemTemplate = _.template(templates.listItem);
                var item = this.items[i];
                resultTemplate += itemTemplate({
                    'item': this.items[i],
                    'position': i,
                    'delTemplate': deleteTemplate({
                        widget: x/*widget.toJson('widget')*/
                    })
                });
            }
            itemsContainer.html(resultTemplate);
        }
    };
})();

window.x/*widget.field('widgetName')*/.init();
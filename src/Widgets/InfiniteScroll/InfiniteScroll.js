(function () {

    var templates = x/*widget.toJson('templates')*/;
    templates.item = x/* widget.toJson('bufferContent') */;

    window.x/*widget.field('widgetName')*/ = {
        elId: "#x/*widget.field('id')*/",
        items: x/*widget.toJson('allData')*/,
        synchronizationUrl: x/*widget.toJson('synchronizationUrl')*/,
        viewCount: x/*widget.field('viewCount')*/,
        currentViewCount: x/*widget.field('viewCount')*/,
        init: function () {
            this.render();
            this.handleReadmore();
        },
        handleReadmore: function () {
            var self = this;
            $('body').on('click', this.elId + ' .readmore', function (e) {
                e.preventDefault();
                self.currentViewCount += self.viewCount;
                self.render();
            });
        },
        renderItems: function (itemsData) {
            var items = '';
            var itemTemplate = _.template(templates.item);
            for (var i in itemsData) {
                items += itemTemplate(itemsData[i])
                if (i >= this.currentViewCount - 1) {
                    break;
                }
            }
            if (this.items.length >= this.currentViewCount) {
                items += templates.readmore;
            }
            $(this.elId).html(items);
        },
        render: function() {
            var self = this;
            if (!this.items) {
                $.ajax({
                    'url': this.synchronizationUrl,
                    'method': 'POST',
                    'success': this.renderItems
                });
            } else {
                this.renderItems(this.items);
            }
        }
    };

})();

window.x/*widget.field('widgetName')*/.init();
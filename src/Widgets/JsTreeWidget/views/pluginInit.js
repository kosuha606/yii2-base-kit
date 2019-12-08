(function() {
    var dataUrl = '__dataUrl__';
    var data = '__dataJson__';
    var dataJson = data ? JSON.parse(data) : false;

    /**
     * Этот объект управляет деревом,
     * чтобы управлять деревом извне виджета
     * передайте любое имя для этого менеджера
     * и вызывайте его по имени по умолчанию объект
     * называется TreeManager. Если на странице больше
     * одного виджета JsTreeWidget нужно передать
     * каждому уникальное имя для TreeManager
     *
     * @type {{}}
     */
    window.__widgetName__ = {
        jstreeId: '__id__',
        data: [],
        init: function() {
            if (dataJson) {
                this.buildStatic(dataJson);
            } else if (dataUrl) {
                this.build(__initialDataToServer__);
            }
        },
        /**
         * Построение дерево по статическим данным JSON
         */
        buildStatic: function(treeData) {
            var self = this;
            self.data = treeData;
            $('__id__').jstree('destroy');
            $('__id__').text('__labels.loading__');
            console.log('__id__');
            $('__id__').jstree({
                "core" : {
                    "multiple": __options.multiple__,
                    'data' : treeData
                },
                "search": {
                    "case_insensitive": true,
                    "show_only_matches" : true
                },
                "plugins": __plugins__
            }).bind("select_node.jstree", function(evt, data) {
                __jsOnSelectExpression__
            });
            self.handleSearch();
        },
        /**
         * Построить менеджер
         */
        build: function(dataToServer) {
            var self = this;
            $('__id__').jstree('destroy');
            $('__id__').text('__labels.loading__');
            $.ajax({
                url: '__dataUrl__',
                method: 'GET',
                data: dataToServer,
                success: function(treeData) {
                    self.buildStatic(treeData);
                },
                fail: function() {
                    console.error('JsTreeWidget ошибка не удалось получить данные');
                }
            });
        },
        /**
         * Обработка инпута поиска
         */
        handleSearch: function() {
            $('__searchId__').unbind('keyup');
            var to = false;
            $('__searchId__').on('keyup', function () {
                if(to) { clearTimeout(to); }
                to = setTimeout(function () {
                    var v = $('__searchId__').val();
                    $('__id__').jstree(true).search(v);
                }, 250);
            });
        },
        /**
         * Вернуть выбранный пользователем узел
         */
        oneSelectedNode: function () {
            var result = $('__id__').jstree('get_selected');
            if (result.length) {
                return result.pop();
            }

            return false;
        },
        /**
         * Вернуть объект выбранного узла
         */
        oneSelectedObject: function() {
            var id = this.oneSelectedNode();

            return this.data.find(function(x) { return x.id==id});
        },
        /**
         * Вернуть все выбранные пользователем узелы
         */
        allSelectedNode: function () {
            return $('__id__').jstree('get_selected');
        }
    };

    /**
     * Первое построение дерева
     */
    window.__widgetName__.init();

})();
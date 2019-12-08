$(document).ready(function(){

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

	$('.todolist-widget').each(function (e, o) {
        var items = [];
        var index;
        var widgetId = '#'+$(o).attr('id');
        var widgetIdNoSharp = $(o).attr('id');

        var itemsJson = JSON.parse($(widgetId).attr('data-items'));
        if (itemsJson) {
            items = itemsJson;
            loadList(items);
        }

        $('body').on('click',widgetId+' .todosubmit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var newItem = {};
            var form = $(widgetId+' input, '+widgetId+' select');
            var formData = getFormData(form);
            items.push(formData);
            loadList(items);
            $(this).closest('.modal').modal('toggle');
        });

        // Обрабобтчик удаления
        $(widgetId+' .todolist-items').delegate("span", "click", function(event){
            event.stopPropagation();
            index = $(widgetId+' span.remove-item').index(this);
            items.splice(index, 1);
            loadList(items);
        });

        function loadList(items){
            $(widgetId+' .todolist-items tr').remove();
            var jsonStrItem = JSON.stringify(items);
            var nameOfResultField = $('[name="result-field-'+widgetIdNoSharp+'"]').val();
            $('[name="'+nameOfResultField+'"]').val(jsonStrItem);
            var canAddDelete = $(widgetId + ' [data-toggle=modal]').length;
            if(items.length > 0) {
                for(var i = 0; i < items.length; i++) {
                    if (canAddDelete) {
                        $(widgetId+' .todolist-items').append('<tr><td data-toggle="modal" data-target="#editModal">' + items[i].text + '<span class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></span></td></tr>');
                    } else {
                        $(widgetId+' .todolist-items').append('<tr><td data-toggle="modal" data-target="#editModal">' + items[i].text + '</td></tr>');
                    }
                }
            }
        }
    });
});

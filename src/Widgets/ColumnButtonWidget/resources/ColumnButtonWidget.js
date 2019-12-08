$(function () {

    function getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};
        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    $('.column-button-widget').each(function (e, o) {
        var widgetId = '#' + $(o).attr('id');
        $(widgetId + ' .btn-success').on('click', function (e) {
            var jsCallback = $(o).attr('data-js-callback');
            e.preventDefault();
            var form = $(widgetId + ' form');
            var formData = getFormData(form);
            var colButton = $(o).find('button[data-toggle="modal"]');
            var btnText = colButton.text();
            var labelPart = btnText.split(' - ');
            if (formData.value) {
                colButton.addClass('btn-success').removeClass('btn-default');
                colButton.text(labelPart[0] + ' - ' + formData.code);
            } else {
                colButton.addClass('btn-default').removeClass('btn-success');
                colButton.text(labelPart[0]);
            }
            var split = jsCallback.split('.');
            if (split.length > 1) {
                jsCallback = eval(split[0]);
                jsCallback[split[1]](labelPart[0], formData.value);
            } else {
                jsCallback = window[split[0]];
                jsCallback(labelPart[0], formData.value);
            }
            $(o).find('.modal').modal('toggle');
        })
    })
});
(function($) {
    $('body').on('click', '.lsv-value', function (e) {
        e.preventDefault();
        var container = $(this).closest('.lsv-container');
        container.find('.modal').modal('show');
    });

    $('body').on('click', '.lsv-save', function (e) {
        e.preventDefault();
        var container = $(this).closest('.lsv-container');
        var labelSyncPoint = container.attr('data-label-sync-point');
        var saveTo = container.attr('data-save-to');
        var saveToRelations = JSON.parse(container.attr('data-save-to-relations'));
        var data = getFormDataFromArray(container.find('.modal :input').serializeArray());
        console.log(data);
        var value = JSON.stringify(data);
        container.find('.lsv-reset').addClass('hide');
        $.ajax({
            method: 'POST',
            url: labelSyncPoint,
            data: {value: value},
            success: function (data) {
                container.find('.lsv-reset').removeClass('hide');
                container.find('.lsv-value').html(data.label);
                for (var i in saveToRelations) {
                    if (data[i]) {
                        container.find('.lsv-save-to-'+i).val(data[i]).trigger('change');
                    }
                }
                container.find('.lsv-save-to').val(data.value);
                setTimeout(function () {
                    container.find('.lsv-save-to').trigger('change');
                }, 100);
            }
        });
        container.find('.modal').modal('hide');
    });

    $('body').on('click', '.lsv-reset', function(e) {
        e.preventDefault();
        var container = $(this).closest('.lsv-container');
        container.find('.lsv-reset').addClass('hide');
        container.find('.lsv-value').html('Добавить');
        var saveToRelations = JSON.parse(container.attr('data-save-to-relations'));
        for (var i in saveToRelations) {
            container.find('.lsv-save-to-'+i).val(0).trigger('change');
        }
        container.find('.lsv-save-to').val(0);
        setTimeout(function () {
            container.find('.lsv-save-to').trigger('change');
        }, 100);
    })
})(jQuery);
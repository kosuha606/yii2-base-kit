
$(document).ready(function(){
    $('.inlist_modal_container').on('click', function() {
        var widgetId = $(this).attr('data-widget-id');
        $('#'+widgetId).modal('show');
    });
});

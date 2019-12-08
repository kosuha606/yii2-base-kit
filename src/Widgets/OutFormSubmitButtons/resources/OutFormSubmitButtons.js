
function OutFormSubmitButton(formId, actionField, buttonOptions) {
    $('#'+buttonOptions.id).on('click', function (e) {
        e.preventDefault();
        var form = $('#'+formId);
        var field = $('[name='+actionField+']');
        field.val(buttonOptions.name);
        form.submit();
    })
}
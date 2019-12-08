$(document).ready(function() {
    $('__id__').DataTable( {
        "ajax": '/api/v1/json/petService/all?plain=1',
        "language": __i18n__
    } );
} );
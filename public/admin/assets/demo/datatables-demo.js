// Call the dataTables jQuery plugin
$(document).ready(function() {
    $("#dataTable").DataTable({
        oLanguage: {
            sSearch: "Cauta utilizatori:"
        },
        language: {
            info: "Se afiseaza pagina _PAGE_ din _PAGES_",
            lengthMenu: "Afiseaza _MENU_ randuri / pagina",
            paginate: {
                next: "Urm",
                first: "Prima",
                last: "Ultima",
                previous: "Prec"
            }
        }
    });
});

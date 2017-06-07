//$("#js-btn-users-search").on('click', function() {
//    var btn = $(this);
//    var param = $("#js-param-search").val();
//
//    btn.button('loading');
//
//    $.get('/admin/usuarios/busca/' + param, function(data) {
//        $('.portlet-body').html(data);
//    }).always(function() {
//        btn.button('reset');
//    });
//});
//
//$("#js-btn-users-search-reset").on('click', function() {
//    var btn = $("#js-btn-users-search");
//
//    $.get('/admin/usuarios/busca/limpar', function(data) {
//        $('.portlet-body').html(data);
//    }).always(function() {
//        btn.button('reset');
//    });
//});

$(document).ready(function() {
    $('#datatable').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
    });
});
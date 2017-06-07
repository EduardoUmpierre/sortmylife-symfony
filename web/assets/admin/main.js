$(function() {
    if ($("#sortable").length > 0) {
        var sort = $("#sortable").sortable({
            forceHelperSize: true,
            update: function(e, ui) {
                var module = $(e.target).data('module');
                var serial = JSON.stringify(sort.sortable("toArray"));
                var moduleId = $(e.target).data('moduleId') ? $(e.target).data('moduleId') : "";

                $.post("/admin/" + module + "/ordenacao", {data: serial, module: moduleId}, function(data) {
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "positionClass": "toast-bottom-right",
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    if(data == 1)
                        toastr.success('Ordenação atualizada com sucesso!');
                    else
                        toastr.error('Não foi possível executar a ordenação.');
                });
            },
        });
    }
});

$(document).on("change", ".unique-checkbox", function(e) {
    console.log(this);

    var checkboxes = $("#unique-checkbox input[type='checkbox']");

    if (this.checked) {
        //checkboxes.attr("checked", false);
        //checkboxes.siblings("span").show();

        //$(this).attr("checked", true);
    }
});
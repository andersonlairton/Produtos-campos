$(document).ready(function () {
    $("#salvarCategoria").click(function (e) {

        $.ajax({
            type: "POST",
            url: "../../Source/configajax.php",
            data: {
                action: 'cadastro',
                component: 'categoriasController',
                descricao: $("#descricao").val(),
                status: $("#statusCategoria").is(":checked")
            },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                alert(data.resposta_status.msg);
                window.location.assign("../Categorias/list.php");
            }, error: function () {
                console.log('error 29')
            }
        });
    });
});
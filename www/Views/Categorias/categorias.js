var action = 'cadastro';
var id = "";
$(document).ready(function () {
    if (window.location.search != '') {
        id = window.location.search.replace(/[^0-9]/g, '');
        action = 'atualizar';

        $.ajax({
            type: "POST",
            url: "../../Source/configajax.php",
            data: {
                action: 'listagem',
                component: 'categoriasController',
                id: id
            },
            dataType: "JSON",
            success: function (data) {
                $("#salvarCategoria").html('Atualizar');
                $("#salvarCategoria").attr('id', 'atualizar');

                $("#descricao").val(data.resposta_dados.dados[0].descricao);

                if (data.resposta_dados.dados[0].status == 'Ativo') {
                    $("#statusCategoria").prop('checked', true)
                }

            }, error: function () {
                console.log('error 28')
            }
        });
    }


    $("#salvarCategoria").click(function (e) {
        enviodados();
    });

    $("#atualizar").click(function (e) {
        enviodados();
    });

});

function enviodados() {
    $.ajax({
        type: "POST",
        url: "../../Source/configajax.php",
        data: {
            action: action,
            component: 'categoriasController',
            descricao: $("#descricao").val(),
            status: $("#statusCategoria").is(":checked"),
            id : id
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            alert(data.resposta_status.msg);
            window.location.assign("../Categorias/list.php");
        }, error: function () {
            console.log('error 60')
        }
    });

}
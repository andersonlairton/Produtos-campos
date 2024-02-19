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
                component: 'produtosController',
                id: id
            },
            dataType: "JSON",
            success: function (data) {
                $("#salvarProduto").html('Atualizar');
                $("#salvarProduto").attr('id', 'atualizar');

                $("#descricao").val(data.resposta_dados.dados[0].descricao);

                listarCategorias(data.resposta_dados.dados[0].categoria)

            }, error: function () {
                console.log('error 28')
            }
        });
    }else{
        listarCategorias();
    }

    $("#salvarProduto").click(function (e) {
        enviodados();
    });

    $("#atualizar").click(function (e) {
        enviodados();
    });
});

function listarCategorias(id = "") {

    $.ajax({
        type: "GET",
        url: "../../Source/configajax.php",
        data: {
            action: 'listagem',
            component: 'categoriasController',
            inativas: $("#statusCategoria").is(":checked")
        },
        dataType: "JSON",
        success: function (data) {

            console.log(data)
            if (data.resposta_dados.qtd != 0) {
                options = "<option value=0 selected>Selecione Categoria...</option>";

                $.each(data.resposta_dados.dados, function (i, v) {
                    selected = ''
                    if (id == v.id) {
                        selected = 'selected'
                    }

                    options += `
                    <option value="${v.id}" ${selected}>${v.descricao}</option>`
                });

                $("#categorias").html(options);

            }

        }, error: function () {
            console.log('error 109')
        }
    });
}

function enviodados() {
    $.ajax({
        type: "POST",
        url: "../../Source/configajax.php",
        data: {
            action: action,
            component: 'produtosController',
            descricao: $("#descricao").val(),
            categoria: $("#categorias").val(),
            id: id
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);
            alert(data.resposta_status.msg);
            window.location.assign("../Produtos/list.php");
        }, error: function () {
            console.log('error 60')
        }
    });

}
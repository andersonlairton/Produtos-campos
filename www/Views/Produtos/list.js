$(document).ready(function () {
    console.log('list jquery')

    listagem()

    $("#novaProdutos").click(function (e) {
        window.location.assign("../Produtos/form.php");
    });

    $("#statusProdutos").change(function (e) {
        listagem();

    });
});

function deleteProdutos(id) {
    var confirmado = confirm('Deseja deletar categoria?');
    if (confirmado) {
        $.ajax({
            type: "PUT",
            url: "../../Source/configajax.php",
            data: {
                action: 'inativar',
                component: 'produtosController',
                categoria: id
            },
            dataType: "JSON",
            success: function (response) {
                alert("Produtos excluida com sucesso")
                window.location.assign("../Produtos/list.php");
            }, error: function () {
                console.log('error 71')
            }
        });
    }
}

function listagem() {
    $.ajax({
        type: "GET",
        url: "../../Source/configajax.php",
        data: {
            action: 'listagem',
            component: 'produtosController',
            // inativas: $("#statusProdutos").is(":checked")
        },
        dataType: "JSON",
        success: function (data) {
            console.log(data);

            if (data.resposta_dados.qtd != 0) {
                table = "";
                $.each(data.resposta_dados.dados, function (i, v) {
                    console.log(v)
                    table += `
                    <tr>
                        <th scope="row">${i}</th>
                        <td>${v.descricao}</td>
                        <td>${v.categoria}</td>
                        <td>
                            <button type="button" class="btn btn-info" onClick="editarProdutos(${v.id})">Editar</button>    
                        </td>
                    </tr>`
                });

                $("#table_list").html(table);

            }

        }, error: function () {
            console.log('error 109')
        }
    });
}

function editarProdutos(id) {
    window.location.assign(`../Produtos/form.php?prod=${id}`);
}

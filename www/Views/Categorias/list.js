$(document).ready(function () {
    console.log('list jquery')

    listagem()

    $("#novaCategoria").click(function (e) {
        window.location.assign("../Categorias/form.php");
    });

    $("#statusCategoria").change(function (e) {
        listagem();

    });
});

function deleteCategoria(id) {
    var confirmado = confirm('Deseja deletar categoria?');
    if (confirmado) {
        $.ajax({
            type: "POST",
            url: "../../Source/configajax.php",
            data: {
                action: 'inativar',
                component: 'categoriasController',
                categoria: id
            },
            dataType: "JSON",
            success: function (response) {
                alert("Categoria excluida com sucesso")
                window.location.assign("../Categorias/list.php");
            }, error: function () {
                console.log('error 71')
            }
        });
    }
}

function listagem() {
    $.ajax({
        type: "POST",
        url: "../../Source/configajax.php",
        data: {
            action: 'listagem',
            component: 'categoriasController',
            inativas: $("#statusCategoria").is(":checked")
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
                        <td>${v.status}</td>
                        <td>
                            <button type="button" onClick="deleteCategoria(${v.id})" id="btnDelete" class="btn btn-danger">Excluir</button>
                            <button type="button" class="btn btn-info" onClick="editarCategoria(${v.id})">Editar</button>    
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

function editarCategoria(id) {
    window.location.assign(`../Categorias/form.php?cat=${id}`);
}

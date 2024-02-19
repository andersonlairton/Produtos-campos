<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <?php
    include("../Layout/header.php");
    ?>
    <script type="text/javascript" src="produtos.js"></script>

    <div class="container">
        <form>
            <div class="form-group">
                <label for="descricao">Descricao Produto</label>
                <input type="text" class="form-control" id="descricao" placeholder="descrição produto">
            </div>

            <div class="form-group">
                <select class="custom-select" id="categorias">
                    <option selected>Nenhuma categorias cadastrada.</option>
                    
                </select>
            </div>

            <button type="button" id="salvarProduto" class="btn btn-primary">Salvar</button>
        </form>

</body>
<?php include_once("../Layout/footer.html"); ?>

</html>
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
    <script type="text/javascript" src="categorias.js"></script>

    <div class="container">
        <form>
            <div class="form-group">
                <label for="descricao">Descricao Categoria</label>
                <input type="text" class="form-control" id="descricao" placeholder="descrição categorias">
            </div>

            <div class="form-group">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="statusCategoria">
                    <label class="form-check-label" for="statusCategoria" id="statusCheck">Ativada</label>
                </div>
            </div>

            <button type="button" id="salvarCategoria" class="btn btn-primary">Salvar</button>
        </form>

</body>
<?php include_once("../Layout/footer.html"); ?>

</html>
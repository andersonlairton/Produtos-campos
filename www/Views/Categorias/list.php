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
    <script type="text/javascript" src="list.js"></script>

    <div class="container">
        <p><button type="button" id="novaCategoria" class="btn btn-primary">Nova categoria</button></p>
        <p><input type="checkbox" class="form-check-input" id="statusCategoria">
            <label class="form-check-label" for="statusCategoria" id="statusCheck">Exibir inativas</label>
        </p>
        <br>
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="table_list">
                <tr>
                    <th scope="row"></th>
                    <td>Nenhuma categoria cadastrada</td>
                    <td></td>
                    <td></td>
                </tr>

            </tbody>
        </table>
    </div>

</body>
<?php include_once("../Layout/footer.html"); ?>

</html>
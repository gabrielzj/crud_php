<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/form.css">
</head>
<body>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputTipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="InputTipo" name="tipo">
        </div>
        <div class="mb-3">
            <label for="exampleInputNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="InputNome" name="nome">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
    <?php
        require("dbconfig.php");
        //se o metodo post esta definido, ou seja, retorna true
        if(isset($_POST['tipo'])){
            //insere dados na tabela id eh null pois eh auto-increment
            $sql = $conn ->prepare("INSERT INTO produto VALUES (null,?,?)");
            $sql -> execute(array($_POST['tipo'],$_POST['nome']));
            echo '<h2>Produto criado com sucesso</h2>';
            echo "<script>alert('Produto cadastrado!')</script>";
            header("Location: index.php");
        }
    ?>
</body>
</html>
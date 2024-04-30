<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <form action="?page=create" method="POST">
        <div class="mb-3">
            <label for="inputTipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="inputTipo" name="createtipo">
            <div id="tipotext" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="inputNome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="inputNome" name="createname">
        </div>
        <button type="submit" class="btn btn-primary" name="submit_btn">Enviar</button>
    </form>
    <?php
        //se o metodo post esta definido, ou seja, retorna true
        if(isset($_REQUEST['submit_btn'])){
            $tipo = strtolower($_REQUEST['createtipo']);
            $nome = strtolower($_REQUEST['createname']);
            if(empty($tipo) || empty($nome)) {
                echo "<script> alert('Existem campos vazios!') </script>";
            } else {
                //insere dados na tabela id eh null pois eh auto-increment
                $sql = $conn -> prepare("INSERT INTO produto VALUES (null,?,?)");
                $sql -> execute(array($tipo,$nome));
                echo "<script> alert('Produto cadastrado!') </script>";
                header("Location: index.php?page=index");
            }
        }
    ?>
</body>
</html>
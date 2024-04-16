<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <form method="POST">
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
        if(isset($_POST['submit_btn'])){
            $tipo = $_POST['createtipo'];
            $nome = $_POST['createname'];
            if(empty($tipo) || empty($nome)) {
                echo 'Todos os campos devem estar preenchidos';
            } else {
                $query = "SELECT COUNT(*) FROM produto WHERE prod_nome = '$nome' ";
                //insere dados na tabela id eh null pois eh auto-increment
                $sql = $conn -> prepare("INSERT INTO produto VALUES (null,?,?)");
                $sql -> execute(array($tipo,$nome));
                echo "<script> alert('Produto cadastrado!') </script>";
                echo "<scrpt>location.href = '?page=index'; </script>";
            }
        }
    ?>
</body>
</html>
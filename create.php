<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body>
    <h2>Cadastrar Produto</h2>
    <form action="?page=create" method="POST">
        <div class="mb-3">
            <label for="inputTipo" class="form-label">Tipo</label>
            <input type="text" class="form-control border-primary" id="inputTipo" name="createtipo">
            <div id="tipotext" class="form-text"></div>
        </div>
        <div class="mb-3">
            <label for="inputNome" class="form-label">Nome</label>
            <input type="text" class="form-control border-primary" id="inputNome" name="createname">
        </div>
        <button type="submit" class="btn btn-primary" name="submit_btn">Enviar</button>
    </form>
    <?php

    function createProduct($conn, $tipo, $nome)
    {
        $query = "INSERT INTO produto VALUES (null,?,?)";
        $sql = $conn->prepare($query);
        $sql->execute(array($tipo, $nome));
        echo "<script> 
                alert('Produto cadastrado!');
                setTimeout(function() {
                    window.location.href = 'index.php?page=index';
                });   
            </script>";
    }

    if (isset($_REQUEST['submit_btn'])) {
        $tipo = strtolower($_REQUEST['createtipo']);
        $nome = strtolower($_REQUEST['createname']);
        if (empty($tipo) || empty($nome)) {
            echo "<script> alert('Existem campos vazios!') </script>";
        } else {
            try {
                createProduct($conn, $tipo, $nome);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage());
            }
        }
    }
    ?>
</body>

</html>
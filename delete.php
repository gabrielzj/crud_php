<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <h2>Remover Produto</h2>
    <form action="?page=delete" method="POST">
        <div class="mb-3">
            <label for="Tipodelete" class="form-label">ID</label>
            <input type="text" class="form-control" id="TipoDelete" name="deleteid">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_delete">Remover</button>
    </form>
    <?php
    if (isset($_REQUEST['btn_delete'])) {

        $dcod = strtolower($_REQUEST['deleteid']);

        function deleteItem($dcod, $conn)
        {
            $query = 'DELETE FROM produto WHERE prod_cod = :cod';
            $sql = $conn->prepare($query);
            $sql->bindParam(':cod', $dcod, PDO::PARAM_INT);
            $sql->execute();
        }

        if (empty($dcod)) {
            echo "<script> alert('Informe um Código!') </script>";
        } else {
            $query = 'SELECT prod_nome, prod_tipo, prod_cod FROM produto WHERE prod_cod = :cod';
            $sql = $conn->prepare($query);
            $sql->bindParam(':cod', $dcod, PDO::PARAM_INT);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            if ($data) {
                //PDO::FETCH_ASSOC retorna um array com as 3 informações, 1 em cada coluna identificada pelo nome.
                $prod_nome = $data[0]['prod_nome'];
                $prod_tipo = $data[0]['prod_tipo'];
                $prod_cod = $data[0]['prod_cod'];
                deleteItem($dcod, $conn);
                echo "<h3>Item Removido</h3> </br> <b>Nome:</b> $prod_nome </br> <b>Tipo:</b> $prod_tipo </br> <b>ID:</b>$prod_cod";
            } else {
                echo "<script> alert('Produto não encontrado!') </script>";
            }
        }
    }
    ?>
</body>

</html>
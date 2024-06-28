<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body>
    <h2>Consultar Produto</h2>
    <form action="?page=read" method="POST">
        <div class="mb-3">
            <label for="TipoConsulta" class="form-label">Tipo</label>
            <input type="text" class="form-control border-primary" id="TipoConsulta" name="readtipo">
        </div>
        <div class="mb-3">
            <label for="NomeConsulta" class="form-label">Nome</label>
            <input type="text" class="form-control border-primary" id="NomeConsulta" name="readnome">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_read">Consultar</button>
    </form>
    <style>
        .table-container {
            margin-left: 200px;
        }
    </style>
    <?php
    if (isset($_REQUEST["btn_read"])) {

        $rtipo = strtolower($_REQUEST["readtipo"]);
        $rnome = strtolower($_REQUEST["readnome"]);

        //pesquisa por tipo
        function SearchByType($rtipo, $conn)
        {
            $query = "SELECT prod_nome, prod_cod, COUNT(*) AS quant FROM produto WHERE prod_tipo = :tipo GROUP BY prod_nome, prod_cod";
            $sql = $conn->prepare($query);
            $sql->bindParam(':tipo', $rtipo, PDO::PARAM_STR);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($data) == 0) {
                echo "Não foram encontrados resultados!";
            } else {
                //exibe os dados em tabela
                echo "<div class='container text-center table-container'>";
                echo "<div class='row'>";
                echo "<div class='col'><h3><b>Nome</b></h3></div>";
                echo "<div class='col'><h3><b>Quantidade</b></h3></div>";
                echo "<div class='col'><h3><b>ID</b></h3></div>";
                echo "</div>";
                foreach ($data as $row) {
                    echo "<div class='container text-center'>";
                    echo "<div class='row'>";
                    echo "<div class='col'>" . "<h3>" . $row['prod_nome'] . "</h3>" . "</div>";
                    echo "<div class='col'>" . "<h3>" . $row['quant'] . "</h3>" . "</div>";
                    echo "<div class='col'>" . "<h3>" . $row['prod_cod'] . "</h3>" . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }

        // pesquisa por nome
        function SearchByName($rnome, $conn)
        {
            $query = "SELECT prod_tipo, prod_cod, COUNT(*) AS quant FROM produto WHERE prod_nome = :nome GROUP BY prod_tipo, prod_cod";
            $sql = $conn->prepare($query);
            $sql->bindParam(':nome', $rnome, PDO::PARAM_STR);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            if (count($data) == 0) {
                echo "Não foram encontrados resultados!";
            } else {
                echo "<div class='container text-center table-container'>";
                echo "<div class='row'>";
                echo "<div class='col'><h3><b>Tipo</b></h3></div>";
                echo "<div class='col'><h3><b>Quantidade</b></h3></div>";
                echo "<div class='col'><h3><b>ID</b></h3></div>";
                echo "</div>";
                foreach ($data as $row) {
                    echo "<div class='container text-center'>";
                    echo "<div class='row'>";
                    echo "<div class='col'>" . "<h3>" . $row['prod_tipo'] . "<h3>" . "</div>";
                    echo "<div class='col'>" . "<h3>" . $row['quant'] . "<h3>" . "</div>";
                    echo "<div class='col'>" . "<h3>" . $row['prod_cod'] . "<h3>" . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        }

        if (empty($rtipo) && empty($rnome)) {
            echo "<script> alert('Campos vazios!') </script>";
        } else {
            if (!empty($rtipo)) {
                SearchByType($rtipo, $conn);
            }
            if (!empty($rnome)) {
                SearchByName($rnome, $conn);
            }
        }
    }
    ?>
</body>

</html>
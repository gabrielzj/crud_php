<!DOCTYPE html>
<html lang="pt-br">
<head>
</head>
<body>
    <form action="?page=read" method="POST">
        <div class="mb-3">
            <label for="TipoConsulta" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="TipoConsulta" name="readtipo">
        </div>
        <div class="mb-3">
            <label for="NomeConsulta" class="form-label">Nome</label>
            <input type="text" class="form-control" id="NomeConsulta" name="readnome">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_read">Consultar</button>
    </form>
    
    <?php
    //se o botão for pressionado, a variável está setada
        if(isset($_REQUEST["btn_read"])) {
            //passa os valores dos inputs para lowercase
            $rtipo = strtolower($_REQUEST["readtipo"]);
            $rnome = strtolower($_REQUEST["readnome"]);
            
            if(empty($rtipo) && empty($rnome)) {
                echo "<script> alert('Campos vazios!') </script>";
            } else {
                //pesquisa de acordo com o tipo
                if(!empty($rtipo)) {
                    $query = "SELECT prod_nome, COUNT(*) AS quant FROM produto WHERE prod_tipo = :tipo GROUP BY prod_nome";
                    $sql = $conn ->prepare($query);
                    //bind de :nome como a variável $rnome
                    $sql -> bindParam(':tipo', $rtipo, PDO::PARAM_STR);
                    $sql -> execute();
                    //fetch por nome de coluna
                    $data = $sql -> fetchAll(PDO::FETCH_ASSOC);
                    if(count($data) == 0){
                        echo "Não foram encontrados resultados!";
                    } else {
                        foreach($data as $row) {
                            echo "<b>Nome:</b>" . " " . $row['prod_nome'] . " " . "<b>Quantidade:</b>" . " " . $row['quant'] . "<br/>";
                        }
                    }
                }
                //pesquisa feita de acordo com o nome    
                if(!empty($rnome)) {
                    $query = "SELECT prod_tipo, COUNT(*) AS quant FROM produto WHERE prod_nome = :nome GROUP BY prod_tipo";
                    $sql = $conn ->prepare($query);
                    $sql -> bindParam(':nome', $rnome, PDO::PARAM_STR);
                    $sql -> execute();
                    $data = $sql -> fetchAll(PDO::FETCH_ASSOC);
                    if(count($data) == 0) {
                        echo "Não foram encontrados resultados!";
                    } else {
                        foreach($data as $row) {
                            echo "<b>Tipo:</b>" . " " . $row['prod_tipo'] . " " . "<b>Quantidade:</b>". " ".  $row['quant'] . "<br/>";
                        }
                    }
                }            
            }
        }
    ?>   
</body>
</html>
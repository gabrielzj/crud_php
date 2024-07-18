<?php
require_once 'dbconfig.php';
require_once 'product.php';

session_start();

//recupera a variável de sessão
if (isset($_SESSION['selected_id'])) {
    $selected_id = $_SESSION['selected_id'];
} else {
    echo "<script> alert('Erro ao recuperar ID selecionado') </script>";
    exit();
}

// atualiza o id
function updateProductId($selected_id, Product $product, $conn)
{
    $query = "UPDATE produto SET prod_cod = :newid WHERE prod_cod = :cod";
    $sql = $conn->prepare($query);
    $params = array(
        ":newid" => $product->getId(),
        ":cod" => $selected_id
    );
    try {
        $sql->execute($params);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
        exit();
    }
}

// verifica se o id já existe
function verifyId($selected_id, Product $product, $conn)
{
    try {
        $query = "SELECT COUNT(*) as count FROM produto WHERE prod_cod = :newid";
        $sql = $conn->prepare($query);
        $params = array(":newid" => $product->getId());
        $sql->execute($params);
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        if ($data['count'] != 0) {
            echo "<script> 
                alert('Este Id já existe!');
                window.location.href = 'index.php?page=update';   
            </script>";
            exit();
        } else {
            updateProductId($selected_id, $product, $conn);
        }
    } catch (PDOException $e) {
        echo "<script> 
                alert('Erro ao verificar o Id!');
                window.location.href = 'index.php?page=update';   
            </script>";
        exit();
    }
}

//atualiza o tipo
function updateProductType($selected_id, Product $product, $conn)
{
    $query = "UPDATE produto SET prod_tipo = :newtipo WHERE prod_cod = :cod";
    $sql = $conn->prepare($query);
    $params = array(
        ":newtipo" => $product->getType(),
        ":cod" => $selected_id

    );
    try {
        $sql->execute($params);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
        exit();
    }
}

// atualiza o nome
function updateProductName($selected_id, Product $product, $conn)
{
    $query = "UPDATE produto SET prod_nome = :nname WHERE prod_cod = :cod";
    $sql = $conn->prepare($query);
    $params = array(
        ":nname" => $product->getName(),
        ":cod" => $selected_id
    );
    try {
        $sql->execute($params);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}

// atualiza todos 
function updateAll($selected_id, Product $product, $conn)
{
    $query = "UPDATE produto SET prod_cod = :newid, prod_nome = :nname, prod_tipo = :newtipo WHERE prod_cod = :cod";
    $sql = $conn->prepare($query);
    $params = array(
        ':newid' => $product->getId(),
        ':nname' => $product->getName(),
        ':newtipo' => $product->getType(),
        ':cod' => $selected_id
    );
    try {
        $sql->execute($params);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage());
        exit();
    }
}

if (isset($_REQUEST['btn_update'])) {


    $newid = (int) $_REQUEST['newid'];
    $newname = strtolower($_REQUEST['newname']);
    $newtipo = strtolower($_REQUEST['newtipo']);

    $product = new Product($newid, $newname, $newtipo, $selected_id);

    if (empty($newid) && empty($newname) && empty($newtipo)) {
        echo "<script> alert('Todos os campos estão vazios!') </script>";
        exit();
    } else {

        if (!empty($newid) && empty($newname) && empty($newtipo))
            verifyId($selected_id, $product, $conn);
        else if (empty($newid) && !empty($newname) && empty($newtipo))
            updateProductName($selected_id, $product, $conn);
        else if (empty($newid) && empty($newname) && !empty($newtipo))
            updateProductType($selected_id, $product, $conn);
        else if (!empty($newid) && empty($newname) && !empty($newtipo)) {
            verifyId($selected_id, $product, $conn);
            updateProductType($selected_id, $product, $conn);
        } else if (empty($newid) && !empty($newname) && !empty($newtipo)) {
            updateProductName($selected_id, $product, $conn);
            updateProductType($selected_id, $product, $conn);
        } else if (!empty($newid) && !empty($newname) && empty($newtipo)) {
            verifyId($selected_id, $product, $conn);
            updateProductName($selected_id, $product, $conn);
        } else
            updateAll($selected_id, $product, $conn);
    }

    session_unset();
    session_destroy();

    echo "<script>window.location.href = 'index.php?page=index';</script>";
    exit();
}

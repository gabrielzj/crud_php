<!DOCTYPE html>
<html lang="pt-br">

<head>
</head>

<body>
    <h2>Alterar Produto</h2>
    <form action="?page=update" method="POST">
        <div class="mb-3">
            <label for="Tipoupdate" class="form-label">Insira um ID</label>
            <input type="text" class="form-control border-primary" id="Tipoupdate" name="updateid" placeholder="Informe um ID">
        </div>
        <button type="submit" class="btn btn-primary" name="btn_submit">Ir</button>
    </form>
</body>
<?php
session_start();
if (isset($_REQUEST['btn_submit'])) {
    if (empty($_REQUEST['updateid'])) {
        echo '<script>alert("Preencha com um ID")</script>';
    } else {
        //atribuindo a variável de sessão
        $selected_id = $_REQUEST['updateid'];
        $_SESSION['selected_id'] = $selected_id;
?>
        <form method="POST" action="update-form.php">
            <div class="mb-3">
                <h3>O que deseja alterar</h3>
                <label for="newid">ID</label>
                <input type="text" class="border-primary" name="newid">
                <label for="newtipo">Tipo</label>
                <input type="text" class="border-primary" name="newtipo">
                <label for="newname">Nome</label>
                <input type="text" class="border-primary" name="newname">
                <button type="submit" class="btn btn-primary" name="btn_update">Alterar</button>
            </div>
        </form>
<?php
    }
}

?>

</html>
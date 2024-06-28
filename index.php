<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/form.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=index">Produtos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=create">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=update">Alterar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=read">Consultar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-disabled="true" href="?page=delete">Deletar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    include('dbconfig.php');
    //faz include do arquivo de acordo com o request da página
    switch (@$_REQUEST['page']) {
        case 'create':
            include('create.php');
            break;
        case 'update':
            include('update.php');
            break;
        case 'read':
            include('read.php');
            break;
        case 'delete':
            include('delete.php');
            break;
        default:
            echo '<h1>Seja bem-vindo</h1>';
    }
    ?>
</body>

</html>
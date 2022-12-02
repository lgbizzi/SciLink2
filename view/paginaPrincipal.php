<?php

    session_start();

    if(!isset($_SESSION['id_usuario'])==true):

        header("location: ../view/index.php");
        exit;

    endif;


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="../etc/style/area_privada.css">
    <link rel="shortcut icon" href="../etc/imagens/icon/faicon.jpg">
</head>
<body>


<div id="cortes">

<h1>Busque por outros cientistas</h1>

<a href="../controller/sair.php">Sair</a>

</div>

</body>
</html>
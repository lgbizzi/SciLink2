<?php

require_once 'model/classes/Usuarios.php';
$u = new Usuarios();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Scilink</title>
    <link rel="stylesheet" href="../etc/style/main.css">
    <link rel="shortcut icon" href="../etc/imagens/icon/faicon.jpg">
</head>

<body>

<div id="corpo-form">
    <h1>Scilink</h1>

    <form method="POST">
        <input type="text" name="cpf_usuario" placeholder="Usuário"/>
        <input type="password" name="senha_usuario" placeholder="Senha"/>
        <input type="submit" value="ACESSAR" name=""/>
        <a href="../view/cadastrar.php">Ainda não é inscrito? <strong>Inscreva-se!</strong></a>
    </form>
<div>
</body>

<?php

if(isset($_POST['cpf_usuario'])):
    
    $cpf_usuario = addslashes($_POST['cpf_usuario']);
    $senha_usuario = addslashes($_POST['senha_usuario']);

    if(!empty($cpf_usuario) && !empty($senha_usuario)):

        $u->conectar("scilink", "localhost", "root", "");

        if($u->msgERRO == ""):

            if($u->logar($cpf_usuario, $senha_usuario)):

                header("location: ../view/paginaPrincipal.php");

        
            else: 

                ?>

                <div class="msg-erro">
                    Usuário e/ou Senha Incorretos!
                </div>

                <?php

            endif;

        else:

            ?>
           
            <div class="msg-erro"> 
                
                 <?php echo "Erro: ".$u->msgERRO; ?>
            
            </div>

            <?php


        
        endif;

    else:

        ?>

            <div class="msg-erro">
                Preencha Todos os Campos!
            </div>

        <?php




    endif;


endif;



?>

</html>
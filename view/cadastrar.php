<?php

require_once 'model/classes/Usuarios.php';
$u = new Usuarios();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Cadastrar Cientistas</title>
    <link rel="stylesheet" href="../etc/style/main.css">
    <link rel="shortcut icon" href="../etc/imagens/icon/faicon.jpg">
</head>

<body>

<div id="corpo-form-cad">
    <h1>Cadastre-se</h1>

    <form method="POST">
        <input type="text" name="nom_cientista" placeholder="Nome" maxlength="50"/>
        <input type="text" name="cpf_cientista" placeholder="CPF" maxlength="11"/>
        <input type="date" name="dtn_cientista" placeholder="Data Nascimento"/>
        <input type="email" name="email_cientista" placeholder="E-mail" maxlength="50"/>
        <input type="email" name="email_alternativo_cientista" placeholder="E-mail Alternativo" maxlength="50"/>
        <input type="text" name="lattes_cientista" placeholder="Lattes" maxlength="50"/>
        <input type="password" name="snh_cientista" placeholder="Senha" maxlength="10"/>
        <input type="password" name="conf_senha" placeholder="Confirmar Senha"/>
        <input type="text" name="nom_area_atuacao" placeholder="Área de Atuação" maxlength="25"/>
        <input type="date" name="dti_formacao" placeholder="Data Início Formação"/>
        <input type="date" name="dtt_formacao" placeholder="Data Final Formação"/>
        <input type="text" name="nom_titulacao" placeholder="Titulação" maxlength="25"/>
        <input type="submit" value="CADASTRAR" name="" maxlength="15"/>
    </form>
</div>

<?php

if(isset($_POST['nom_cientista'])):

    $nom_cientista = addslashes($_POST['nom_cientista']);
    $cpf_cientista = addslashes($_POST['cpf_cientista']);
    $dtn_cientista = addslashes($_POST['dtn_cientista']);
    $email_cientista = addslashes($_POST['email_cientista']);
    $email_alternativo_cientista = addslashes($_POST['email_alternativo_cientista']);
    $lattes_cientista = addslashes($_POST['lattes_cientista']);
    $snh_cientista = addslashes($_POST['snh_cientista']);
    $conf_senha = addslashes($_POST['conf_senha']);
    $nom_area_atuacao = addslashes($_POST['nom_area_atuacao']);
    $dti_formacao = addslashes($_POST['dti_formacao']);
    $dtf_formacao = addslashes($_POST['dti_formacao']);
    $nom_titulacao = addslashes($_POST['nom_titulacao']);

    if(!empty($nom_cientista) 
        && !empty($cpf_cientista) 
        && !empty($dtn_cientista) 
        && !empty($email_cientista) 
        && !empty($email_alternativo_cientista)
        && !empty($lattes_cientista) 
        && !empty($snh_cientista) 
        && !empty($conf_senha)
        && !empty($nom_area_atuacao)
        && !empty($dti_formacao)
        && !empty($dtf_formacao)
        && !empty($nom_titulacao)):
        
        $u->conectar("scilink", "localhost", "root", "");

        if($u-> msgERRO == ""):

            if($senha==$conf_senha):
           
                if($u->cadastrar($cpf, $senha)):

                    ?>

                    <div id="msg-sucesso">
                        Cadastrado com Sucesso! Acesse para entrar!
                    </div>

                    <?php
                
                else:

                    ?>

                    <div class="msg-erro">
                        Usuário já cadastrado!
                    </div>

                    <?php

                endif;

            else:

                ?>

                    <div class="msg-erro">
                        Senha e Confirmar Senha não correspondem!
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

</body>
</html>
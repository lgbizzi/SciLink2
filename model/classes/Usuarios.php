<?php

class Usuarios{

    private $pdo; 
    public $msgERRO = "";

    public function conectar($nome, $host, $usuario, $senha){

        global $pdo;
        global $msgERRO;

        try{
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);

        }
        catch (PDOException $e){
            $msgERRO = $e->getMessage();

        }
    }

    public function cadastrar($nom_cientista,
                            $cpf_cientista, 
                            $dtn_cientista, 
                            $email_cientista, 
                            $email_alternativo_cientista, 
                            $lattes_cientista, 
                            $snh_cientista,
                            $nom_area_atuacao,
                            $dti_formacao,
                            $dtf_formacao,
                            $nom_titulacao){
        
        global $pdo;
        $sql = $pdo->prepare("SELECT 
                                id_cientista 
                            FROM 
                                cientista 
                            WHERE cpf_cientista = :cpf_cientista");
        $sql-> bindValue(":cpf_cientista", $cpf_cientista);
        $sql-> execute();

        if ($sql->rowCount()>0):
            
            return false; 
        
        else:

        $sql = $pdo->prepare("INSERT INTO cientista (nom_cientista, cpf_cientista, dtn_cientista, email_cientista, email_alternativo_cientista, lattes_cientista, snh_cientista) 
                            VALUES (:nom_cientista, :cpf_cientista, :dtn_cientista, :email_cientista, :email_alternativo_cientista, :lattes_cientista, :snh_cientista)");
        $sql-> bindValue(":nom_cientista", $nom_cientista);
        $sql-> bindValue(":cpf_cientista", $cpf_cientista);
        $sql-> bindValue(":dtn_cientista", $dtn_cientista);
        $sql-> bindValue(":email_cientista", $email_cientista);
        $sql-> bindValue(":email_alternativo_cientista", $email_alternativo_cientista);
        $sql-> bindValue(":lattes_cientista", $lattes_cientista);
        $sql-> bindValue(":snh_cientista", $snh_cientista);
        $sql->execute();

        $sql = $pdo->prepare("INSERT INTO area_atuacao (nom_area_atuacao) 
                            VALUES (:nom_area_atuacao");
        $sql-> bindValue(":nom_area_atuacao", $nom_area_atuacao);
        $sql->execute();

        $sql= $pdo->prepare("SELECT 
                                id_cientista 
                            FROM 
                                cientista WHERE cpf_cientista = :cpf_cientista");
        $sql-> execute();
        $dados = $sql->fetch();
        $id_cientista = $dado['id_cientista'];
        
        $sql = $pdo->prepare("INSERT INTO area_atuacao_cientista (id_cientista, id_area_atuacao) 
                            VALUES (:id_cientista, :id_area_atuacao");
        $sql-> bindValue(":id_cientista", $id_cientista);
        $sql-> bindValue(":id_area_atuacao", $id_area_atuacao);
        $sql->execute();

        $sql = $pdo->prepare("INSERT INTO titulacao (nom_titulacao) 
                            VALUES (:nom_titulacao");
        $sql-> bindValue(":nom_titulacao", $nom_titulacao);
        $sql->execute();

        $sql = $pdo->prepare("INSERT INTO area_atuacao_cientista (id_cientista, id_area_atuacao) 
                            VALUES (:id_cientista, :id_area_atuacao");
        $sql-> bindValue(":id_cientista", $id_cientista);
        $sql-> bindValue(":id_area_atuacao", $id_area_atuacao);
        $sql->execute();

        $sql = $pdo->prepare("INSERT INTO formacao (id_cientista, id_titulacao, dti_formacao, dtt_formacao) 
                            VALUES (:id_cientista, :id_titulacao, dti_formacao, dtt_formacao");
        $sql-> bindValue(":id_cientista", $id_cientista);
        $sql-> bindValue(":id_titulacao", $id_titulacao);
        $sql-> bindValue(":dti_formacao", $dti_formacao);
        $sql-> bindValue(":dtt_formacao", $dtt_formacao);
        $sql->execute();

        return true;

        endif;
    }
    
    public function logar($email, $senha){

        global $pdo;

        $sql= $pdo->prepare("SELECT 
                                id_cientista 
                            FROM 
                                cientista WHERE cpf_cientista = :cpf_cientista AND snh_cientista = :snh_cientista");

        $sql-> bindValue(":cpf_cientista", $cpf_cientista);
        $sql-> bindValue(":snh_cientista", md5($senha));
        $sql-> execute();

        if($sql->rowCount()>0):
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_cientista'] = $dado['id_cientista'];
            return true; //logado com Sucesso

        else:
            return false;

        endif;

    }
}

?>

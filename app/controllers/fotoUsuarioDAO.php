<?php
require_once ("conexao.php");
class FotoUsuarioDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function inserirFoto(FotoUsuario $entFotoUsuario){
        try {
            $stmt = $this->pdo->prepare("INSERT INTO fotos_cliente VALUES (:ftc_us_cod, :ftc_img, :ftc_desc)");
            $param = array(
                ":ftc_us_cod" => $entFotoUsuario->getFtc_us_cod(),
                ":ftc_img" => $entFotoUsuario->getFtc_img(),
                ":ftc_desc" => $entFotoUsuario->getFtc_desc()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO FOTO1: {$ex->getMessage()}";
        }
    }

    function atualizarFoto(FotoUsuario $entFotoUsuario){
        try {
            $stmt = $this->pdo->prepare("UPDATE fotos_cliente SET ftc_img = :ftc_img, ftc_desc = :ftc_desc WHERE ftc_us_cod = :ftc_us_cod");
            $param = array(
                ":ftc_img" => $entFotoUsuario->getFtc_img(),
                ":ftc_desc" => $entFotoUsuario->getFtc_desc(),
                ":ftc_us_cod" => $entFotoUsuario->getFtc_us_cod(),
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO FOTO2: {$ex->getMessage()}";
        }
    }

    function excluirFoto(FotoUsuario $entFotoUsuario){
        try {
            $stmt = $this->pdo->prepare("DELETE FROM fotos_cliente WHERE ftc_us_cod = :ftc_us_cod");
            $param = array(
                ":ftc_cod" => $entFotoUsuario->getFtc_us_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO FOTO3: {$ex->getMessage()}";
        }
    }

    function pegarFoto($ftc_us_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM fotos_cliente WHERE ftc_us_cod = :ftc_us_cod");
            $param = array(":ftc_us_cod" => $ftc_us_cod);
            $stmt->execute($param);
            
            if($stmt->rowCount() > 0){
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }else{
                return '';
            }
        } catch (PDOException $ex) {
            echo "ERRO FOTO4: {$ex->getMessage()}";
        }
    }
}
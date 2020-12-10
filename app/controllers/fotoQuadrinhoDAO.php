<?php
require_once ("conexao.php");
class FotoQuadrinhoDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function inserirFoto(FotoQuadrinho $entFotoQuadrinho){
        try {
            $stmt = $this->pdo->prepare("INSERT INTO fotos_quadrinhos VALUES (:ftq_hq_cod, :ftq_img, :ftq_desc)");
            $param = array(
                ":ftq_hq_cod" => $entFotoQuadrinho->getFtq_hq_cod(),
                ":ftq_img" => $entFotoQuadrinho->getFtq_img(),
                ":ftq_desc" => $entFotoQuadrinho->getFtq_desc()
            );
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO FOTO1: {$ex->getMessage()}";
        }
    }

    function atualizarFoto(FotoQuadrinho $entFotoQuadrinho){
        try {
            $stmt = $this->pdo->prepare("UPDATE fotos_quadrinhos SET ftq_img = :ftq_img, ftq_desc = :ftq_desc WHERE ftq_hq_cod = :ftq_hq_cod");
            $param = array(
                ":ftq_img" => $entFotoQuadrinho->getFtq_img(),
                ":ftq_desc" => $entFotoQuadrinho->getFtq_desc(),
                ":ftq_hq_cod" => $entFotoQuadrinho->getFtq_hq_cod(),
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO FOTO2: {$ex->getMessage()}";
        }
    }

    function excluirFoto(FotoQuadrinho $entFotoQuadrinho){
        try {
            $stmt = $this->pdo->prepare("DELETE FROM fotos_quadrinhos WHERE ftq_hq_cod = :ftq_hq_cod");
            $param = array(
                ":ftq_cod" => $entFotoQuadrinho->getFtq_hq_cod()
            );
            return $stmt->execute($param);

        } catch (PDOException $ex) {
            echo "ERRO FOTO3: {$ex->getMessage()}";
        }
    }

    function pegarFoto($ftq_hq_cod){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM fotos_quadrinhos WHERE ftq_hq_cod = :ftq_hq_cod");
            $param = array(":ftq_hq_cod" => $ftq_hq_cod);
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
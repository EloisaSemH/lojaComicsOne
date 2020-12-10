<?php
#Criação da classe pedido
class Pedido {
    private $ped_cod;
    private $ped_cli_cod;
    private $ped_end_cod;
    private $ped_pedido;
    private $ped_total;
    private $ped_dataHora;
    
    function getPed_cod() {
        return $this->ped_cod;
    }

    function getPed_cli_cod() {
        return $this->ped_cli_cod;
    }

    function getPed_end_cod() {
        return $this->ped_end_cod;
    }

    function getPed_pedido() {
        return $this->ped_pedido;
    }

    function getPed_total() {
        return $this->ped_total;
    }
    
    function getPed_dataHora() {
        return $this->ped_dataHora;
    }

    function setPed_Cod($ped_cod) {
        $this->ped_cod = $ped_cod;
    }

    function setPed_cli_cod($ped_cli_cod) {
        $this->ped_cli_cod = $ped_cli_cod;
    }

    function setPed_end_cod($ped_end_cod) {
        $this->ped_end_cod = $ped_end_cod;
    }

    function setPed_pedido($ped_pedido) {
        $this->ped_pedido = $ped_pedido;
    }

    function setPed_total($ped_total) {
        $this->ped_total = $ped_total;
    }

    function setPed_dataHora($ped_dataHora) {
        $this->ped_dataHora = $ped_dataHora;
    }
}
?>
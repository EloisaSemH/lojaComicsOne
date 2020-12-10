<?php
#Criação da classe usuário
class Endereco {
    //Criação dos atributos (variávies)
    private $end_cod;
    private $end_cli_cod;
    private $end_cep;
    private $end_rua;
    private $end_numero;
    private $end_bairro;
    private $end_complemento;

    function getEnd_cod() {
        return $this->end_cod;
    }

    function getEnd_cli_cod() {
        return $this->end_cli_cod;
    }

    function getEnd_cep() {
        return $this->end_cep;
    }

    function getEnd_rua() {
        return $this->end_rua;
    }

    function getEnd_numero() {
        return $this->end_numero;
    }

    function getEnd_bairro() {
        return $this->end_bairro;
    }

    function getEnd_complemento() {
        return $this->end_complemento;
    }

    function setEnd_cod($end_cod) {
        $this->end_cod = $end_cod;
    }

    function setEnd_cli_cod($end_cli_cod) {
        $this->end_cli_cod = $end_cli_cod;
    }

    function setEnd_cep($end_cep) {
        $this->end_cep = $end_cep;
    }

    function setEnd_rua($end_rua) {
        $this->end_rua = $end_rua;
    }

    function setEnd_numero($end_numero) {
        $this->end_numero = $end_numero;
    }

    function setEnd_bairro($end_bairro) {
        $this->end_bairro = $end_bairro;
    }

    function setEnd_complemento($end_complemento) {
        $this->end_complemento = $end_complemento;
    }
}
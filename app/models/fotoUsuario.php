<?php
#Criação da classe fotos
class FotoUsuario{
    private $ftc_img;
    private $ftc_us_cod;
    private $ftc_desc;
    
    function getFtc_img() {
        return $this->ftc_img;
    }

    function getFtc_us_cod() {
        return $this->ftc_us_cod;
    }

    function getFtc_desc() {
        return $this->ftc_desc;
    }

    function setFtc_img($ftc_img) {
        $this->ftc_img = $ftc_img;
    }

    function setFtc_us_cod($ftc_us_cod) {
        $this->ftc_us_cod = $ftc_us_cod;
    }

    function setFtc_desc($ftc_desc) {
        $this->ftc_desc = $ftc_desc;
    }

}
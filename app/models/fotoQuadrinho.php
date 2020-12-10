<?php
#Criação da classe fotos
class FotoQuadrinho{
    private $ftq_img;
    private $ftq_hq_cod;
    private $ftq_desc;
    
    function getFtq_img() {
        return $this->ftq_img;
    }

    function getFtq_hq_cod() {
        return $this->ftq_hq_cod;
    }

    function getFtq_desc() {
        return $this->ftq_desc;
    }

    function setFtq_img($ftq_img) {
        $this->ftq_img = $ftq_img;
    }

    function setFtq_hq_cod($ftq_hq_cod) {
        $this->ftq_hq_cod = $ftq_hq_cod;
    }

    function setFtq_desc($ftq_desc) {
        $this->ftq_desc = $ftq_desc;
    }

}
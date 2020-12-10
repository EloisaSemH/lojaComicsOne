<?php
#Criação da classe categoria
class Categoria
{
    private $cat_cod;
    private $cat_nome;
    private $hq_cod;

    function getCat_cod()
    {
        return $this->cat_cod;
    }

    function getCat_nome()
    {
        return $this->cat_nome;
    }

    function getHq_cod()
    {
        return $this->hq_cod;
    }

    // SETS
    function setCat_Cod($cat_cod)
    {
        $this->cat_cod = $cat_cod;
    }

    function setCat_nome($cat_nome)
    {
        $this->cat_nome = $cat_nome;
    }
    
    function setHq_cod($hq_cod)
    {
        $this->hq_cod = $hq_cod;
    }
}

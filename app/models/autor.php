<?php
#Criação da classe categoria
class Autor
{
    private $aut_cod;
    private $aut_nomeArtistico;
    private $aut_nomeVerdadeiro;
    private $aut_genero;
    private $aut_sobre;
    private $aut_pais;
    private $aut_site;
    private $aut_dataHoraCriacao;
    private $aut_dataHoraEdicao;
    private $hq_cod;

    function getAut_cod()
    {
        return $this->aut_cod;
    }

    function getAut_nomeArtistico()
    {
        return $this->aut_nomeArtistico;
    }

    function getAut_nomeVerdadeiro()
    {
        return $this->aut_nomeVerdadeiro;
    }

    function getAut_genero()
    {
        return $this->aut_genero;
    }

    function getAut_sobre()
    {
        return $this->aut_sobre;
    }

    function getAut_pais()
    {
        return $this->aut_pais;
    }

    function getAut_site()
    {
        return $this->aut_site;
    }

    function getAut_dataHoraCriacao()
    {
        return $this->aut_dataHoraCriacao;
    }

    function getAut_dataHoraEdicao()
    {
        return $this->aut_dataHoraEdicao;
    }

    function getHq_cod()
    {
        return $this->hq_cod;
    }

    // Set
    function setAut_Cod($aut_cod)
    {
        $this->aut_cod = $aut_cod;
    }

    function setAut_nomeArtistico($aut_nomeArtistico)
    {
        $this->aut_nomeArtistico = $aut_nomeArtistico;
    }

    function setAut_nomeVerdadeiro($aut_nomeVerdadeiro)
    {
        $this->aut_nomeVerdadeiro = $aut_nomeVerdadeiro;
    }

    function setAut_genero($aut_genero)
    {
        $this->aut_genero = $aut_genero;
    }

    function setAut_sobre($aut_sobre)
    {
        $this->aut_sobre = $aut_sobre;
    }
    
    function setAut_pais($aut_pais)
    {
        $this->aut_pais = $aut_pais;
    }

    function setAut_site($aut_site)
    {
        $this->aut_site = $aut_site;
    }

    function setAut_dataHoraCriacao($aut_dataHoraCriacao)
    {
        $this->aut_dataHoraCriacao = $aut_dataHoraCriacao;
    }

    function setAut_dataHoraEdicao($aut_dataHoraEdicao)
    {
        $this->aut_dataHoraEdicao = $aut_dataHoraEdicao;
    }

    function setHq_cod($hq_cod)
    {
        $this->hq_cod = $hq_cod;
    }
}

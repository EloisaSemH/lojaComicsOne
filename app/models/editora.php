<?php
#Criação da classe categoria
class Editora
{
    private $edi_cod;
    private $edi_nome;
    private $edi_sobre;
    private $edi_pais;
    private $edi_site;
    private $edi_dataHoraCriacao;
    private $edi_dataHoraEdicao;

    function getEdi_cod()
    {
        return $this->edi_cod;
    }

    function getEdi_nome()
    {
        return $this->edi_nome;
    }

    function getEdi_sobre()
    {
        return $this->edi_sobre;
    }

    function getEdi_pais()
    {
        return $this->edi_pais;
    }

    function getEdi_site()
    {
        return $this->edi_site;
    }

    function getEdi_dataHoraCriacao()
    {
        return $this->edi_dataHoraCriacao;
    }

    function getEdi_dataHoraEdicao()
    {
        return $this->edi_dataHoraEdicao;
    }

    // Set
    function setEdi_Cod($edi_cod)
    {
        $this->edi_cod = $edi_cod;
    }

    function setEdi_nome($edi_nome)
    {
        $this->edi_nome = $edi_nome;
    }

    function setEdi_sobre($edi_sobre)
    {
        $this->edi_sobre = $edi_sobre;
    }
    
    function setEdi_pais($edi_pais)
    {
        $this->edi_pais = $edi_pais;
    }

    function setEdi_site($edi_site)
    {
        $this->edi_site = $edi_site;
    }

    function setEdi_dataHoraCriacao($edi_dataHoraCriacao)
    {
        $this->edi_dataHoraCriacao = $edi_dataHoraCriacao;
    }

    function setEdi_dataHoraEdicao($edi_dataHoraEdicao)
    {
        $this->edi_dataHoraEdicao = $edi_dataHoraEdicao;
    }
}

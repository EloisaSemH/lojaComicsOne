<?php
class Usuario
{
    private $us_cod;
    private $us_nome;
    private $us_email;
    private $us_cpf;
    private $us_genero;
    private $us_dataNasc;
    private $us_telefone;
    private $us_dataHoraCriacao;
    private $us_dataHoraEdicao;
    private $us_dataHoraLogin;
    private $us_ip;
    private $us_tipo;

    function getUs_cod()
    {
        return $this->us_cod;
    }

    function getUs_nome()
    {
        return $this->us_nome;
    }

    function getUs_email()
    {
        return $this->us_email;
    }

    function getUs_cpf()
    {
        return $this->us_cpf;
    }
    function getUs_genero()
    {
        return $this->us_genero;
    }

    function getUs_dataNasc()
    {
        return $this->us_dataNasc;
    }

    function getUs_telefone()
    {
        return $this->us_telefone;
    }

    function getUs_dataHoraCriacao()
    {
        return $this->us_dataHoraCriacao;
    }

    function getUs_dataHoraEdicao()
    {
        return $this->us_dataHoraEdicao;
    }

    function getUs_dataHoraLogin()
    {
        return $this->us_dataHoraLogin;
    }

    function getUs_ip()
    {
        return $this->us_ip;
    }

    function getUs_tipo()
    {
        return $this->us_tipo;
    }
    // SET  
    function setUs_cod($us_cod)
    {
        $this->us_cod = $us_cod;
    }

    function setUs_nome($us_nome)
    {
        $this->us_nome = $us_nome;
    }

    function setUs_cpf($us_cpf)
    {
        $this->us_cpf = $us_cpf;
    }

    function setUs_email($us_email)
    {
        $this->us_email = $us_email;
    }

    function setUs_genero($us_genero)
    {
        $this->us_genero = $us_genero;
    }

    function setUs_dataNasc($us_dataNasc)
    {
        $this->us_dataNasc = $us_dataNasc;
    }

    function setUs_telefone($us_telefone)
    {
        $this->us_telefone = $us_telefone;
    }

    function setUs_dataHoraCriacao($us_dataHoraCriacao)
    {
        $this->us_dataHoraCriacao = $us_dataHoraCriacao;
    }

    function setUs_dataHoraEdicao($us_dataHoraEdicao)
    {
        $this->us_dataHoraEdicao = $us_dataHoraEdicao;
    }

    function setUs_dataHoraLogin($us_dataHoraLogin)
    {
        $this->us_dataHoraLogin = $us_dataHoraLogin;
    }

    function setUs_ip($us_ip)
    {
        $this->us_ip = $us_ip;
    }

    function setUs_tipo($us_tipo)
    {
        $this->us_tipo = $us_tipo;
    }
}

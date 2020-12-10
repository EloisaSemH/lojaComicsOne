<?php
class Quadrinho
{
    private $hq_cod;
    private $hq_titulo;
    private $hq_edicao;
    private $hq_volume;
    private $hq_serie;
    private $hq_editora_cod;
    private $hq_lancamento;
    private $hq_numPaginas;
    private $hq_impressao;
    private $hq_sinopse;
    private $hq_faixaEtaria;
    private $hq_valor;
    private $hq_porcentagemPromocao;
    private $hq_estoque;
    private $hq_emEstoque;
    private $hq_dataHoraCriacao;
    private $hq_dataHoraEdicao;

    function getHq_cod()
    {
        return $this->hq_cod;
    }

    function getHq_titulo()
    {
        return $this->hq_titulo;
    }

    function getHq_edicao()
    {
        return $this->hq_edicao;
    }

    function getHq_volume()
    {
        return $this->hq_volume;
    }

    function getHq_serie()
    {
        return $this->hq_serie;
    }

    function getHq_tipo()
    {
        return $this->hq_tipo;
    }

    function getHq_editora_cod()
    {
        return $this->hq_editora_cod;
    }

    function getHq_lancamento()
    {
        return $this->hq_lancamento;
    }

    function getHq_numPaginas()
    {
        return $this->hq_numPaginas;
    }

    function getHq_impressao()
    {
        return $this->hq_impressao;
    }

    function getHq_sinopse()
    {
        return $this->hq_sinopse;
    }

    function getHq_faixaEtaria()
    {
        return $this->hq_faixaEtaria;
    }

    function getHq_valor()
    {
        return $this->hq_valor;
    }

    function getHq_porcentagemPromocao()
    {
        return $this->hq_porcentagemPromocao;
    }

    function getHq_estoque()
    {
        return $this->hq_estoque;
    }

    function getHq_emEstoque()
    {
        return $this->hq_emEstoque;
    }

    function getHq_dataHoraCriacao()
    {
        return $this->hq_dataHoraCriacao;
    }

    function getHq_dataHoraEdicao()
    {
        return $this->hq_dataHoraEdicao;
    }

    // Sets
    function setHq_cod($hq_cod)
    {
        $this->hq_cod = $hq_cod;
    }

    function setHq_titulo($hq_titulo)
    {
        $this->hq_titulo = $hq_titulo;
    }

    function setHq_edicao($hq_edicao)
    {
        $this->hq_edicao = $hq_edicao;
    }

    function setHq_volume($hq_volume)
    {
        $this->hq_volume = $hq_volume;
    }

    function setHq_serie($hq_serie)
    {
        $this->hq_serie = $hq_serie;
    }

    function setHq_tipo($hq_tipo)
    {
        $this->hq_tipo = $hq_tipo;
    }

    function setHq_editora_cod($hq_editora_cod)
    {
        $this->hq_editora_cod = $hq_editora_cod;
    }

    function setHq_lancamento($hq_lancamento)
    {
        $this->hq_lancamento = $hq_lancamento;
    }

    function setHq_numPaginas($hq_numPaginas)
    {
        $this->hq_numPaginas = $hq_numPaginas;
    }

    function setHq_impressao($hq_impressao)
    {
        $this->hq_impressao = $hq_impressao;
    }

    function setHq_sinopse($hq_sinopse)
    {
        $this->hq_sinopse = $hq_sinopse;
    }

    function setHq_faixaEtaria($hq_faixaEtaria)
    {
        $this->hq_faixaEtaria = $hq_faixaEtaria;
    }

    function setHq_valor($hq_valor)
    {
        $this->hq_valor = $hq_valor;
    }

    function setHq_porcentagemPromocao($hq_porcentagemPromocao)
    {
        $this->hq_porcentagemPromocao = $hq_porcentagemPromocao;
    }

    function setHq_estoque($hq_estoque)
    {
        $this->hq_estoque = $hq_estoque;
    }
    
    function setHq_emEstoque($hq_emEstoque)
    {
        $this->hq_emEstoque = $hq_emEstoque;
    }

    function setHq_dataHoraCriacao($hq_dataHoraCriacao)
    {
        $this->hq_dataHoraCriacao = $hq_dataHoraCriacao;
    }

    function setHq_dataHoraEdicao($hq_dataHoraEdicao)
    {
        $this->hq_dataHoraEdicao = $hq_dataHoraEdicao;
    }
}

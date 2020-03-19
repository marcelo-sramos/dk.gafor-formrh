<?php

namespace Modelo;

class Index extends ManipularDados
{

    public $mvcDados;
    public $mvcMetodo;
    public $mvcParametro;
    public $mvcFormulario;


    public function listarNoticias()
    {
        $this->sqlTabela = 'publicacoes';
        $this->sqlColunas = 'id, titulo,descricao, autor, secao, data, assunto';
        $this->sqlOrdenacao = array('data', 'DESC');
        $this->paginacaoQuantidade = 30;
        $this->paginacaoPagina = $this->Variaveis[0] == 'pagina' ? $this->Variaveis[1] : null;
        $this->paginacaoUrl = '/';
        $r = parent::selecionarDadosPaginado();


        return $r;

    }


}

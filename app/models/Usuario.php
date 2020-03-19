<?php

namespace Modelo;

/**
 * Class Usuario
 *
 * Executa operações para manipular dados para Páginas
 *
 * @package Modelo
 */
class Usuario extends ManipularDados
{
    /**
     * @var string armazena o nome do método
     */
    public $mvcMetodo;
    /**
     * @var string|array armazena dados e valores para serem utilizados pelo  método
     */
    public $mvcParametro;
    /**
     * @var array aramzena dados de formualário submetido
     */
    public $mvcFormulario;
    /**
     * @var array armazena ações/métodos habilitados
     */
    public $mvcAcoes;
    /**
     * @var string armazena o nome do modelo/controle
     */
    public $mvcNome;
    /**
     * @var string armazena mensagens de erros e avisos
     */
    public $mvcAvisos;

    /**
     * Executa a visualização de todas as páginas com paginação
     *
     * @return array armazena todos os registro agrupados por páginas e nomes das seções
     */
    public function listarUsuarios()
    {
        $this->sqlOrdenacao = array('id', 'DESC');
        $this->paginacaoQuantidade = 10;
        $this->paginacaoPagina = $this->mvcParametro[1];
        return parent::selecionarDadosPaginado();
    }

    /**
     * Executa a visualização de uma determinada página
     *
     * @return array|int  armazena dados da consulta ou código de erro
     */
    public function exibirUsuario()
    {
        $this->sqlId['valor'] = $this->mvcParametro[0];
        $rs = parent::selecionarDadosFiltroId();
        if ($rs === false):
            return $this->mvcAvisos = 10;
        endif;
        return $rs;
    }

    /** Executa a preparação para edição de determinada página
     *
     * @return array armazena dados da página
     */
    public function editarUsuario()
    {
        $this->sqlId["valor"] = $this->mvcParametro[0];
        $r = parent::selecionarDadosFiltroId();
        return [
            'rs' => $r
        ];
    }

    public function inserirUsuario()
    {
        if (self::validarEmail($this->mvcFormulario["usuario"])):
            $this->mvcFormulario["senha"] = self::gerarSenha(
                $this->mvcFormulario["senha"]
            );
        else:
            return $this->mvcAvisos = 20;
        endif;

        return $this->inserirDados();
    }

    public function atualizarUsuario()
    {
        $this->mvcFormulario["senha"] = self::gerarSenha(
            $this->mvcFormulario["senha"]
        );
        return $this->atualizarDados();
    }

    protected function gerarSenha($senha)
    {
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    protected function verificarSenha($senha, $hash)
    {
        return password_verify($senha, $hash) ? true : false;
    }

    private function validarEmail()
    {
        // Validar formato
        if (filter_var($email, FILTER_VALIDATE_EMAIL)):
            // Validar duplicação
            $this->sqlColunas = ['usuario'];
            $this->sqlValores = $this->mvcFormulario["usuario"];
            $r = parent::verificarExistenciaDados();
        else:
            $r = false;
        endif;
        return $r;
    }

    private function validarSenha($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


}


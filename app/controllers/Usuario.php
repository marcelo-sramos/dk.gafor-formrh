<?php

namespace Controle;
use \Modelo\Usuario as UsuarioModelo;


/**
 * Class Usuario
 *
 * Controla a requisição de dados e a requisição de visualizações
 * Gerencia os templates e requisita as operações ao modelo
 *
 * @package Controle
 */

class Usuario extends UsuarioModelo implements InterfaceMvc
{

    public function __construct($metodo, $parametros, $formulario)
    {
        $this->mvcMetodo = $metodo;
        $this->mvcParametro = $parametros;
        $this->mvcFormulario = $formulario;
        $this->sqlTabela = 'usuarios';
        $this->mvcAcoes = [
            'padrao' => 'listar',
            'visao' => array('listar', 'exibir'),
            'salvar',
            'inserir',
            'editar',
            'exibir'
        ];
        $this->sqlId['coluna'] = 'id';
        $this->mvcNome = 'Usuarios';
    }

    use AcoesMvc;

    /**
     * Executa a listagem de todos os registros
     *
     * @return array armazena resultados da consulta
     */
    public function listar()
    {
        return parent::listarUsuarios();
    }


    /**
     * Carrega dados para atualização de uma determinado registro
     *
     * @return array armazena os dados que serão atualizados
     */
    public function editar()
    {
        return parent::editarUsuario();
    }

    /**
     * Carrega dados para preparar a inserção de dados
     *
     * @return bool armazena os dados necessários para inserção
     */
    public function inserir()
    {
        return false;
    }

    /**
     * Executa o processamento de um formulário para inserção ou atualização de dados
     */
    public function salvar()
    {
        $r = !empty($this->mvcFormulario[$this->sqlId["coluna"]])
            ? parent::atualizarUsuario() : parent::inserirUsuario();
        $this->mvcAvisos = $r == true ? 1 : $this->sqlErro;
        return $r;
    }

    public function carregarDados()
    {
        $rAcao = $this->carregarAcao();
        return self::$rAcao();
    }

    public function verificarRestricao()
    {
        $requisitos = [
            'exibir' => ['id:' . $this->mvcParametro[0]],
            'editar' => ['id:' . $this->mvcParametro[0]]
        ];

        return $requisitos[$this->mvcMetodo];
    }

    public function definirVisao()
    {
        return false;
    }


}


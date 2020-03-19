<?php

namespace Modelo;

/**
 * Class Formulario
 *
 * Executa operações para manipular dados para Páginas
 *
 * @package Modelo
 */
class Formulario extends ManipularDados
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
     * @var array aramzena da ações/metodos habilitados
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
    public function listarRegistros()
    {
        $this->sqlColunasSelecionadas = 'id,nome,nome_completo';
        $this->sqlTabela = 'dados_pessoais';
        $r =  parent::selecionarTodosDados();
        return ['rs' => $r];
    }

    /**
     * Executa a visualização de uma determinada página
     *
     * @return array|int  armazena dados da consulta ou código de erro
     */
    public function exibirRegistro()
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
    public function editarRegistro()
    {

        $this->sqlId["valor"] = base64_decode($this->mvcParametro[0]);
        $r = parent::selecionarDadosFiltroId();
        return [
            'rs' => $r,
            'pessoa' => self::selecionarPessoa(),
        ];
    }


    public function buscarRegistro()
    {
        $this->sqlValores = $this->mvcParametro[0];
        return parent::buscarDados();
    }

    public function selecionarPessoa()
    {
        $this->sqlTabela = 'dados_pessoais';
        $this->sqlId['coluna'] ='id';
        $this->sqlId['valor'] = base64_decode($this->mvcParametro[0]);
        $this->sqlColunasSelecionadas = 'id,nome,nome_completo';
        $r = parent::selecionarDadosFiltroId();
        if($r == false):
            $this->mvcAvisos = 5;
        endif;
        return $r;
    }

    public function uploadArquivo($id,$tipo) {
        $arquivoDiretorio = DIRETORIO_RAIZ.'/public/files/'.date("Y/m").'/';
        $arquivoNome = $_FILES["arquivo"]["name"];
        $arquivoNovoNome = 'FILE_'.$this->sqlTabela.'_'.$id.'_'.date("His"). '.' . substr($arquivoNome, -3);
        $arquivoNomeTemporario = $_FILES["arquivo"]["tmp_name"];
        if (!empty($arquivoNome)) {

            //Verifica a existência do diretório e cria
            if (!file_exists($arquivoDiretorio)){
                mkdir("$arquivoDiretorio", 0755, true);
            }
            if (move_uploaded_file($arquivoNomeTemporario, ($arquivoDiretorio . $arquivoNovoNome))) {
                $arquivosStatus = true;
                $arquivoNovoNomeCompleto= '/public/files/'.date("Y/m").'/'.$arquivoNovoNome;
                self::armazenarArquivo($arquivoNovoNomeCompleto, $id, $tipo);
            } else {
                $arquivosStatus = false;
            }
        }
        return array($arquivosStatus);
    }

    public function armazenarArquivo($arquivoNovoNomeCompleto,$id,$tipo)
    {
        $this->sqlTabela = 'arquivos';
        $this->sqlColunas = ['endereco', 'id_pessoa', 'tipo'];
        $this->sqlValores = [$arquivoNovoNomeCompleto, $id, $tipo];
        $r = parent::inserirDadosDireto();
        $this->sqlTabela = $tipo;
        return $r;
    }

    public function selecionarArquivos($sqlTabela, $id)
    {
        $this->sqlColunasSelecionadas = 'id, endereco';
        $this->sqlTabela = 'arquivos';
        $this->sqlColunas = ['id_pessoa','tipo'];
        $this->sqlValores = [$id,$sqlTabela];
        $this->sqlOperadores = [['=','='],'AND'];
        return parent::selecionarDadosFiltrado();
    }


}
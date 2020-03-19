<?php

namespace Modelo;

/**
 * Class Formulario
 *
 * Executa operações para manipular dados para Páginas
 *
 * @package Modelo
 */
class Funcoes extends ManipularDados
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


    public function prepararExclusao()
    {
        if (strstr($this->mvcParametro[0], '-')) {
            $parametros = explode("-", $this->mvcParametro[0]);
            switch ($parametros[0]) {
                case 'noticias':
                    $tabela = 'releases';
                    $colunaId = 'id';
                    break;
                case 'foto':
                    $tabela = 'fotos';
                    $colunaId = 'id';
                    break;
                case 'publicacao':
                    $tabela = 'publicacoes';
                    $colunaId = 'id';
                    break;
                case 'usuarios':
                    $tabela = 'usuarios';
                    $colunaId = 'id';
                    break;
                case 'paginas':
                    $tabela = 'paginas';
                    $colunaId = 'id';
                    break;
                case 'secoes':
                    $tabela = 'secoes';
                    $colunaId = 'id';
                    break;
            }
            if (isset($tabela)) {
                $rs = parent::selecionarDados(
                    "SELECT * FROM " . $tabela . " WHERE " . $colunaId . " = '"
                    . $parametros[1] . "' LIMIT 1"
                );
                $r = array(
                    $rs,
                    $tabela,
                    $colunaId,
                    $parametros[1],
                    $parametros[0]
                );
                if (empty($r)) {
                    $r = array(false, 10,$parametros[0]);
                }
            } else {
                $r = array(false, 10,$parametros[0]);
            }
        } else {
            $r = array(false, 11);
        }
        return $r;
    }

    public function destruirDados()
    {
        switch ($this->mvcFormulario["modelo"]) {
            case 'fotos':
                $dependencias = 1;
                break;
            case 'paginas':
                $dependencias = 1;
                break;
            case 'publicacao':
                $dependencias = 1;
                break;
        }

        if ($this->mvcFormulario['Excluir'] == "Sim") {
            if ($dependencias == 1) {
                self::destruirFoto();
            }
            if ($dependencias == 3) {
                self::destruirArquivo();
            }
            $this->sqlTabela = $this->mvcFormulario["tabela"];
            $this->sqlId["coluna"] = $this->mvcFormulario["coluna_id"];
            $this->sqlId["valor"] = $this->mvcFormulario["id"];
            $r = parent::apagarDados() === false ? false :true;
            $rMensagem = $r == true ? 17 : 15;
            $r = array($r,$rMensagem);
        } else {
            $r = array(false, 16);
        }
        return $r;
    }


    public function destruirFoto()
    {
        $this->sqlTabela = 'fotos';
        $this->sqlColunas = 'id_origem';
        $this->sqlValores = $this->mvcFormulario["id"];
        $this->sqlOperadores = ['='];
        $rFoto = parent::selecionarDadosFiltrado();

        if (!empty($rFoto)) {
            self::destruirArquivo(DIRETORIO_RAIZ . $rFoto[0]['foto']);
        }
    }


    public function destruirArquivo($Arquivo)
    {
        if (!unlink($Arquivo)) {
            $r = false;
        } else {
            $r = true;
        }
        return $Arquivo;
    }


}

?>
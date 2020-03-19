<?php

namespace Controle;

use \Modelo\Formulario as PaginaModelo;

/**
 * Class Formulario
 *
 * Controla a requisição de dados e a requisição de visualizações
 * Gerencia os templates e requisita as operações ao modelo
 *
 * @package Controle
 */
class Formulario extends PaginaModelo implements InterfaceMvc
{
    /**
     * Formulario constructor.
     *
     * Carrega os configurações básicas para funcionamento
     *
     * @param string $metodo armazena o nome do método
     * @param array  $parametros armazena dados e valores passados pela rota
     * @param array  $formulario armazena dados de uma formulário submetido
     */

    use AcoesMvc;

    public function __construct($metodo, $parametros, $formulario)
    {
        if (is_numeric($metodo)) {
            array_unshift($parametros, $metodo);
        }
        $this->mvcMetodo = is_numeric($metodo) ? 'exibir' : $metodo;
        $this->mvcParametro = $parametros;
        $this->mvcFormulario = $formulario;
        $this->mvcAcoes = [
            'padrao' => 'listar',
            'visao' => array(
                'listar',
                'cadastro',
                'documentos',
                'exames',
                'dependente',
                'complementar',
                'finalizar',
                'integrar',
                'busca',
                'exibir'
            ),
            'exibir',
            'salvar',
            'integrar',
            'busca',
            'inserir',
            'editar',
            'cadastro',
            'finalizar',
            'documentos',
            'complementar',
            'dependente',
            'exames'
        ];
        $this->sqlId['coluna'] = 'id';
        $this->mvcNome = 'Formulario';
    }




    /**
     * Executa a listagem de todos os registros
     *
     * @return array armazena resultados da consulta
     */
    public function listar()
    {
        $this->sqlTabela = 'dados_pessoais';
        return parent::listarRegistros();
    }


    public function cadastro()
    {
        $this->sqlTabela = 'dados_pessoais';
        $this->sqlId["coluna"] = 'id';
        if($this->mvcParametro[0] != 'novo'):
        $r = parent::editarRegistro();
        endif;
        if (!empty($r['rs'])):
            $selecoes = [
                'pele' => parent::marcarSelecao($r['rs']["cor_pele"]),
                'sexo' => parent::marcarSelecao($r['rs']["sexo"]),
                'deficiencia' => parent::marcarSelecao($r['rs']["deficiencia"]),
                'pais' => parent::marcarSelecao($r['rs']["nasc_pais"]),
                'estado' => parent::marcarSelecao($r['rs']["nasc_estado"]),
                'cidade' => parent::marcarSelecao($r['rs']["nasc_cidade"]),
                'endereco_uf' => parent::marcarSelecao($r['rs']["endereceo_estado"]),
                'educ_ins' => parent::marcarSelecao($r['rs']["escolaridade"]),
                'educ_estag' => parent::marcarSelecao($r['rs']["escolaridadade_estagio"]),
                'endereco_cidade' => parent::marcarSelecao($r['rs']["endereceo_cidade"]),
                'ende_tp' => parent::marcarSelecao($r['rs']["endereco_tp"]),
                'end_estado' => parent::marcarSelecao($r['rs']["endereceo_estado"]),
                'est_civil' => parent::marcarSelecao($r['rs']["estado_civil"]),
                'docs' => parent::selecionarArquivos($this->sqlTabela,$r['rs']["id"])
            ];
            //var_dump($selecoes);exit;
            $r = array_merge($r, $selecoes);
        endif;
        return $r;
    }

    public function documentos()
    {
        $this->sqlTabela = 'documentos';
        $this->sqlId["coluna"] = 'id_pessoa';
        $r = parent::editarRegistro();
        if (!empty($r['rs'])):
            $selecoes = [
                'rg_uf' => parent::marcarSelecao($r['rs']["rg_estado"]),
                'titulo_uf' => parent::marcarSelecao($r['rs']["titulo_estado"]),
                'cnh_categoria' => parent::marcarSelecao($r['rs']["cnh_categoria"]),
                'ctps_estado' => parent::marcarSelecao($r['rs']["ctps_estado"]),
                'crm_estadp' => parent::marcarSelecao($r['rs']["exame_tox_crm_est"]),
                'cnh_estado' => parent::marcarSelecao($r['rs']["cnh_estado"]),
                'docs' => parent::selecionarArquivos($this->sqlTabela,$r['rs']["id"])
            ];
            //var_dump($selecoes);exit;
            $r = array_merge($r, $selecoes);
        endif;
        return $r;
    }

    public function complementar()
    {
        $this->sqlTabela = 'informacoes';
        $this->sqlId["coluna"] = 'id_pessoa';
        $r = parent::editarRegistro();
        if (!empty($r['rs'])):
            $selecoes = [
                'admissao_tipo' => parent::marcarSelecao($r['rs']["admissao_tipo"]),
                'admissao_gov' => parent::marcarSelecao($r['rs']["admissao_gov"]),
                'horario' => parent::marcarSelecao($r['rs']["horario"]),
                'vinculo' => parent::marcarSelecao($r['rs']["vinculo"]),
                'marcado_ponto' => parent::marcarSelecao($r['rs']["marcado_ponto"]),
                'salario' => parent::marcarSelecao($r['rs']["salario"]),
                'caged_status' => parent::marcarSelecao($r['rs']["caged_status"]),
                'folha' => parent::marcarSelecao($r['rs']["folha"]),
                'prazo_contrato' => parent::marcarSelecao($r['rs']["prazo_contrato"]),
                'caged_tp_emprego' => parent::marcarSelecao($r['rs']["caged_tp_emprego"]),
                'centro_custos' => parent::marcarSelecao($r['rs']["centro_custos"]),
                'area_atuacao' => parent::marcarSelecao($r['rs']["area_atuacao"]),
                'sindicato_associado' => parent::marcarSelecao($r['rs']["sindicato_associado"]),
                'sindicato' => parent::marcarSelecao($r['rs']["sindicato"]),
                'sindicatos_secundario' => parent::marcarSelecao($r['rs']["sindicatos_secundario"]),
                'normal' => parent::marcarSelecao($r['rs']["normal"]),
                'aposentadoria' => parent::marcarSelecao($r['rs']["aposentadoria"]),
                'gps' => parent::marcarSelecao($r['rs']["gps"]),
                'cargo' => parent::marcarSelecao($r['rs']["cargo"]),
                'indice_adian_aut_cons' => parent::marcarSelecao($r['rs']["indice_adian_aut_cons"])
            ];
           // var_dump($selecoes['caged_tp_emprego']);exit;
            $r = array_merge($r, $selecoes);
        endif;
        return $r;
    }

    public function finalizar()
    {
        $this->sqlTabela = 'finalizacao';
        $this->sqlId["coluna"] = 'id_pessoa';
        return parent::editarRegistro();
    }

    public function integrar()
    {
        $this->sqlTabela = 'finalizacao';
        $this->sqlId["coluna"] = 'id_pessoa';
        return parent::editarRegistro();
    }

    public function dependente()
    {
        $this->sqlTabela = 'depedentes';
        $this->sqlId["coluna"] = 'id_pessoa';
        $r = parent::editarRegistro();
        if (!empty($r['rs'])):
            $selecoes = [
                'ligacao' => parent::marcarSelecao($r['rs']["depe_liga"]),
                'situacao' => parent::marcarSelecao($r['rs']["depe_situacao"]),
                'ligacao_gov' => parent::marcarSelecao($r['rs']["depe_ef_gov"]),
                'est_civil' => parent::marcarSelecao($r['rs']["depe_estado"]),
                'sexo' => parent::marcarSelecao($r['rs']["depe_sexo"]),
                'uf' => parent::marcarSelecao($r['rs']["depe_estado"]),
                'auto_freq' => parent::marcarSelecao($r['rs']["depe_auto_salario"]),
                'salario' => parent::marcarSelecao($r['rs']["depe_vac_freq"]),
                'ir' => parent::marcarSelecao($r['rs']["depe_auto_ir"])
            ];
            //var_dump($selecoes);exit;
            $r = array_merge($r, $selecoes);
        endif;
        return $r;
    }


    /**
     * Realiza a busca por uma palavra na tabela
     *
     * @return array armazena os dados da consulta
     */
    public function busca()
    {
        return null; #parent::buscarRegistro();
    }

    /**
     * Executa o processamento de um formulário para inserção ou atualização de dados
     */
    public function salvar()
    {
        $this->sqlTabela = $this->mvcFormulario["tb"];
        unset($this->mvcFormulario["tb"]);
        $pessoa = $this->mvcFormulario["id"];
        unset($this->mvcFormulario['arquivo']);
        $r = !empty($this->mvcFormulario[$this->sqlId["coluna"]]) ?
            $r = parent::atualizarDados() : parent::inserirDados();
        $pessoaId = empty($pessoa) ? $this->sqlUltimoId: $pessoa;

        if(!empty($_FILES)):
            self::envioArquivo($pessoaId);
        endif;

        self::definirEtapas($r,$pessoaId);


    }

    private function envioArquivo($id)
    {
        $r = parent::uploadArquivo($id,$this->sqlTabela);
        if($r==false):
            $this->mvcAviso = 30;
        endif;
    }

    public function definirEtapas($statusAtual,$pessoa)
    {
        $acaoAtual = [
            'dados_pessoais' => 'cadastro',
            'documentos' => 'documentos',
            'informacoes' => 'complementar',
            'finalizacao' => 'finalizar',
            'depedentes' => 'depedentes'
        ];
        $acaoProxima = [
            'dados_pessoais' => 'documentos',
            'documentos' => 'complementar',
            'informacoes' => 'dependente',
            'finalizacao' => 'integrar',
            'depedentes' => 'finalizar'
        ];

        if ($statusAtual == true):
            $this->mvcAvisos = 1;
            $url = $acaoProxima[$this->sqlTabela] . '/' . base64_encode($pessoa);
        else:
            $this->mvcAvisos = $this->sqlErro;
            $url = $acaoAtual[$this->sqlTabela] . '/' . base64_encode($pessoa);
        endif;

        self::novaRota('formulario/' . $url);
    }


    public function carregarDados()
    {
        $rAcao = $this->carregarAcao();
        return self::$rAcao();
    }


    public function verificarRestricao()
    {
        return false;
    }

    public function definirVisao()
    {
        return $this->carregarVisao();
    }


}


<?php

namespace Modelo;

use PDOException;

/**
 * Class ManipularDados
 *
 * Executa operações que manipulam dados no Banco de Dados.
 * Realiza operações básicas de inserir, atualizar, deletar e selecionar dados.
 * Realiza consultas rotineiras como selecionar registro por ID, selecionar todos dados de uma tabela e selecionr dados com filtro simples
 * Para realizar consulta SQL complexas ou com Join utilize o método selecionaDados() passando a instrução Sql
 * Classe abstrata. Execução apenas para base de classes Modelo
 * Controle de erros executado apenas em inserirDados, atualizarDados e apagarDador. Para outros executar nas regras de negócio do modelo
 *
 * @package Modelo
 */
abstract class ManipularDados extends PrepararDados
{
    /**
     * @var string armazena as colunas para serem utilizados em instrução SQL após o SELECT
     */
    public $sqlColunasSelecionadas;
    /**
     * @var string armazena as colunas para serem utilizados em instrução SQL para consulta, atualizaçã e inserção
     */
    public $sqlColunas;
    /**
     * @var array armazena os valores das colunas para inserção ou atualização de dados
     */
    public $sqlValores;
    /**
     * @var string armazena o nome da tabela utilizada no modelo
     */
    public $sqlTabela;
    /**
     * @var array  armazena o nome da coluna e o valor utilizada para ordenação Ex: array('nome_da_coluna','DESC')
     */
    public $sqlOrdenacao;
    /**
     * @var array  armazena os operadoresp ara consulta com filtros
     */
    public $sqlOperadores;
    /**
     * @var string armazena parametros para consulta com filtros
     */
    public $sqlParametros;
    /**
     * @var int armanezar o ID da última inserção no banco de dados
     */
    public $sqlUltimoId;
    /**
     * @var string armazena a mensagem de erro duurante a execusão de uma instrução SQL
     */
    public $sqlErro;

    /**
     * @var int armazena a quantidade de registro de uma consulta
     */
    public $sqlTotalRegistro;
    /**
     * @var array armazena o nome da coluna ID/Primary de uma tabela e seu respectivo valor | Ex array(coluna => nome_da_coluna,valor => valor)
     */
    public $sqlId = array('coluna' => '', 'valor' => '');/**/
    /**
     * @var
     */
    public $servidorConexao;
    private $servidorTipo = "mysql";
    private $servidorLocal = "localhost";
    private $servidorPorta = "3306";
    private $servidorUsuario = "root";
    private $servidorSenha = "root";
    private $servidorBanco = "dk.gafor-formrh";


    /**
     * Executa a conexão com o Banco de Dados
     *
     * @return \PDO armazena conexão PDO
     */
    private function abrirConexao()
    {
        try {
            $this->servidorConexao = new \PDO(
                $this->servidorTipo . ":host="
                . $this->servidorLocal . ";port=" . $this->servidorPorta
                . ";dbname=" . $this->servidorBanco, $this->servidorUsuario,
                $this->servidorSenha
            );
            $this->servidorConexao->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        } catch (PDOException $i) {
            $this->sqlErro = $i->getMessage();
        }
        $this->servidorConexao->exec("set names utf8");

        return $this->servidorConexao;
    }

    /**
     * Fecha a conexão com o Banco de Dados
     */
    private function fecharConexao()
    {
        unset($this->servidorConexao);
    }


    /**
     * Executa uma instrução SQL no Banco de Dados
     *
     * @param $sql string armazena a instrução Sql
     *
     * @return array armazena resultado da consulta
     */
    public function selecionarDados($sql)
    {
        $conexao = self::abrirConexao();
        $rs = $conexao->query($sql);
        $this->sqlUltimoId = $conexao->lastInsertId();
        $this->sqlTotalRegistro = $rs->columnCount();
        self::fecharConexao();
        return $rs->fetchAll();
    }


    /**
     * Executa uma consulta no Banco de Dados recuperando todos os registro de uma tabela
     *
     * @return array armazena resultados da consulta
     */
    public function selecionarTodosDados()
    {
        $this->sqlColunasSelecionadas = empty($this->sqlColunasSelecionadas)
            ? '*' : $this->sqlColunasSelecionadas;
        $conexao = self::abrirConexao();
        $rs = $conexao->query(
            "SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} "
        );
        self::fecharConexao();

        return $rs->fetchAll();
    }

    /**
     * Realiza a busca no Banco de Dados de determinado valor
     **
     *
     * @return array
     * @property string|array $sqlValores
     * @property string       $sqlTabela
     * @property string|array $sqlColunas
     */
    public function buscarDados()
    {
        $this->sqlColunasSelecionadas = empty($this->sqlColunasSelecionadas)
            ? '*' : $this->sqlColunasSelecionadas;
        $buscaPalavra = "%$this->sqlValores%";
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            "SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} WHERE {$this->sqlColunas} LIKE :busca"
        );
        $rs->bindParam(":busca", $buscaPalavra);
        $rs->execute();
        self::fecharConexao();

        return $rs->fetchAll();
    }

    /**
     * Executa uma consulta no Banco de Dados em busca de um registro pelo ID/Primary
     *
     * @return array armazena resultados das consultas
     * @property array $sqlId
     */
    public function selecionarDadosFiltroId()
    {
        $this->sqlColunasSelecionadas = empty($this->sqlColunasSelecionadas)
            ? '*' : $this->sqlColunasSelecionadas;
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            "SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} WHERE {$this->sqlId['coluna']} = :id LIMIT 1"
        );
        $rs->bindParam(":id", $this->sqlId['valor'], \PDO::PARAM_INT);
        $rs->execute();
        self::fecharConexao();
        $r = $rs->fetch();
        return $r;
    }

    /**
     *  Seleciona dados em uma tabela e mostra os resultados
     *
     * @return array armazenar dados da consulta | array(rs=>recordset, paginacao=>paginacao, total=>total_de_paginas)
     * @property int    $paginacaoQuantidade
     * @property string $paginacaoPagina
     * @property array  $sqlColunas
     * @property array  $sqlOrdenacao
     */
    public function selecionarDadosPaginado()
    {
        $this->sqlColunasSelecionadas = empty($this->sqlColunasSelecionadas)
            ? '*' : $this->sqlColunasSelecionadas;
        $this->sqlOrdenacao = empty($this->sqlOrdenacao)
            ? null
            : 'ORDER BY ' . $this->sqlOrdenacao[0] . ' '
            . $this->sqlOrdenacao[1] . ' ';
        $this->paginacaoSql = empty($this->paginacaoSql)
            ? "SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} "
            : $this->paginacaoSql;

        return array(
            'rs' => self::consultaDadosPaginado(),
            'paginacao' => parent::gerarPaginacao(),
            'total' => $this->paginaQuantidadeRegistro
        );
    }


    /** Executa e prepara a instrução SQL para consulta
     *
     * @return array com resultado da consulta
     */
    private function consultaDadosPaginado()
    {
        if (preg_match("#-#", $this->paginacaoPagina) == 1
            || !empty($this->paginacaoPagina)
        ) {
            $Paginas = explode("-", $this->paginacaoPagina);

            $this->paginacaoTotal = ceil(
                ($Paginas[1] * $this->paginacaoQuantidade)
                / $this->paginacaoQuantidade
            );
            $this->paginacaoLimite = ($Paginas[0] - 1)
                * $this->paginacaoQuantidade;

            $rs = self::selecionarDados(
                "{$this->paginacaoSql}{$this->sqlOrdenacao} LIMIT {$this->paginacaoLimite},{$this->paginacaoQuantidade}"
            );

            $this->paginaQuantidadeRegistro = array(
                ($this->paginacaoLimite + 1),
                ($Paginas[0] * $this->paginacaoQuantidade),
                ($Paginas[1] * $this->paginacaoQuantidade)
            );
        } else {
            $Quantidade = self::consultarQuantidadeDados($this->sqlTabela);

            $this->paginaQuantidadeRegistro = array(
                1,
                $this->paginacaoQuantidade,
                $Quantidade
            );

            if ($Quantidade > 0) {
                $this->paginacaoTotalRegistro = $Quantidade;
                if ($this->paginacaoTotalRegistro > 0) {
                    $this->paginacaoTotal = ceil(
                        $this->paginacaoTotalRegistro
                        / $this->paginacaoQuantidade
                    );
                    $this->paginacaoLimite = 0;
                    $rs = self::selecionarDados(
                        "{$this->paginacaoSql} {$this->sqlOrdenacao} LIMIT {$this->paginacaoLimite},{$this->paginacaoQuantidade}"
                    );
                }
            } else {
                $rs = self::selecionarDados($this->paginacaoSql);
            }
        }
        return $rs;
    }


    /**
     * Executa a contagem de registros em uma determinada tabela
     *
     * @param string $tabela armazena o nome da tabela
     *
     * @return int armazena a quantidade de registro das colunas
     */
    public function consultarQuantidadeDados($tabela)
    {
        $conexao = self::abrirConexao();
        $rs = $conexao->query("SELECT COUNT(*) as quantidade FROM {$tabela}");
        self::fecharConexao();
        $r = $rs->fetch();

        return intval($r["quantidade"]);
    }

    /**
     * Executa a verificação da existência de um dado no banco
     *
     * @return int armazena a quantidade de registro das colunas
     */
    public function verificarExistenciaDados()
    {
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            "SELECT * FROM {$this->sqlTabela} WHERE {$this->sqlColunas} = :valor LIMIT 1"
        );
        $rs->bindParam(":valor", $this->sqlValores, \PDO::PARAM_INT);
        $rs->execute();
        self::fecharConexao();

        return $rs;
    }


    /**
     * Executa consulta em Banco de Dados aplicando restrições ou condições
     *
     * @return array
     * @property string|array $sqlValores
     * @property string|array $sqlColunas
     * @property null|int     $sqlTotalRegistro
     * @property string       $sqlOperadores
     */
    public function selecionarDadosFiltrado()
    {
        $this->sqlColunasSelecionadas = empty($this->sqlColunasSelecionadas)
            ? '*' : $this->sqlColunasSelecionadas;
        $prepararFiltro = self::selecionarDadosFiltragem();
        $this->sqlTotalRegistro
            = empty($this->sqlTotalRegistro) ? false
            : "LIMIT $this->sqlTotalRegistro";
        //var_dump("SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} WHERE {$prepararFiltro[0]} {$this->sqlTotalRegistro}");exit;
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            "SELECT {$this->sqlColunasSelecionadas} FROM {$this->sqlTabela} WHERE {$prepararFiltro[0]} {$this->sqlTotalRegistro}"
        );
        $rs->execute($prepararFiltro[1]);
        //var_dump($rs->debugDumpParams());exit;
        self::fecharConexao();
        return $rs->fetchAll();
    }


    /**
     * Prepara as restrições ou condiçoes para serem utilizadas pelo método selecionarDadosFiltrado
     *
     * @return array armazena dados preparados com restrições
     */
    private function selecionarDadosFiltragem()
    {
        if (is_array($this->sqlColunas)) {
            $totalColunas = count($this->sqlColunas);

            for ($x = 0; $x < $totalColunas; $x++) {
                /** @var array $sqlFiltroPDO armazena operadores de condições para uso no WHERE formato PDO */
                /** @var array $sqlParametrosPDO armazena operadores lógicos para uso no WHERE formato PDO */
                $sqlFiltroPDO[$x]
                    = "{$this->sqlColunas[$x]} {$this->sqlOperadores[0][$x]} :{$this->sqlColunas[$x]}";
            }
            $sqlParametrosPDO = array_combine(
                $this->sqlColunas,
                $this->sqlValores
            );
            /** @var array $sqlFiltroPDO */
            $sqlFiltroPDO = implode(
                ' ' . $this->sqlOperadores[1] . ' ',
                $sqlFiltroPDO
            );
        } else {
            $prepararColunas = $this->sqlColunas;
            $prepararValores = $this->sqlValores;
            $prepararOperadores = $this->sqlOperadores[0];
            $sqlParametrosPDO = array(
                ":" . $prepararColunas => $prepararValores
            );
            $sqlFiltroPDO
                = "{$prepararColunas} {$prepararOperadores} :{$prepararColunas}";
        }
        return array($sqlFiltroPDO, $sqlParametrosPDO);
    }

    /**
     * Executa a atualização de dados em uma tabela
     *
     * Quando um formulários é submetido é identificado as colunas e oos valores para atualização
     *
     * @return bool resultado boleano da atualização
     * @property array $mvcFormulario
     */
    public function atualizarDados()
    {
        $this->sqlColunas = array_keys($this->mvcFormulario);
        $totalColunas = count($this->sqlColunas);
        for ($x = 0; $x <= $totalColunas - 1; $x++) {
            $sqlDadosColunasPDO[] = ":" . $this->sqlColunas[$x];
            $sqlDadosValoresPDO[]
                = $this->mvcFormulario[$this->sqlColunas[$x]];
            $sqlColunasPDO[] = $this->sqlColunas[$x] . " = :"
                . $this->sqlColunas[$x];
        }
        unset($sqlColunasPDO[$totalColunas - 1]);
        $sqlColunasPDO = implode(", ", $sqlColunasPDO);
        try {
            $conexao = self::abrirConexao();
            $rs = $conexao->prepare(
                sprintf(
                /** @lang PDO */
                    "UPDATE %s SET %s  WHERE %s = :%s ",
                    $this->sqlTabela,
                    $sqlColunasPDO,
                    $this->sqlId["coluna"],
                    $this->sqlId["coluna"]
                )
            );
            /** @var array $sqlDadosColunasPDO armazena os nomes dos campos da tabela */
            /** @var array $sqlDadosValoresPDO armazena os valores dos campos da tabela para PDO */
            $rs->execute(
                array_combine(
                    $sqlDadosColunasPDO,
                    $sqlDadosValoresPDO
                )
            );
            $r = true;
        } catch (PDOException $e) {
            $this->sqlErro = $e->getMessage();
            return false;
        }

        //var_dump($rs->debugDumpParams());exit;
        unset($this->mvcFormulario);
        unset($this->sqlParametros);
        unset($this->sqlColunas);
        self::fecharConexao();
        return $r;
    }

    /**
     * Executa a inserção de dados em uma tabela
     * Quando um formulário é submetido, é identificado as colunas e seus respectivos valores
     *
     * @return bool para o sucessso
     * @property array $mvcFormulario
     */
    public function inserirDados()
    {
        $this->sqlColunas = array_keys($this->mvcFormulario);
        $totalColunas = count($this->sqlColunas);
        for ($x = 0; $x <= $totalColunas - 1; $x++) {
            $sqlDadosColunasPDO[] = ":" . $this->sqlColunas[$x];
            $sqlDadosValoresPDO[]
                = $this->mvcFormulario[$this->sqlColunas[$x]];
        }
        $sqlColunasPDO = implode(", ", $this->sqlColunas);
        $sqlValoresPDO = implode(", ", $sqlDadosColunasPDO);

        $conexao = self::abrirConexao();
        try {
            $rs = $conexao->prepare(
                sprintf(
                    "INSERT INTO %s (%s) VALUES (%s)",
                    $this->sqlTabela,
                    $sqlColunasPDO,
                    $sqlValoresPDO
                )
            );
            /** @var array $sqlDadosColunasPDO armazena os nomes dos campos da tabela */
            /** @var array $sqlDadosValoresPDO armazena os valores dos campos da tabela para PDO */
            $rs->execute(
                array_combine(
                    $sqlDadosColunasPDO,
                    $sqlDadosValoresPDO
                )
            );
            //var_dump($rs->debugDumpParams());exit;
            $r = true;
            $this->sqlUltimoId = $conexao->lastInsertId();
        } catch (PDOException $e) {
            $this->sqlErro = $e->getMessage();
            $r = false;
        }
        unset($this->mvcFormulario);
        unset($this->sqlParametros);
        unset($this->sqlColunas);
        self::fecharConexao();
        return $r;
    }

    public function inserirDadosDireto()
    {
        $dados = $this->sqlValores;
        for ($x = 0; $x <= count($dados)-1; $x++) {
            $dadosColunas[] = ":" . $this->sqlColunas[$x];
        }
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            sprintf(
                "INSERT INTO $this->sqlTabela (%s) VALUES (%s)",
                implode(', ', $this->sqlColunas),
                implode(', ', $dadosColunas)
            )
        );
        $rs->execute(array_combine($this->sqlColunas,$this->sqlValores));
        //var_dump($rs->debugDumpParams());exit;
        self::fecharConexao();
        return $rs;


    }

    /**
     * Executa a exclusão de um registro no Banco de Dados
     */
    public function apagarDados()
    {
        $conexao = self::abrirConexao();
        $rs = $conexao->prepare(
            "DELETE FROM  {$this->sqlTabela} WHERE {$this->sqlId["coluna"]} = :id LIMIT 1"
        );
        $rs->bindParam(":id", $this->sqlId["valor"]);
        $rs->execute();
        $this->sqlErro = $conexao->errorInfo();
        self::fecharConexao();
        /**
         * self::selecionarDados("OPTIMIZE TABLE  $this->sqlTabela")
         */
    }


}

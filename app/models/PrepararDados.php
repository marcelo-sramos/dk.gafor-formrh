<?php

namespace Modelo;

/**
 * Class PrepararDados
 *
 * Executa operações adicionais para a classe ManipularDados
 * Executa a paginação
 *
 * @package Modelo
 */
class PrepararDados
{
    /**
     * @var string armazena a página atual ou a requisitada
     */
    public $paginacaoPagina;
    /**
     * @var int armazena a quantidade de registros por página
     */
    public $paginacaoQuantidade;
    /**
     * @var int armaezena o número total de páginas
     */
    public $paginacaoTotal;
    /**
     * @var int armazena o número total de registros a ser paginado
     */
    public $paginacaoTotalRegistro;
    /**
     * @var int armazena o número total de registros na tabela
     */
    public $paginaQuantidadeRegistro;
    /**
     * @var string armazena a instrução SQL
     */
    public $paginacaoSql;
    /**
     * @var int armezena o registro inicial
     */
    public $paginacaoLimite;

    /**
     * Gera lista com as páginas e array com informações da paginação
     *
     * @return array com lista em HTML preparada para Bootstrap
     */
    public function gerarPaginacao()
    {
        $paginaAtual = explode("-", $this->paginacaoPagina);
        $paginaAtual = $paginaAtual[0];
        $paginacaoMaxima = $this->paginacaoTotal > 10 ? 10
            : $this->paginacaoTotal;


        if ($this->paginacaoTotal > 1) {
            if ($paginaAtual > 1
                && !empty($paginaAtual)
            ) { //
                $paginacaoNumeracao[] = array(
                    'pagina/1-' . $this->paginacaoTotal,
                    'Primeira ...'
                );
                $paginacaoNumeracao[] = array(
                    'pagina/' . ($paginaAtual - 1) . "-"
                    . $this->paginacaoTotal,
                    ':Anterior'
                );
                $paginacaoNumeracao[] = array('#', $paginaAtual, 'active');
            } else {
                $paginacaoNumeracao[] = array('#', 1, 'active');
                $paginaAtual = 0;
            }


            for ($paginas = 1; $paginas <= $paginacaoMaxima; $paginas++) {
                if (($paginaAtual + $paginas) < $this->paginacaoTotal
                    XOR ($paginaAtual + $paginas) == 1
                ) {
                    $paginacaoNumeracao[] = array(
                        'pagina/' . ($paginaAtual + $paginas) . "-"
                        . $this->paginacaoTotal,
                        ($paginaAtual + $paginas)
                    );
                }
            }

            if ($paginaAtual
                < $this->paginacaoTotal
            ) {
                empty($paginaAtual) ? $paginaProxima = 2
                    : $paginaProxima = $paginaAtual + 1;
                $paginacaoNumeracao[] = array(
                    'pagina/' . $paginaProxima . "-" . $this->paginacaoTotal,
                    'Próxima'
                );
                $paginacaoNumeracao[] = array(
                    'pagina/' . $this->paginacaoTotal . "-"
                    . $this->paginacaoTotal,
                    'Última - ' . $this->paginacaoTotal
                );
            }
        }
        if ($this->paginaQuantidadeRegistro[2] > 0) {
            $this->paginaQuantidadeRegistro = $this->paginacaoQuantidade
            < $this->paginaQuantidadeRegistro[2]
                ? 'Mostrando de '
                . $this->paginaQuantidadeRegistro[0] . ' até '
                . $this->paginaQuantidadeRegistro[1] . ', de um total de '
                . $this->paginaQuantidadeRegistro[2]
                : 'Mostrando os ' . $this->paginaQuantidadeRegistro[2]
                . ' registros';
        } else {
            $this->paginaQuantidadeRegistro = null;
        }
        return $paginacaoNumeracao;
    }

    public function marcarSelecao($r)
    {
        return [$r => "selected='selected'"];
    }


}


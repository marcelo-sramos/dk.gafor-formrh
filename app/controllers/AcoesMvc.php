<?php

namespace Controle;


use Modelo\Rota;

/**
 * Trait AcoesMvc
 *
 * Executa as funções básicas para funcionamento da aplicação
 *
 * @package Controle
 */
trait AcoesMvc
{
    /**
     * Define a ação/métodos a ser executado no Controle
     *
     * @return string armazena o nome da ação/ método a ser executado no Controle
     */
    public function carregarAcao()
    {
        if (empty($this->mvcMetodo) OR in_array(
                $this->mvcMetodo,
                $this->mvcAcoes
            )
        ):
            $r = in_array($this->mvcMetodo, $this->mvcAcoes) ? $this->mvcMetodo
                : $this->mvcAcoes['padrao'];
        else:
            $this->mvcAvisos = 10;
            return 'listar';
        endif;
        return $r;
    }

    /**
     * Define o nome do arquivo de template
     *
     * @return string armazena o nome do arquivos templete para visão
     */
    public function carregarVisao()
    {
        if (!empty($this->mvcMetodo)) :
            $r = in_array($this->mvcMetodo, $this->mvcAcoes['visao'])
                ? $this->mvcMetodo
                : $this->mvcAcoes['visao'][0];
        else:
            $r = $this->mvcAcoes['padrao'];
        endif;
        return strtolower($this->mvcNome) . '_' . $r . '.tpl';
    }

    public function novaRota($url,$tipo=null)
    {

        $novaRota = new \Modelo\Rota();

        $novaRota->rotaRedirecionamento = [
            'mensagem' => $this->mvcAvisos,
            'url' => $url,
            'tipo' => $tipo
        ];
        $novaRota->redirecionarRota();
    }
}
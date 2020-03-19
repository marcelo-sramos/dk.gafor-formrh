<?php


namespace Controle;


/**
 * Interface mvc
 * Implementação das funções básicas para funcionamento do Padrão InterfaceMvc
 *
 * @package Controle
 */
interface InterfaceMvc
{

    /**
     * Carrega o método e parametros para o controle e modelo
     */
    public function __construct($metodo, $parametros, $formulario);

    /**
     * Aplica restrições básicas para iniciar um método
     *
     * @return null|array com as configurações da restrição
     */
    public function verificarRestricao();

    /**
     * Define o método do controle a ser executado
     *
     * @return string armazena o nome do método do controle
     */
    public function carregarAcao();

    /**
     * Executa as requisições para processamento dos dados
     *
     * @return array armazena array com todos os dados para a visualização
     */
    public function carregarDados();

    /**
     * Define o arquivo de template a ser usado para a requisição
     *
     * @return string como o nome do arquivo do template
     */
    public function definirVisao();
}
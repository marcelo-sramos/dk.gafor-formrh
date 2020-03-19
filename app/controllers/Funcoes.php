<?php


namespace Controle;

use \Modelo\Funcoes as FuncoesModelo;
use Modelo\Rota;


/**
 * Class Funcoes
 *
 * Controla a requisição de dados e a requisição de visualizações
 * Gerencia os templates e requisita as operaçoes ao modelo
 *
 * @package Controle
 */

class Funcoes extends FuncoesModelo
{

    /**
     * Funcoes constructor.
     *
     * Carrega os configurações básicas para funcionamento
     *
     * @param string $metodo     armazena o nome do método
     * @param array  $parametros armazena dados e valores passados pela  rota
     * @param array  $formulario armazena dados de uma formulário submetido
     */

    use AcoesMvc;

    public function __construct($metodo, $parametros, $formulario)
    {
        $this->mvcMetodo = $metodo;
        $this->mvcParametro = $parametros;
        $this->mvcFormulario = $formulario;
        $this->mvcAcoes = [
            'padrao' => 'listar',
            'visao' => array('excluir', 'exibir'),
            'excluir',
            'salvar',
            'destruir'
        ];
        $this->mvcNome = 'funcoes';
    }

    public function excluir() {


        $r = $this->prepararExclusao();
        $rUrl = 'gestor/'.$r[2];
        self::validarRota($r[0], $r[1],$rUrl);
        return $r;
    }

    public function destruir() {
        $rUrl= 'gestor/'.$this->mvcFormulario["modelo"].'/listar/';
        $r = $this->destruirDados();

        self::validarRota(false, $r[1],$rUrl);

        return $r;
    }



    public function carregarDados()
    {
        $rAcao = $this->carregarAcao();
        return self::$rAcao();
    }

    /**
     * Valida o resultado de um método e gera uma nova rota
     *
     * @param bool|string $dados    armazena o resultado de um metodo
     * @param int         $mensagem código da mensagem para ser visualizada
     */
    public function validarRota($dados, $mensagem, $url)
    {
        if ($dados == false) {
            $rota = new Rota();
            $rota->rotaRedirecionamento = [
                'mensagem' => $mensagem,
                'url' => $url
            ];
            $rota->redirecionarRota();
        }
    }




}

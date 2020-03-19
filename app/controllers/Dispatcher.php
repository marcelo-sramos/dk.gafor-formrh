<?php

namespace Controle;

use Modelo\Rota;


/**
 * Class Dispatcher
 *
 * @package Controle
 */
class Dispatcher extends Rota
{
    /**
     * @var string armazena o nome do controlador
     */
    public $camadaControle;
    /**
     * @var string armazena o nome do modelo
     */
    public $camadaModelo;
    /**
     * @var string armazena o nome da visão
     */
    public $camadaVisao;
    /**
     * @var array armazena os dados processados a ser enviado a visão
     */
    public $appDados;
    /**
     * @var string armazena o método que será executado no controle/modelo
     */
    public $appAcao;
    /**
     * @var string armazena o nome do arquivo de template
     */
    public $appTemplate;
    /**
     * @var string armazena o nome da paste de templates do modelos
     */
    private $appDiretorioTemplate;
    /**
     * @var array armazena a url completa
     */
    public $appRota;
    /**
     * @var string|array armazena erro do app
     */
    public $appAvisos;
    /**
     * @var array armazena GET ou POST de nome ajax para ativar a função ajax
     */
    public $appAjax;
    /**
     * @var array armazena dados para serem enviado por ajax no formato json
     */
    public $appAjaxDados;
    /**
     * @var array armazena dados da url
     */
    public $valoresUrl;
    /**
     * @var array armazena dados de um formulário submetido
     */
    public $valoresPost;

    /**
     * Dispatcher constructor.
     *
     * Executa o tratamento da rota
     */
    public function __construct()
    {
        $this->appRota = explode(
            "/",
            str_replace(
                strrchr($_SERVER["REQUEST_URI"], "?"),
                "",
                $_SERVER["REQUEST_URI"]
            )
        );
    }

    /**
     *Executa o início do app
     */
    public function iniciarApp()
    {
        $this->camadaControle = ucfirst($this->appRota[1]);
        $this->camadaModelo = ucfirst($this->appRota[1]);
        $this->camadaVisao = $this->appRota[1];
        $this->appAcao = $this->appRota[2];
        $this->valoresUrl = array(
            $this->appRota[3],
            $this->appRota[4],
            $this->appRota[5]
        );
        $this->valoresPost = empty($_POST) ? false : $_POST;
        $this->appDados[] = array(
            strtolower($this->camadaControle . '_' . $this->appAcao),
            'rota-ativa'
        );

        $app = self::carregarApp();
        $this->rotaRequisitos = $app->verificarRestricao();
        if (!empty($this->rotaRequisitos)) {
            parent::validarRota();
        }
        $this->appAjax = self::verificarRequisicaoAjax();
        if ($this->appAjax) {
            $this->appAjaxDados = $app->carregarAjaxDados();
        } else {
            $this->appDados[] = array('dados', $app->carregarDados());
            $this->appAvisos = $app->mvcAvisos;
            parent::verificarAvisosApp();
            $this->appTemplate = $app->definirVisao();
            $this->appDiretorioTemplate = strtolower($this->camadaControle);
        }
    }

    /**
     *  Executa a instância do controlador
     *
     * @return Index|Login|Formulario
     */
    public function carregarApp()
    {
        $mvcAtivos = [
            'Formulario',
            'Login'
        ];
        $mvcRequisitado = in_array($this->camadaControle, $mvcAtivos)
            ? $this->camadaControle : 'Index';
        $mvcRequisitado = '\Controle\\' . $mvcRequisitado;
        $app = new $mvcRequisitado(
            $this->appAcao, $this->valoresUrl,
            $this->valoresPost
        );


        return $app;
    }

    /**
     * Executa a renderização da visão
     *
     * @throws \SmartyException
     */
    public function renderizarApp()
    {
        $visaoTemplate = new \SmartyBC();
        $visaoTemplate->compile_check = true;
        $visaoTemplate->template_dir = 'app/views/'
            . $this->appDiretorioTemplate;
        $visaoTemplate->compile_dir = 'app/views/templates_c/'
            . $this->appDiretorioTemplate;
        $visaoTemplate->cache_dir = 'app/views/configs';
        //$visaoTemplate->debugging = true;
        if (!empty($this->appDados)) {
            for ($i = 0; $i <= count($this->appDados); $i++) {
                $visaoTemplate->assign(
                    $this->appDados[$i][0],
                    $this->appDados[$i][1]
                );
            }
        }
        $visaoTemplate->display($this->appTemplate);
    }

    /**
     * Verifica a existência de uma requisção ajax
     *
     * @return bool
     */
    public function verificarRequisicaoAjax()
    {
        return $_GET["ajax"] == true ? true : false;
    }

    /**
     * executa o tratamento dos dados para formato Json
     */
    public function requisitarAjax()
    {
        echo $this->appAjaxDados;
    }


}


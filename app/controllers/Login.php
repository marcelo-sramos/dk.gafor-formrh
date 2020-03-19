<?php

namespace Controle;

use \Modelo\Login as ModeloLogin;
use Modelo\Rota;

class Login extends ModeloLogin
{


    use AcoesMvc;

    public function __construct($metodo, $parametros, $formulario)
    {
        $this->mvcMetodo = $metodo;
        $this->mvcParametro = $parametros;
        $this->mvcFormulario = $formulario;
        $this->sqlTabela = 'usuarios';
        $this->sqlId['coluna'] = 'id';
        $this->mvcNome = 'Login';
        $this->mvcAcoes = [
            'padrao' => 'login',
            'visao' => 'login',
            'logar',
            'logout',
            'salvar'
        ];
    }

    public function logar() {
        $r = parent::logarUsuario();
        $rMensagem = $r == true ? 6: 7;
        $rUrl =  $r == true ? 'gestor/paginas': 'login';
        self::validarRota(false,$rMensagem,$rUrl);
        exit;
    }

    public function logout() {
        parent::logoutUsuario();
        self::validarRota(false, '', '');
        exit;
    }

    public function login()
    {
        return false;
    }

    /**
     * Executa o processamento de um formulário para inserção ou atualização de dados
     */
    public function salvar()
    {
        return !empty($this->mvcFormulario[$this->sqlId["coluna"]])
            ? parent::atualizarDados() : parent::inserirDados();
    }

    # -----------------------------Implementação dos métodos obrigatórios-----------------------------


    public function carregarDados()
    {
        $rAcao = $this->carregarAcao();
        return self::$rAcao();
    }

    public function validarRota($dados,$mensagem,$url=null) {

        if(empty($url)) {
            $url = array(
                "paginas" => 'gestor/paginas/',
                "exibir" => 'paginas/'
            );
            $url = $url[$this->mvcMetodo];
        }

        if($dados == false) {
            $rota = new Rota();
            $rota->rotaRedirecionamento = [
                'mensagem' => $this->appAvisos,
                'url' => strtolower($url),
                'tipo' => 0
            ];
            $rota->redirecionarRota($mensagem, '', $url);
        }
    }

    public function verificarRestricao() {
        return null;
    }

    public function definirVisao()
    {
        return $this->carregarVisao();
    }




}

?>
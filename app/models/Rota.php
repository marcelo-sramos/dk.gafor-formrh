<?php


namespace Modelo;


/**
 * Class Rota
 *
 * Trata as requisições referente as rotas
 * realiza redirecionamento de rotas e visualização de mensagem de feeddback sobre as rotas
 *
 * @package Modelo
 */
class Rota
{
    /**
     * @var array armazena informações necessárias para redirecionamento de rota
     */
    public $rotaRedirecionamento
        = [
            'mensagem' => '',
            'url' => '',
            'tipo' => ''
        ];
    /**
     * @var string armazena parametros para validação de rotas
     */
    public $rotaRequisitos;

    /**
     * Gera uma nova rota com uma mensagem de feedback sobre uma requisição
     */
    public function redirecionarRota()
    {
        self::gerarRetornoRota();
        header("Location:/" . $this->rotaRedirecionamento['url']);
        exit;
    }

    /**
     * Executa tratamento dos requisitos para início da requisição
     */
    public function validarRota()
    {
        $validacaoRequisitos = explode(":", $this->rotaRequisitos[0]);
        $validacaoFuncao = 'validar' . ucfirst($validacaoRequisitos[0]);
        self::$validacaoFuncao($validacaoRequisitos);
    }

    /**
     * Verifica a existência de uma mensagem de feedback para ser mostrada ao usuário
     */
    public function verificarAvisosApp()
    {
        self::analisarAvisosApp();
        self::analisarAvisosRota();
    }

    /**
     * Cria uma Session para armazena uma mensagem de feeedback sobre uma requisição
     */
    public function gerarRetornoRota()
    {
        if (is_numeric($this->rotaRedirecionamento['mensagem'])) {
            $mensagem = [
                '0' => 'Ocorreu um erro inesperado',
                '1' => 'Dados cadastrado com sucesso',
                '3' => 'O recurso ou página não existe mais',
                '4' => 'A página não existe mais',
                '5' => 'Ocorreu um erro! Não foi possível identificar o funcionário. Por favor, não alterer a URL',
                '6' => 'Login efetuado com sucesso',
                '7' => 'Erro no login. E-mail ou senhas incorreto',
                '10' => 'O Item solicitado não existe no Banco de Dados',
                '11' => 'A consistencia dos dados informados está incorreta',
                '15' => 'Ocorreu um erro ao tentar excluir o dado. Por favor, tente novamente',
                '16' => 'A exclusão foi cancelada',
                '17' => 'A exclusão foi efetuada com sucesso',
                '20' => 'Ocorreu um erro A senha é muito curta ou e-mail não válido',
                '30' => 'Ocorreu um erro ao salvar o arquivo. Por favor, tente enviar o arquivo novamente'
            ];
            $r = $mensagem[$this->rotaRedirecionamento['mensagem']];
        } else {
            $r
                = "Ocorreu um erro na aplicação! <br> <code>{$this->rotaRedirecionamento['mensagem']}</code>";
            $this->rotaRedirecionamento['tipo'] = 1;
        }

        session_start();

        $_SESSION['retornoRota'] = array(
            $this->rotaRedirecionamento['tipo'],
            $r
        );
    }


    /**
     * Executa validação de uma estrutura de URL para verificar a consistência
     *
     * Estrutura da array de entrada:
     * url:1:int:false:1:5
     * [1] => localização do valor
     * [2] => Tipo de validação
     * [3] => null
     * [4] => Tipo de mensagem
     * [5] => Mensagem de retorno
     *
     */
    public function validarUrl()
    {
        var_dump('implementar:validar-url');
        exit;
    }

    /**
     * Executa validação de uma estrutura de URL para verificar se o ID existe e se é numérico
     *
     * @param int $ID armazena o ID a ser validado
     *
     * @return bool armazena o resultado da validação
     */
    public function validarId($ID)
    {
        if (!empty($ID[1]) && is_numeric($ID[1])) {
            $r = true;
        } else {
            $this->rotaRequisitos = ['mensagem' => 3, 'url' => '', 'tipo' => 1];
            self::redirecionarRota();
            exit;
        }
        return $r;
    }

    /**
     * Executa validação de campos de uma formulário
     */
    public function validarFormulario()
    {
        var_dump('implemetar:validarFormulario');
        exit;
    }

    /**
     * Executa validação para verificar se existe um login ativo
     *
     * @return bool armazena o resultado da validação
     */
    public function validarLogin()
    {
        session_start();
        if (!isset($_SESSION['login']) && empty($_SESSION['login'])) {
            $this->rotaRedirecionamento = [
                'mensagem' => 5,
                'url' => 'login',
                'tipo' => 1
            ];
            self::redirecionarRota();
            exit;
        } else {

            self::analisarAvisosLogin();
            $r = true;
        }
        return $r;
    }

    private function analisarAvisosLogin()
    {
        session_start();

        if (isset($_SESSION['login'])) {
            $this->appDados[] = array('login', $_SESSION['login']);
        }
    }

    private function analisarAvisosRota()
    {
        session_start();
        if (isset($_SESSION['retornoRota'])) {
            $_SESSION['retornoRotaContagem']++;
            $this->appDados[] = array('retorno', $_SESSION['retornoRota']);
            unset($_SESSION['retornoRota']);
        }
    }

    private function analisarAvisosApp()
    {
        if (!empty($this->appAvisos) AND !is_array($this->appAvisos)):


            if (!empty($this->camadaControle)):
                $url = empty($this->appAcao) ? '' : $this->camadaControle;
            else:
                $url = '';
            endif;
            $this->rotaRedirecionamento = [
                'mensagem' => $this->appAvisos,
                'url' => strtolower($url),
                'tipo' => 0
            ];
            self::redirecionarRota();
        endif;
    }

}
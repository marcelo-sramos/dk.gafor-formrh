<?php

namespace Modelo;

class Login extends ManipularDados
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
    /**
     * @var string armazena o nome do modelo/controle
     */
    public $mvcNome;
    /**
     * @var string armazena mensagens de erros e avisos
     */
    public $mvcAvisos;
    public $Usuario;


    public function __construct($Parametro = null)
    {
        session_start();
        if (!empty($Parametro)) {
            $this->Usuario = $Parametro[2];
            $this->UsuarioSecao = $Parametro[3];
        }
    }


    public function logarUsuario()
    {
        session_start();

        $r = self::verificarSenha(
            $this->mvcFormulario["usuario"],
            $this->mvcFormulario["senha"]
        );

        if ($r === false) {
            $r = false;
        } else {

            $_SESSION['login'] = array(
                $r[0]["id"],
                $r[0]["nome"],
                $r[0]["nivel"]
            );
            $r = true;
        }

        return $r;
    }

    public function logoutUsuario()
    {
        session_start();
        $_SESSION['login'] = null;
        unset($_SESSION['login']);
    }

    protected function verificarSenha($usuario, $senha)
    {
        $this->sqlColunasSelecionadas = 'id, senha, nome, usuario, nivel';
        $this->sqlColunas = ['usuario'];
        $this->sqlValores = [$usuario];
        $this->sqlOperadores = ['='];

        $r = parent::selecionarDadosFiltrado();

        return password_verify($senha, $r[0]['senha']) ? $r : false;
    }


}

?>
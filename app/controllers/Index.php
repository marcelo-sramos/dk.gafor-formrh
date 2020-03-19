<?php

namespace Controle;

use Modelo\ManipularDados;
use Modelo\Index as IndexModelo;


class Index extends IndexModelo
{

    public function __construct($metodo, $parametros, $formulario)
    {
        $this->mvcMetodo = $metodo;
        $this->mvcParametro = $parametros;
        $this->mvcFormulario = $formulario;
    }

    public function carregarDados()
    {

        $r = self::carregarAcao();
        return self::$r();

    }


    public function inicio()
    {
        //$r = parent::listarNoticias();
        return $r;
    }

    public function verificarRestricao() {



    }

    public function carregarAcao()
    {
        $r = 'inicio';

        return $r;


    }

    public function carregarTemplate()
    {
        $r = 'index.tpl';
        return $r;
    }


}

?>
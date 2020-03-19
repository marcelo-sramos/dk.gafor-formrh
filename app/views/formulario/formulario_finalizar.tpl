<!doctype html>
<html lang="pt-br">
<head>
    {include file="head.tpl"}
</head>

<body class="bg-light">
{include file="topo.tpl"}

<div class="container">
        <main role="main">
            <div class="mt-4 pt-4">
                <h1 class="h2 text-center">Declaração para  <b>{$dados.pessoa.nome_completo}</b> </h1>
            </div>
            {include file="../avisos.tpl"}


            <ul id="progressbar" class="text-center justify-content-center">
                <li class="active" id="step1">
                    <div class="d-none d-md-block">Dados pessoais</div>
                </li>
                <li class="active" id="step2">
                    <div class="d-none d-md-block">Documentos</div>
                </li>
                <li class="active" id="step3">
                    <div class="d-none d-md-block">Infomações</div>
                </li>
                <li class="active" id="step4">
                    <div class="d-none d-md-block">Dependentes</div>
                </li>
                <li class="active" id="step5">
                    <div class="d-none d-md-block">Assinaturas</div>
                </li>
                <li class="" id="step6">
                    <div class="d-none d-md-block">Finalização</div>
                </li>
            </ul>
                <h2> Declaração de veracidade das informações</h2>
                <p>
                    Declaro que as informações foram preenchidas e são
                    verdadeiras e autênticas e foram revisadas e conferidas


                </p>
            <form class="needs-validation" action="/formulario/salvar" method="post" novalidate>

                <div class="row ml-4">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                    <label class="form-check-label" for="gridCheck1">
                        Declaro que as informações são autenticas
                    </label>
                </div>
                <div class="row ml-4">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                    <label class="form-check-label" for="gridCheck1">
                        Declaro que as informações foram revisadas
                    </label>
                </div>

                <input type="hidden" name="id" value="{$dados.rs.id}"/>
                <input type="hidden" name="id_pessoa" value="{$dados.pessoa.id}"/>
                <input type="hidden" name="responsavel" value=""/>
                <input type="hidden" name="data" value=""/>
                <input type="hidden" name="tb" value="finalizacao"/>
                <button class="btn btn-primary mt-4" type="submit">Enviar</button>
            </form>

        </main>
</div>

{include file="rodape.tpl"}

<link href="/vendor/snapappointments/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" type="text/css">

<script src="/vendor/snapappointments/bootstrap-select/dist/js/bootstrap-select.js"></script>

<script src="/vendor/snapappointments/bootstrap-select/dist/js/i18n/defaults-pt_BR.js"></script>



<script>
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select-busca').selectpicker();
    })
</script>

</body>
</html>

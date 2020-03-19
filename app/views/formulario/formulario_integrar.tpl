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
                <h1 class="h2 text-center">Cadastro de  <b>{$dados.pessoa.nome_completo}</b> foi concluído</h1>
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
                <li class="active" id="step6">
                    <div class="d-none d-md-block">Finalização</div>
                </li>
            </ul>

            <h1>Integracao </h1>

            <h3>Selecione uma opção</h3>
            <a href="#" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Exportar dados para sistema</a>
            <a href="#" class="btn btn-secondary btn-lg " tabindex="-1" role="button" aria-disabled="true">Gerar string</a>
            <a href="#" class="btn btn-secondary btn-lg " tabindex="-1" role="button" aria-disabled="true">Exportar para Excell</a>




        </main>
</div>

{include file="rodape.tpl"}




</body>
</html>

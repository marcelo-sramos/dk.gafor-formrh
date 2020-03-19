<!doctype html>
<html lang="pt-br">
<head>
    {include file="head.tpl"}
</head>

<body class="bg-light">
{include file="topo.tpl"}

<div class="container">
    <main role="main">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 mt-5 pb-2 mb-3 border-bottom">
            <h1 class="h2"><span class="fa fa-id-card-o"></span> Cadastro de funcionários <span
                        class="badge badge-secondary">{$dados[0][6]}</span></h1>
            <a class="btn btn-success" href="/formulario/cadastro/novo/" role="button"><span class="fa fa-user-plus"></span> Novo cadastro</a>

        </div>

        {include file="../avisos.tpl"}

        {* <div class="alert alert-secondary" role="alert"> {$dados.total} páginas</div> *}

        <table class="table table-hover table-bordered ">


            <thead>
            <tr>
                <th width="70%">Funcionario</th>
                <th>Documentos</th>
                <th>Informações</th>
                <th>Depedentes</th>
                <th>Assinatura</th>
            </tr>
            </thead>
            <tbody>
            {foreach $dados.rs as $r}
                <tr>
                    <td> <a class="text-secondary" href="/formulario/cadastro/{$r.id|base64_encode}" title="Atualizar">{$r.nome_completo}</a></td>

                    <td><i class="text-success fa fa-check-circle"></i></td>
                    <td><i class="text-success fa fa-check-circle"></i></td>
                    <td><i class="text-success fa fa-check-circle"></i></td>
                    <td><i class="text-success fa fa-check-circle"></i></td>

                </tr>
            {/foreach}

            </tbody>

        </table>

        <nav aria-label="Navegação de página exemplo">
            <ul class="pagination justify-content-center">
                {foreach $dados.paginacao as $rs}
                    <li class="page-item {$rs[2]}"><a class="page-link" href="/gestor/pagina/listar/{$rs[0]}">{$rs[1]}</a></li>
                {/foreach}
            </ul>
        </nav>


    </main>
</div>

{include file="rodape.tpl"}

</body>
</html>

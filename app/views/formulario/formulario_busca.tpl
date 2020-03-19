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
            <h1 class="h2"><span class="fa fa-id-card-o"></span> Busca de cadastro<span
                        class="badge badge-secondary">{$dados[0][6]}</span></h1>
        </div>

        {include file="../avisos.tpl"}


        <form class="needs-validation" action="#" method="post" enctype="multipart/form-data"
              novalidate>

            <h2>Busa básica</h2>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">Nome completo:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome_completo">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">CPF:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome_completo">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">E-mail:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome_completo">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary text-right  btn-lg" type="submit">Buscar</button>
            </div>


            <h2>Busca avançada</h2>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">Palavra:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome_completo">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label text-right">Ficha:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="0">Dados cadastrais</option>
                        <option value="1">Documentos</option>
                        <option value="2">Depedentes</option>
                    </select>
                </div>
            </div>


            <div class="d-flex justify-content-end">
                <button class="btn btn-primary text-right  btn-lg" type="submit">Buscar</button>
            </div>
        </form>

    </main>
</div>

{include file="rodape.tpl"}

</body>
</html>

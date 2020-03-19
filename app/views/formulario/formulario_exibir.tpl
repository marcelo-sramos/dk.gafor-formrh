<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>{$dados.titulo} - framework-simplemsr</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{$dados[0].resumo}">
    <meta name="keywords" content="{$dados[0].tags}">

    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link href="/vendor/fortawesome/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="/vendor/twbs/bootstrap/scss/bootstrap-grid.scss" rel="stylesheet" type="text/css">
    <link href="/vendor/twbs/bootstrap/scss/bootstrap-reboot.scss" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Khand&display=swap" rel="stylesheet">
    <link href="/public/css/template.css" rel="stylesheet" type="text/css">


</head>
<body>

{include file="../site_topo.tpl"}

<section class="container">
    <nav aria-label="breadcrumb mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">framework-simplemsr</a></li>
            <li class="breadcrumb-item"><a href="/pagina/todas">Páginas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{$dados.titulo}</li>
        </ol>
    </nav>

    <article>
        <h1 class="mt-4 display-3">{$dados.titulo}</h1>
        {$dados.texto}
    </article>
</section>

{include file="../site_rodape.tpl"}

</body>
</html>
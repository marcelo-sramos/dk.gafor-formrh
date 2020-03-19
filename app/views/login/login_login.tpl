<!doctype html>
<html lang="pt-br">
<head>
    {include file="../gestor/head.tpl"}
</head>

<body>
{include file="../gestor/topo.tpl"}

<div class="container-fluid">
    <div class="row">

        <main role="main" class="container">

            <section class="login text-center mt-5">
                <form action="/login/logar" method="post" name="login"  class="form-signin">
                    <h2 class="">Acesso ao Sistema</h2>
                    <label for="usuario" class="sr-only">Endereço de email</label>
                    <input type="text" id="usuario" name="usuario"  class="form-control mb-3" placeholder="Digite seu e-mail" required autofocus>
                    <label for="senha" class="sr-only">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" placeholder="Digite sua senha" required>
                    <button class="btn btn-lg btn-block btn-dark mt-3" type="submit">Login</button>
                </form>
            </section>


        </main>
    </div>
</div>

{include file="../gestor/rodape.tpl"}

<
{literal}
{/literal}


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
</script>

</body>
</html>

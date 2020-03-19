<!doctype html>
<html lang="pt-br">
<head>
    {include file="head.tpl"}
</head>

<body>
{include file="topo.tpl"}

<div class="container-fluid">
    <div class="row">
        {include file="menu.tpl"}

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edição de páginas</h1>
            </div>

            <form class="needs-validation" action="/gestor/paginas/salvar/" method="post" novalidate>


                <div class="form-group ">
                    <label for="titulo_menor" class="">Título reduzido:</label>
                    <input name="titulo_menor" value="{$dados.rs.titulo_menor}" type="text" class="form-control "
                           id="nome_link" placeholder="Título reduzido" required>
                    <div class="invalid-feedback">
                        Por favor, informe o titulo para ser visualizado nos menus
                    </div>
                </div>

                <div class="form-group">
                    <label for="titulo" class="">Título:</label>
                    <input name="titulo" value="{$dados.rs.titulo}" type="text" class="form-control" id="titulo"
                           placeholder="Título" required>
                    <div class="invalid-feedback">
                        Por favor, informe um título de até 250 caracteres
                    </div>
                </div>

				<div class="form-group">
					<label for="resumo" class="">Descrição/ Resumo:</label>
					<textarea class="form-control " cols="100" rows="3" name="resumo" id="resumo" placeholder="Escreva um pequeno resumo para otimizar a busca e visualização"
							  required>{$dados.rs.resumo}</textarea>
					<div class="invalid-feedback">
						Escreva uma descrição
					</div>
				</div>

                <div class="form-group">
                    <label for="texto" class="">Texto/ Conteúdo da página:</label>
                    <textarea class="form-control editorHtml" cols="100" rows="15" name="texto" id="texto"
                              placeholder="Texto" required>{$dados.rs.texto}</textarea>
                    <div class="invalid-feedback">
                        Escreva o conteúdo da página
                    </div>
                </div>


                <div class="form-group">
                    <label for="data" class="">Data:</label>
                    <input type="text" class="form-control" id="data" placeholder="Data" name="data"
                           value="{$dados.rs.data|default:$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}" required>
                    <div class="invalid-feedback">
                        Por favor, informe uma data.
                    </div>
                </div>

                <div class="form-group">
                    <label for="tags" class="">Tags:</label>
                    <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags"
                           value="{$dados.rs.tags}" required>
                    <div class="invalid-feedback">
                        Digite palavras-chaves separadas por vírgula (,)
                    </div>
                </div>

                <div class="form-group">
                    <label for="secao" class="">Seção:</label>
                    <select class="custom-select" required id="secao" name="secao">
                        {foreach $dados.secoes as $r}
                            <option value="{$r.id}" {$dados.secao_selecionada[$r.id]} >{$r.nome}</option>
                        {/foreach}
                    </select>
                    <div class="invalid-feedback">Por favor, selecione a seção da notícia</div>
                </div>


                <input type="hidden" name="id" value="{$dados.rs.id}"/>
				<button class="btn btn-primary" type="submit">Enviar</button>
            </form>

        </main>
    </div>
</div>

{include file="rodape.tpl"}


<!--Formularios-->
<script src="/vendor/tinymce/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '.editorHtml',
        language: 'pt_BR',
        plugins: "code"
    });
</script>

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

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
                <h1 class="h2 text-center">{if $dados.pessoa.nome neq ''}Cadastro de  <b>{$dados.pessoa.nome_completo}{else}Cadastro novo{/if}</b></h1>
            </div>
            {include file="../avisos.tpl"}
            <ul id="progressbar" class="text-center justify-content-center">
                <li class="active" id="step1">
                    <div class="d-none d-md-block">Dados pessoais</div>
                </li>
                <li class="" id="step2">
                    <div class="d-none d-md-block">Documentos</div>
                </li>
                <li class="" id="step3">
                    <div class="d-none d-md-block">Exames</div>
                </li>
                <li class="" id="step4">
                    <div class="d-none d-md-block">Dependentes</div>
                </li>
                <li class="" id="step5">
                    <div class="d-none d-md-block">Assinaturas</div>
                </li>
                <li class="" id="step6">
                    <div class="d-none d-md-block">Finalização</div>
                </li>
            </ul>

            <form class="needs-validation" action="/formulario/salvar" method="post"  enctype="multipart/form-data"  novalidate>

                {* Nome *}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{$dados.rs.nome}" required>
                        <div class="invalid-feedback">
                            É obrigatório inserir o primeiro nome
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="nome_completo">Nome completo:</label>
                        <input type="text" class="form-control" id="nome_completo" name="nome_completo" value="{$dados.rs.nome_completo}" required>
                        <div class="invalid-feedback">
                            É obrigatório inserir o primeiro nome completo
                        </div>
                    </div>
                </div>

                {* Características  *}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cor_pele">Cor da pele</label>
                        <select class="form-control" id="cor_pele" name="cor_pele" >
                            {include file="inc/form_select_pele.tpl"}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="0" {$dados.sexo[0]}>Nenhum</option>
                            <option value="1" {$dados.sexo[1]}>Masculino</option>
                            <option value="2" {$dados.sexo[2]}>Feminino</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="estado_civil">Estado Civil:</label>
                        <select class="form-control" id="estado_civil" name="estado_civil">
                            {include file="inc/form_select_est_civil.tpl"}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="deficiencia">Deficiência:</label>
                        <select class="form-control" id="deficiencia" name="deficiencia">
                            {include file="inc/form_select_deficiencia.tpl"}
                        </select>
                    </div>
                </div>


                {* Dados filiação *}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="pai">Nome do pai</label>
                        <input type="text" class="form-control" id="pai" name="pai" value="{$dados.rs.pai}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mae">Nome da mãe:</label>
                        <input type="text" class="form-control" id="mae" name="mae" value="{$dados.rs.mae}">
                    </div>
                </div>

                {* Dados contato *}
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="telefone_ddd">DDD</label>
                        <input type="text" class="form-control" id="telefone_ddd"  name="telefone_ddd" value="{$dados.rs.telefone_ddd}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" class="form-control" id="telefone"  name="telefone" value="{$dados.rs.telefone}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="email">E-mail:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{$dados.rs.email}">
                    </div>
                </div>

                <hr>
                {* Dados nascimento *}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="nasc_data">Data nascimento:</label>
                        <input type="date" class="form-control" id="nasc_data" name="nasc_data" value="{$dados.rs.nasc_data}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nasc_pais">País de nascimento</label>
                        <select class="form-control" id="nasc_pais" name="nasc_pais" >
                            {include file="inc/form_select_nacionalidade.tpl"  pais=$dados.pais}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nasc_estado">Estado de nascimento:</label>
                        <select class="form-control" id="nasc_estado" name="nasc_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.estado}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nasc_cidade">Cidade de nascimento:</label>
                        <select class="form-control" id="nasc_cidade" name="nasc_cidade">
                            {include file="inc/form_select_cidades.tpl" cidade=$dados.cidade}
                        </select>
                    </div>
                </div>

                <hr>
                <h4>Escolaridade</h4>
                {* Dados escolaridade *}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="escolaridadade_estagio">Nível de educação:</label>
                        <select class="form-control" id="escolaridadade_estagio" name="escolaridadade_estagio">
                            {include file="inc/form_select_educa_estagio.tpl" estagio=$dados.educ_estag}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="escolaridade">Escolaridade</label>
                        <select class="form-control" id="escolaridade" name="escolaridade">
                            {include file="inc/form_select_instrucao.tpl"  escolar=$dados.educ_ins}
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="escolaridade_escola">Nome da instituição de ensino:</label>
                        <input type="text" class="form-control" id="escolaridade_escola" name="escolaridade_escola" value="{$dados.rs.escolaridade_escola}" >
                    </div>

                </div>

                <hr>
                <h4>Endereço</h4>
                {* Dados endereço *}
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="endereco_tp">Tipo de endereço</label>
                        <select class="form-control" id="endereco_tp" name="endereco_tp">
                            {include file="inc/form_select_endereceo_tp.tpl" end_tp=$dados.ende_tp}
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="endereco">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="{$dados.rs.endereco}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="endereco_numero">Número:</label>
                        <input type="text" class="form-control" id="endereco_numero" name="endereco_numero" value="{$dados.rs.endereco_numero}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="endereceo_bairro">Bairro</label>
                        <input type="text" class="form-control" id="endereceo_bairro" name="endereceo_bairro" value="{$dados.rs.endereceo_bairro}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="endereceo_cidade">Cidade</label>
                        <select class="form-control" id="endereceo_cidade" name="endereceo_cidade">
                            {include file="inc/form_select_cidades.tpl"  cidade=$dados.endereco_cidade}
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="endereceo_estado">Estado:</label>
                        <select class="form-control" id="endereceo_estado" name="endereceo_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.end_estado}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="endereceo_cep">CEP:</label>
                        <input type="text" class="form-control" id="endereceo_cep" name="endereceo_cep" value="{$dados.rs.endereceo_cep}">
                    </div>
                </div>

                <div class="accordion mb-4 mt-4 shadow-sm" id="anexo_arquivo">
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed text-secondary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fa fa-paperclip"></i> Anexo de documento {if $dados.docs[0] neq ''} <span class="badge badge-secondary"><i class="fa fa-asterisk"></i></span> {/if}
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#anexo_arquivo">
                            <div class="card-body">

                                {if $dados.docs[0] eq ''}
                                <div class="form-group">
                                    <label for="arquivo">Upload de arquivo em PDF</label>
                                    <input type="file" class="form-control-file" id="arquivo" name="arquivo">
                                </div>
                                {else}
                                        {foreach $dados.docs as $r}
                                            <i class="fa fa-file-text"></i> <a href="{$r.endereco}" target="_blank">{$r.endereco}</a>
                                        {/foreach}
                                {/if}

                            </div>
                        </div>
                    </div>
                </div>


                <input type="hidden" name="id" value="{$dados.rs.id}"/>

                <input type="hidden" name="tb" value="dados_pessoais"/>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary text-right  btn-lg" type="submit">Salvar e Avançar</button>
                </div>
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

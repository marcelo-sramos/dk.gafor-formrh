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
                <h1 class="h2 text-center">Documentos de  <b>{$dados.pessoa.nome_completo}</b></h1>
            </div>
            {include file="../avisos.tpl"}
            <ul id="progressbar" class="text-center justify-content-center">
                <li class="active" id="step1">
                    <div class="d-none d-md-block">Dados pessoais</div>
                </li>
                <li class="active" id="step2">
                    <div class="d-none d-md-block">Documentos</div>
                </li>
                <li class="" id="step3">
                    <div class="d-none d-md-block">Infomações</div>
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

                {* RG *}
                <h4>RG - Carteira de identidade</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="rg">RG:</label>
                        <input type="text" class="form-control" name="rg" id="rg" value="{$dados.rs.rg}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="rg_estado">Estado de emissão do RG::</label>
                        <select class="form-control" id="rg_estado" name="rg_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.rg_uf}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="rg_emissor">Orgão emissor:</label>
                        <input type="text" class="form-control" id="rg_emissor" name="rg_emissor" value="{$dados.rs.rg_emissor}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="rg_data">Data de emissão:</label>
                        <input type="date" class="form-control" id="rg_data" name="rg_data" value="{$dados.rs.rg_data}" >
                    </div>
                </div>


                {* Titulo de eleitor *}
                <hr>
                <h4>Titulo de Eleitor</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="titulo">Titulo de Eleitor:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo"  value="{$dados.rs.titulo}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="titulo_zona">Zona:</label>
                        <input type="text" class="form-control" id="titulo_zona"  name="titulo_zona" value="{$dados.rs.titulo_zona}">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label for="titulo_secao">Seção:</label>
                        <input type="text" class="form-control" id="titulo_secao" name="titulo_secao"  value="{$dados.rs.titulo_secao}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="titulo_estado">Estado de emissão:</label>
                        <select class="form-control" id="titulo_estado" name="titulo_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.titulo_uf}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="titulo_cidade">Cidade de emissão:</label>
                        <input type="text" class="form-control" id="titulo_cidade" name="titulo_cidade" value="{$dados.rs.titulo_cidade}" >
                    </div>
                </div>

                {* CNH *}
                <hr>
                <h4>CNH - Carteira Nacional de Habilitação</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cnh">Número de CNH:</label>
                        <input type="text" class="form-control" id="cnh" name="cnh" value="{$dados.rs.cnh}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_validade">Validade da CNH:</label>
                        <input type="date" class="form-control" id="cnh_validade" name="cnh_validade" value="{$dados.rs.cnh_validade}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_1_habilitacao">Data da 1ª habilitação:</label>
                        <input type="date" class="form-control" id="cnh_1_habilitacao" name="cnh_1_habilitacao" value="{$dados.rs.cnh_1_habilitacao}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_categoria">Categoria:</label>
                        <select class="form-control" id="cnh_categoria" name="cnh_categoria">
                            <option value="0">Nenhum</option>
                            <option value="1" {$dados.cnh_categoria[1]}">A</option>
                            <option value="2" {$dados.cnh_categoria[2]}>B</option>
                            <option value="3" {$dados.cnh_categoria[3]}>C</option>
                            <option value="4" {$dados.cnh_categoria[4]}>D</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cnh_expedicao">Data da expedição:</label>
                        <input type="date" class="form-control" id="cnh_expedicao" name="cnh_expedicao" value="{$dados.rs.cnh_expedicao}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_expedidor">Orgão expedidor:</label>
                        <input type="text" class="form-control" id="cnh_expedidor" name="cnh_expedidor" value="{$dados.rs.cnh_expedidor}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_estado">Estado da CNH:</label>
                        <select class="form-control" id="cnh_estado" name="cnh_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.cnh_estado}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cnh_cidade">Cidade da CNH:</label>
                        <input type="text" class="form-control" id="cnh_cidade" name="cnh_cidade" value="{$dados.rs.cnh_cidade}">
                    </div>
                </div>

                {* CTPS *}
                <hr>
                <h4>CTPS - Carteira de Trabalho e Previdência Social</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="ctps">Número da CTPS:</label>
                        <input type="text" class="form-control" id="ctps" name="ctps" value="{$dados.rs.ctps}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="ctps_secao">Série da CTPS:</label>
                        <input type="text" class="form-control" id="ctps_secao" name="ctps_secao" value="{$dados.rs.ctps_secao}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="ctps_estado">Estado da CTPS:</label>
                        <select class="form-control" id="ctps_estado" name="ctps_estado">
                            {include file="inc/form_select_estados.tpl" estado=$dados.ctps_estado}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="ctps_data">Data de emissão da CTPS:</label>
                        <input type="date" class="form-control" id="ctps_data" name="ctps_data" value="{$dados.rs.ctps_data}">
                    </div>
                </div>

                {* Docuemntos *}
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="{$dados.rs.cpf}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="pis">PIS:</label>
                        <input type="text" class="form-control" id="pis" name="pis" value="{$dados.rs.pis}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="reservista">Reservista:</label>
                        <input type="text" class="form-control" id="reservista" name="reservista" value="{$dados.rs.reservista}" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="sus">Carteira do SUS:</label>
                        <input type="text" class="form-control" id="sus" name="sus" value="{$dados.rs.sus}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="exame_ultimo">Último exame médico:</label>
                        <input type="date" class="form-control" id="exame_ultimo" name="exame_ultimo" value="{$dados.rs.exame_ultimo}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="exame_tox_data">Data do exame toxicológico:</label>
                        <input type="date" class="form-control" id="exame_tox_data" name="exame_tox_data" value="{$dados.rs.exame_tox_data}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="exame_tox_crm">CRM do médico/ exame toxicológico </label>
                        <input type="text" class="form-control" id="exame_tox_crm" name="exame_tox_crm" value="{$dados.rs.exame_tox_crm}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="exame_tox_crm_est">Estado do CRM Médico:</label>
                        <select class="form-control" id="exame_tox_crm_est" name="exame_tox_crm_est">
                            {include file="inc/form_select_estados.tpl" estado=$dados.crm_estadp}
                        </select>
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
                <input type="hidden" name="id_pessoa" value="{$dados.pessoa.id}"/>
                <input type="hidden" name="tb" value="documentos"/>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary text-right  btn-lg" type="submit">Salvar e Avançar</button>
                </div>
            </form>

        </main>
</div>

{include file="rodape.tpl"}


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
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

</body>
</html>

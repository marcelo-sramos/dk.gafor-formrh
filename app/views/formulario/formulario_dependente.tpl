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
                <h1 class="h2 text-center">Dependentes de  <b>{$dados.pessoa.nome_completo}</b></h1>
            </div>
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
                <li class="" id="step5">
                    <div class="d-none d-md-block">Assinaturas</div>
                </li>
                <li class="" id="step6">
                    <div class="d-none d-md-block">Finalização</div>
                </li>
            </ul>

            <form class="needs-validation" action="/formulario/salvar" method="post" novalidate>

                {* RG *}
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="depe_liga">Ligação entre pessoa:</label>
                        <select class="form-control" id="depe_liga" name="depe_liga" >
                            {include file="inc/form_select_denpen_liga.tpl" ligacao=$dados.ligacao}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="depe_situacao">Situação depedente:</label>
                        <select class="form-control" id="depe_situacao" name="depe_situacao" >
                            <option value="0" {$dados.situacao[0]}>Nenhum</option>
                            <option value="1" {$dados.situacao[1]}>Normal</option>
                            <option value="2" {$dados.situacao[2]}>Inválido</option>
                            <option value="3" {$dados.situacao[3]}>Falecido</option>
                            <option value="4" {$dados.situacao[4]}>Inválido Falecido</option>
                            <option value="5" {$dados.situacao[5]}>Excluído Logicamente</option>
                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="depe_ef_gov">Tipo de Dependente para governo:</label>
                        <select class="form-control" id="depe_ef_gov" name="depe_ef_gov" >
                            <option value="0" {$dados.ligacao_gov[0]}>Nenhum</option>
                            <option value="1" {$dados.ligacao_gov[1]}>Cônjuge</option>
                            <option value="2" {$dados.ligacao_gov[2]}>Filho(a) ou Enteado(a)</option>
                            <option value="3" {$dados.ligacao_gov[3]}>Filho(a) ou Enteado(a), Universitário(a) ou Cursando Escola Técnica de 2º Grau</option>
                            <option value="4" {$dados.ligacao_gov[4]}>Irmão(ã), Neto(a) ou Bisneto(a) sem Arrimo dos Pais, Universitário(a) ou Cursando Escola Técnica de 2° Grau, do(a) qual Detenha a Guarda Judicial</option>
                            <option value="7" {$dados.ligacao_gov[7]}>Irmão(ã), Neto(a) ou Bisneto(a) sem Arrimo dos Pais, do(a) qual Detenha a Guarda Judicial</option>
                            <option value="8" {$dados.ligacao_gov[8]}>Pais, Avós e Bisavós</option>
                            <option value="9" {$dados.ligacao_gov[9]}>Menor Pobre do qual Detenha a Guarda Judicial</option>
                            <option value="10" {$dados.ligacao_gov[10]}>A Pessoa Absolutamente Incapaz, da qual Seja Tutor ou Curador</option>
                            <option value="11" {$dados.ligacao_gov[11]}>Companheiro(a) com a qual Tenha Filho ou Viva Há Mais de 5 (Cinco) Anos ou Possua Declaração de União Estável</option>
                            <option value="12" {$dados.ligacao_gov[12]}>Ex-Cônjuge</option>
                            <option value="13" {$dados.ligacao_gov[13]}>Ex-Cônjuge</option>
                            <option value="14" {$dados.ligacao_gov[14]}>Agregado/Outros</option>


                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="depe_nome">Primeiro nome:</label>
                        <input type="text" class="form-control" name="depe_nome" id="depe_nome" value="{$dados.rs.depe_nome}" >
                    </div>
                    <div class="col-md-9 mb-3">
                        <label for="depe_nome_completo">Nome completo:</label>
                        <input type="text" class="form-control" id="depe_nome_completo" name="depe_nome_completo" value="{$dados.rs.depe_nome_completo}" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="depe_sexo">Sexo:</label>
                        <select class="form-control" id="depe_sexo" name="depe_sexo">
                            <option value="0" {$dados.sexo[0]}>Nenhum</option>
                            <option value="1" {$dados.sexo[1]}>Masculino</option>
                            <option value="2" {$dados.sexo[2]}>Feminino</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="depe_nasc">Nascimento:</label>
                        <input type="date" class="form-control" id="depe_nasc" name="depe_nasc" value="{$dados.rs.depe_nasc}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="depe_estado">Estado Civil:</label>
                        <select class="form-control" id="depe_estado" name="depe_estado" >
                            {include file="inc/form_select_est_civil.tpl"}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="depe_auto_salario">Automatizar Controle Salário Família:</label>
                        <select class="form-control" id="depe_auto_salario" name="depe_auto_salario">
                            <option value="1" {$dados.salario[1]}>Sim</option>
                            <option value="0" {$dados.salario[0]}>Não</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="depe_mae">Nome da Mãe:</label>
                        <input type="text" class="form-control" id="depe_mae" name="depe_mae" value="{$dados.rs.depe_mae}" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="depe_vac_freq">Considerar vacinação/frequência escolar:</label>
                        <select class="form-control" id="depe_vac_freq" name="depe_vac_freq">
                            <option value="1" {$dados.auto_freq[1]}>Sim</option>
                            <option value="0" {$dados.auto_freq[0]}>Não</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depe_vac_data">Data da última vacinação:</label>
                        <input type="date" class="form-control" id="depe_vac_data" name="depe_vac_data" value="{$dados.rs.depe_vac_data}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depe_auto_ir">Automatizar controle IR:</label>
                        <select class="form-control" id="depe_auto_ir" name="depe_auto_ir">
                            <option value="1" {$dados.ir[1]}>Sim</option>
                            <option value="0" {$dados.ir[0]}>Não</option>
                        </select>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label for="depe_cpf">CPF:</label>
                        <input type="text" class="form-control" id="depe_cpf" name="depe_cpf" value="{$dados.rs.depe_cpf}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depe_cart_sus">Cartão SUS:</label>
                        <input type="text" class="form-control" id="depe_cart_sus" name="depe_cart_sus" value="{$dados.rs.depe_cart_sus}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="depe_decl_vivo">Nº declaração nascido:</label>
                        <input type="text" class="form-control" id="depe_decl_vivo" name="depe_decl_vivo" value="{$dados.rs.depe_decl_vivo}" >
                    </div>
                </div>



                <input type="hidden" name="id" value="{$dados.rs.id}"/>
                <input type="hidden" name="id_pessoa" value="{$dados.pessoa.id}"/>
                <input type="hidden" name="tb" value="depedentes"/>
                <button class="btn btn-primary" type="submit">Enviar</button>
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

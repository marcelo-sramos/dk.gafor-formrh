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
                <h1 class="h2 text-center">Informações da admissão de  <b>{$dados.pessoa.nome_completo}</b></h1>
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

            <form class="needs-validation" action="/formulario/salvar" method="post" novalidate>

                {* Admissão *}
                <hr>
                <h4>Adminissão</h4>
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label for="id_contratado">ID Contratado:</label>
                        <input type="text" class="form-control" id="id_contratado" name="id_contratado" value="{$dados.rs.id_contratado}" >
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="admissao_data">Data admissão:</label>
                        <input type="date" class="form-control" id="admissao_data" name="admissao_data" value="{$dados.rs.admissao_data}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="admissao_tipo">Tipo admissão:</label>
                        <select class="form-control" id="admissao_tipo" name="admissao_tipo">
                            <option value="0" {$dados.admissao_tipo[4]}>Nenhum</option>
                            <option value="1" {$dados.admissao_tipo[1]}>Autonomos /Motorista</option>
                            <option value="2" {$dados.admissao_tipo[2]}>Safrista</option>
                            <option value="3" {$dados.admissao_tipo[3]}>Autonomo / Prestadores</option>

                        </select>
                    </div>
                    <div class="col-md-5 mb-3">
                        <label for="admissao_gov">Tipo admissão gverno:</label>
                        <select class="form-control" id="admissao_gov" name="admissao_gov">
                            <option value="0" {$dados.admissao_gov[0]}>Nenhuma</option>
                            <option value="1" {$dados.admissao_gov[1]}>Admissão</option>
                            <option value="2" {$dados.admissao_gov[2]}>Transferência de Empresa do Mesmo Grupo Econômico</option>
                            <option value="3" {$dados.admissao_gov[3]}>Transferência por Motivo de Sucessão, Incorporação, Cisão ou Fusão</option>
                            <option value="4" {$dados.admissao_gov[4]}>Transferência de Empresa Consorciada ou de Consórcio</option>
                            <option value="5" {$dados.admissao_gov[5]}>Transferência Empregado Doméstico para Outra Pessoa da Mesma Família</option>
                            <option value="6" {$dados.admissao_gov[6]}>Mudança de CPF</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Contrato</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="horario">Horario:</label>
                        <select class="form-control" id="horario" name="horario">
                            {include file="inc/form_select_horarios.tpl" horario=$dados.horario}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="marcado_ponto">Marcador de ponto:</label>
                        <select class="form-control" id="marcado_ponto" name="marcado_ponto">
                            <option value="0" {$dados.marcado_ponto[0]}>Sem Marcador de Ponto</option>
                            <option value="1" {$dados.marcado_ponto[1]}>Marca Ponto</option>
                            <option value="2" {$dados.marcado_ponto[2]}>Isento de Ponto</option>
                            <option value="3" {$dados.marcado_ponto[3]}>Estagiarios</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="salario">Salário:</label>
                        <select class="form-control" id="salario" name="salario">
                            {include file="inc/form_select_salarios.tpl" salario_cont=$dados.salario}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="vinculo">Vínculo:</label>
                        <select class="form-control" id="vinculo" name="vinculo">
                            {include file="inc/form_select_vinculos.tpl" vinculo=$dados.vinculo}
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="caged_tp_emprego">Tipo Emprego (CAGED):</label>
                        <select class="form-control" id="caged_tp_emprego" name="caged_tp_emprego">
                            <option value="0" {$dados.caged_tp_emprego[0]}>Nenhum</option>
                            <option value="1" {$dados.caged_tp_emprego[1]}>Primeiro Emprego</option>
                            <option value="2" {$dados.caged_tp_emprego[2]}>Reemprego</option>
                            <option value="3" {$dados.caged_tp_emprego[3]}>Reintegração no Mês</option>
                            <option value="4" {$dados.caged_tp_emprego[4]}>Reintegração em Meses Anteriores</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="caged_status">Status CAGED:</label>
                        <select class="form-control" id="caged_status" name="caged_status">
                            <option value="0" {$dados.caged_status[0]}>Nenhum</option>
                            <option value="1" {$dados.caged_status[1]}>Requerido/Percebendo Seguro-Desemprego. Pendente</option>
                            <option value="2" {$dados.caged_status[2]}>Percebendo Seguro-Desemprego. CAGED Já Enviado</option>
                            <option value="3" {$dados.caged_status[3]}>Não Está Percebendo Seguro-Desemprego</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="folha">Folha:</label>
                        <select class="form-control" id="folha" name="folha">
                            {include file="inc/form_select_folhas.tpl" folhas=$dados.folha}
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="prazo_contrato">Prazo contrato:</label>
                        <select class="form-control" id="prazo_contrato" name="prazo_contrato">
                            {include file="inc/form_select_prazocontrato.tpl" praz_contrato=$dados.prazo_contrato}
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cargo">Cargo:</label>
                        <select class="form-control" id="cargo" name="cargo">
                            {include file="inc/form_select_cargos.tpl" cargo=$dados.cargo}
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="salario_valor">Valor salários:</label>
                        <input type="text" class="form-control" id="salario_valor" name="salario_valor" value="{$dados.rs.salario_valor}" >

                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="centro_custos">Centro de custos:</label>
                        <select class="form-control" id="centro_custos" name="centro_custos">
                            {include file="inc/form_select_centro_custo.tpl" custos=$dados.centro_custos}
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="area_atuacao">Área de atuação:</label>
                        <select class="form-control" id="area_atuacao" name="area_atuacao">
                            {include file="inc/form_select_areaatuacao.tpl" area=$dados.area_atuacao}
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Sindicato</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="sindicato_associado">Sindicato Associado:</label>
                        <select class="form-control" id="sindicato_associado" name="sindicato_associado">
                            {include file="inc/form_select_sindicatos.tpl" sindicato=$dados.sindicato_associado}
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="sindicato">Sindicato:</label>
                        <select class="form-control" id="sindicato" name="sindicato">
                            {include file="inc/form_select_sindicatos.tpl" sindicato=$dados.sindicato}
                        </select>

                    </div>

                    <div class="col-md-5 mb-3">
                        <label for="sindicatos_secundario">Sindicato secundário:</label>
                        <select class="form-control" id="sindicatos_secundario" name="sindicatos_secundario">
                            {include file="inc/form_select_sindicatos.tpl" sindicato=$dados.sindicatos_secundario}
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="normal">Normal</label>
                        <select class="form-control" id="normal" name="normal">
                            <option value="0" {$dados.normal[0]}>0 - Nenhum</option>
                            <option value="1" {$dados.normal[1]}>Normal</option>
                            <option value="2" {$dados.normal[2]}>Decorrente de Ação Fiscal</option>
                            <option value="3" {$dados.normal[3]}>Decorrente de decisão Judiciall</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="aposentadoria">Regime aposentadoria:</label>
                        <select class="form-control" id="aposentadoria" name="aposentadoria">
                            <option value="0"  {$dados.aposentadoria[0]}>Nenhum</option>
                            <option value="36" {$dados.aposentadoria[36]}>Regime Geral da Previdência Social - RGPS</option>
                            <option value="37" {$dados.aposentadoria[37]}>Regime Próprio de Previdência Social - RPPS</option>
                            <option value="38" {$dados.aposentadoria[38]}>Regime de Previdência Social no Exterior</option>
                            <option value="10001"  {$dados.aposentadoria[10001]}>Aposentadoria por Tempo de Servico</option>
                        </select>

                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gps">Guia da Previdência:</label>
                        <select class="form-control" id="gps" name="gps">
                            {include file="inc/form_select_gps.tpl" gps=$dados.gps}
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="ficha_drt">Ficha registro DRT:</label>
                        <input type="text" class="form-control" id="ficha_drt" name="ficha_drt" value="{$dados.rs.ficha_drt}" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="indice_adian_aut_cons">Considerar Indice de Adiantamento Automático:</label>
                        <select class="form-control" id="indice_adian_aut_cons" name="indice_adian_aut_cons">
                            <option value="1" {$dados.indice_adian_aut_cons[0]}>Sim</option>
                            <option value="0" {$dados.indice_adian_aut_cons[1]}>Não</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="indice_adian_aut">Indice de Adiantamento Automático:</label>
                        <input type="text" class="form-control" id="indice_adian_aut" name="indice_adian_aut" value="{$dados.rs.indice_adian_aut}" >
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="periculosidade">Percentual de Periculosidade:</label>
                        <input type="text" class="form-control" id="periculosidade" name="periculosidade" value="{$dados.rs.periculosidade}" >
                    </div>
                </div>
                <hr>
                <h4>MOPP</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="mopp">MOPP - Número Certificado:</label>
                        <input type="date" class="form-control" id="mopp" name="mopp" value="{$dados.rs.mopp}" >
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="mopp_emissao">MOPP - Emissão:</label>
                        <input type="date" class="form-control" id="mopp_emissao" name="mopp_emissao" value="{$dados.rs.mopp_emissao}" >
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="mopp_vencimento">Data Vencimento MOPP:</label>
                        <input type="date" class="form-control" id="mopp_vencimento" name="mopp_vencimento" value="{$dados.rs.mopp_vencimento}" >
                    </div>
                </div>



                <input type="hidden" name="id" value="{$dados.rs.id}"/>
                <input type="hidden" name="id_pessoa" value="{$dados.pessoa.id}"/>
                <input type="hidden" name="tb" value="informacoes"/>
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

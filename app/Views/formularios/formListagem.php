<div class="row align-items-center">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title">Cadastro de Listagem</h4>
            <form action="<?= base_url('listagemcontroller/listagemsubmit/' .  $paciente->id) ?>" method="POST" name="formListagem" id="form">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>NC:</label>
                            <input type="text" id="ncResp" value="<?= isset($paciente->id) ? $paciente->id : '' ?>" name="ncResp" class="form-control" required disabled>
                        </div>
                        <div class="col-11">
                            <label>CPF</label>
                            <input type="text" disabled maxlength="14" id="cpfResp" value="<?= isset($paciente->cpf) ? $paciente->cpf : '' ?>" name="cpfResp" class="form-control" required onkeyup="searchPeople(this.value)">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>N° da Senha</label>
                    <input type="number" name="senha" required class="form-control">
                </div>
                <div class="form-group">
                    <label>QTD de receitas (responsável)</label>
                    <input type="number" name="receitasResponsavel" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="responsavel">Responsável</label>
                    <input type="text" name="responsavel" id="responsavel" disabled value="<?= isset($paciente->nome) ? $paciente->nome : '' ?>" required class="form-control" readonly required />
                </div>
                <div style="display:flex;" class="adicional">

                    <div class="form-group col-1" style="margin-right: 10px;">
                        <label>NC</label>
                        <input type="text" name="ncAdicional" class="form-control" maxlength="14" id="ncAdicional">
                    </div>
                    <div class="form-group" style="margin-right: 10px;">
                        <label>CPF</label>
                        <input type="text" name="cpfAdicional" class="form-control" maxlength="14" id="cpfAdicional">
                    </div>
                    <!--  -->
                    <div class="form-group" style="margin-right: 10px;">
                        <label>QTD de receitas</label>
                        <input type="number" class="form-control" name="qtdAdicional" id="qtdAdicional">
                    </div>
                    <!--  -->
                    <div class="form-group" style="margin-right: 10px;">
                        <label>Nome</label>
                        <input style="width: 292px; " type="text" class="form-control" id="nomeAdicional" name="nomeAdicional" readonly required>
                    </div>
                    <input readonly value="+" onclick="adicional(nomeAdicional.value,cpfAdicional.value,qtdAdicional.value)" id="add" class="btn btn-success" style="height: min-content;width: 35px;"> </input>

                    <input type="hidden" value="0" name="idAdicional" id="idAdicional" />
                    <input type="hidden" value="0" name="idsAdicional" id="idsAdicional" />
                </div>

                <div id="dtPessoas">
                    <table id="tbPessoas" class="table">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>CPF</td>
                                <td>QTD</td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="row">
                    <div class="mt-2 col-12">
                        <button class="float-end btn btn-primary" type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </div>
            </form>
            </h4>
            </h4>
        </div>

    </div>
</div>
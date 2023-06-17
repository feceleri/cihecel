<div class="row align-items-center">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title"><?= isset($editar) ? 'Editar Listagem' : 'Cadastro de Listagem' ?></h4>
            <form action="<?= isset($editar) ? base_url('listagemcontroller/listagemupdate/' . (base64_encode($senha->id))) : base_url('listagemcontroller/listagemsubmit/' . (isset($paciente->id) ? $paciente->id : '')) ?>" method="POST" name="formListagem" id="form">
                <?php if (empty($editar)) : ?>
                    <div class="form-group">
                        <label for="responsavel">Responsável</label>
                        <input type="text" name="responsavel" id="responsavel" value="<?= isset($paciente->nome) ? $paciente->nome : '' ?>" required class="form-control" readonly required />
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label class="fw-bolder badge bg-primary fs-6 mb-1">NC:</label>
                                <input type="text" id="ncResp" value="<?= isset($paciente->id) ? $paciente->id : '' ?>" name="ncResp" class="form-control fw-bolder" required readonly>
                            </div>
                            <div class="col-10">
                                <label style="margin-bottom: 10px;">CPF</label>
                                <input type="text" readonly maxlength="14" id="cpfResp" value="<?= isset($paciente->cpf) ? $paciente->cpf : '' ?>" name="cpfResp" class="form-control" required onkeyup="searchPeople(this.value)">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <label>N° da Senha</label>
                            <input autofocus type="number" value="<?= isset($editar) ? $senha->senha : '' ?>" name="senha" required class="form-control" required>
                        </div>
                        <div class="col-2">
                            <label>Data da entrada:</label>
                            <input type="date" name="dtEntrada" value="<?= isset($editar) ? $senha->entrada : '' ?>" id="dtEntrada" class="form-control" required>
                        </div>
                        <?php if(isset($editar)): ?>
                        <div class="col-2">
                            <label>Data da saida:</label>
                            <input type="date" name="dtSaida" value="<?= isset($editar) ? $senha->saida : '' ?>" id="dtSaida" class="form-control" required>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="display:flex;" class="adicional">
                    <div class="form-group col-1" style="margin-right: 10px;">
                        <label class="fw-bolder fs-6 badge bg-primary mb-1">NC Adc.:</label>
                        <input type="text" name="ncAdicional" class="form-control fw-bolder" maxlength="14" id="ncAdicional">
                    </div>
                    <div class="form-group" style="margin-right: 10px;">
                        <label style="margin-bottom: 10px;">CPF</label>
                        <input type="text" name="cpfAdicional" class="form-control" maxlength="14" id="cpfAdicional">
                    </div>
                    <!--  
                    <div class="form-group" style="margin-right: 10px;">
                        <label style="margin-bottom: 10px;">QTD de receitas</label>
                        <input type="number" class="form-control" name="qtdAdicional" id="qtdAdicional">
                    </div>
                     -->
                    <div class="form-group" style="margin-right: 10px;">
                        <label style="margin-bottom: 10px;">Nome</label>
                        <input style="width: 292px; " type="text" class="form-control" id="nomeAdicional" name="nomeAdicional" readonly required>
                    </div>
                    <input readonly value="+" onclick="adicional(nomeAdicional.value,cpfAdicional.value)" id="add" class="btn btn-success" style="height: min-content;width: 35px; margin-top: 33px;"> </input>

                    <input type="hidden" value="0" name="idAdicional" id="idAdicional" />
                    <input type="hidden" value="0" name="idsAdicional" id="idsAdicional" />
                </div>

                <div id="dtPessoas">
                    <table id="tbPessoas" class="table">
                        <thead>
                            <tr>
                                <td>Nome</td>
                                <td>CPF</td>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="row">
                    <div class="mt-2 col-12">
                        <button class="float-end btn btn-primary" type="submit" class="btn btn-primary"><?= isset($editar) ? 'Atualizar' : 'Cadastrar' ?></button>
                    </div>
                </div>
            </form>
            </h4>
            </h4>
        </div>

    </div>
</div>
<script>
    if (document.getElementById('dtEntrada').value == '') {
        document.getElementById('dtEntrada').valueAsDate = new Date();
    }
</script>
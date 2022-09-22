<div class="row align-items-center">
    <div class="col-md-8">
        <div class="card-box">
            <h4 class="card-title">Cadastro de Listagem</h4>
                <form action="<?= base_url('public/atendimento/salvarListagem')?>" method="POST" name="formListagem" id="form">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" maxlength="14"  id="cpfResp" name="cpfResp" class="form-control" required  onkeyup="searchPeople(this.value)">
                        
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
                        <input type="text" name="responsavel" id="responsavel" required class="form-control" readonly required/> 
                    </div>
                    <div style="display:flex;" class="adicional">
                        <div class="form-group" style="margin-right: 10px;">
                            <label>CPF</label>
                            <input type="text" name="cpfAdicional" class="form-control" maxlength="14" id="cpfAdicional" >
                        </div>
                        <!--  -->
                        <div class="form-group" style="margin-right: 10px;">
                            <label>QTD de receitas</label>
                            <input type="number" class="form-control" name="qtdAdicional" id="qtdAdicional">
                        </div>
                        <!--  -->
                        <div class="form-group" style="margin-right: 10px;">
                            <label>Nome</label>
                            <input style="width: 292px; "type="text" class="form-control" id="nomeAdicional" name="nomeAdicional" readonly required>
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
                    
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary" style="margin-left: 40em;;">Cadastrar</button>
                    </div>
                </form>
            </h4>
            </h4>
        </div>

    </div>
</div>
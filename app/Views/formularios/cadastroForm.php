<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title">Informações Pessoais</h4>
            <form action="<?= base_url('public/atendimento/salvar') ?>" method="POST" name="datesCadastro" id='form'>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nomeCompleto" class="col-md-3 col-form-label">Nome Completo</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required minlength="3" value="<?= (isset($resultado->nome))?$resultado->nome:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cpf" class="col-md-3 col-form-label">CPF</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required value="<?= (isset($resultado))? $resultado->cpf:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sexo" class="col-md-3 col-form-label">Sexo</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="MASCULINO" required value="<?= (isset($resultado))? $resultado->sexo:''; ?>">
                                    <label class="form-check-label" for="sexoMasculino">
                                        Masculino
                                    </label>

                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexoFeminino" value="FEMININO" value="<?= (isset($resultado))? $resultado->sexo:''; ?>">
                                    <label class="form-check-label" for="sexoFeminino">
                                        Feminino
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dtNasc" class="col-md-3 col-form-label" value="<?= (isset($resultado->nome))?$resultado->nome:''; ?>">Data de Nascimento</label>
                            <div class="col-md-4">
                                <input required type="date" class="form-control" id="dtNasc" name="dtNasc" value="<?= (isset($resultado))? $resultado->dataNascimento:''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nomeDaMae" class="col-md-3 col-form-label">Nome da Mãe</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="nomeDaMae" name="nomeDaMae" value="<?= (isset($resultado))? $resultado->nomeMae:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rg" class="col-md-3 col-form-label">RG</label>
                            <div class="col-md-9">
                                <input required type="text" class="form-control" id="rg" name="rg" value="<?= (isset($resultado))? $resultado->rg:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel1" class="col-md-3 col-form-label">Telefone 1</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="tel1" name="tel1" maxlength="15" value="<?= (isset($resultado))? $resultado->telefone1:''; ?>"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel2" class="col-md-3 col-form-label">Telefone 2</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="tel2" name="tel2" maxlength="15" value="<?= (isset($resultado))? $resultado->telefone2:''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="card-title">Endereço</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="cep" class="col-md-3 col-form-label">CEP</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9" value="<?= (isset($resultado))? $resultado->cep:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="logradouro" class="col-md-3 col-form-label">Logradouro</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= (isset($resultado))? $resultado->logradouro:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numero" class="col-md-3 col-form-label">Número</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="numero" name="numero" value="<?= (isset($resultado))? $resultado->numeroCasa:''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="complemento" class="col-md-3 col-form-label">Complemento</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="complemento" name="complemento" value="<?= (isset($resultado))? $resultado->complementoCasa:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="localidade" class="col-md-3 col-form-label">Cidade</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="localidade" name="localidade" value="<?= (isset($resultado))? $resultado->cidade:''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bairro" class="col-md-3 col-form-label">Bairro</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="bairro" name="bairro" value="<?= (isset($resultado))? $resultado->bairro:''; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <?php if (isset($editar)) {
                        echo '<input type="hidden"  id="id" name="id" value="'.$resultado->id.'" />';
                        echo '<button type="submit" class="btn btn-primary float-end" id="cadastrar">Editar</button>';
                    } else {
                        echo '<button type="submit" class="btn btn-primary float-end" id="cadastrar">Cadastrar</button>';
                    }
                    ?>

                </div>
                <p><br></p>
            </form>
        </div>
    </div>
</div>
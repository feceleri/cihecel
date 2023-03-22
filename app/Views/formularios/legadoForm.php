<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title">Informações Atendimento</h4>
            <form action="<?= base_url('atendimento/legadoupdate/'. (base64_encode($resultado->id))) ?>" method="POST" name="atendimentoCadastro" id='formPrincipal'>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="senha" class="col-md-3 col-form-label">Senha:</label>
                            <div class="col-md-6">
                                <input style="text-transform: capitalize;" type="text" class="form-control" id="senha" name="senha" required minlength="3" value="<?= (isset($resultado->senha)) ? $resultado->senha : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="idPaciente" class="col-md-3 col-form-label">NC do paciente:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="idPaciente" name="idPaciente" required value="<?= (isset($resultado)) ? $resultado->idPaciente : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dtNasc" class="col-md-4 col-form-label" value="<?= (isset($resultado->entrada)) ? $resultado->entrada : ''; ?>">Data de Entrada:</label>
                            <div class="col-md-5">
                                <input required type="date" class="form-control" id="dtEntrada" name="dtEntrada" value="<?= (isset($resultado)) ? $resultado->entrada : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="comentario">Observação:</label>
                        <textarea name="obs" id="comentario" class="form-control" name="obs" rows="6" minlength="5"><?= $resultado->obs ?></textarea>
                        <input name="id" type="text" style="display:none;" value="<?= base64_encode($resultado->id); ?>">

                    </div>
                    <div class="text-right">
                        <?php if (isset($editar)) {

                            echo '<input type="hidden"  id="id" name="id" value="' . $resultado->id . '" />';
                            echo '<button id="buttonForm" type="submit" class="btn btn-primary float-end" id="cadastrar">Editar</button>';
                        } else {
                            echo '<button id="buttonForm" type="submit" class="btn btn-primary float-end" id="cadastrar">Cadastrar</button>';
                        }
                        ?>

                    </div>
                    <p><br></p>
            </form>
        </div>
    </div>
</div>
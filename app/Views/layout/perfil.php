<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>

<!-- Style -->
<style>
    div.row div ul li span {
        color: blue;
    }

    #edit {
        cursor: pointer;
    }

    #edit:hover {
        color: #6A5ACD;
    }

    .hidden {
        display: none;
    }

    .check {
        margin-left: 24em;
        margin-top: 10px;
    }

    .checkReverse {
        margin-top: 10px;
    }

    .edit {
        font-size: 30px;
        color: black;
        border: none;
        background-color: rgba(0, 0, 0, 0);

    }

    button:hover {
        color: red;
    }

    div.table-responsive>div.dataTables_wrapper>div.row {
        margin: 0;
    }

    td {
        height: 30px;
    }

    i.fa.fa-book {
        font-size: 17px;
    }

    .table.dataTable td a#check {
        font-size: 20px;
    }

    .showbutton:hover {
        font-size: 20px;
        cursor: pointer;
        color: #55ce63;
    }

    .x:hover {
        font-size: 20px;
        cursor: pointer;
        color: red;
    }

    .x {
        color: black;
    }

    table tbody td.sorting_1 a:hover {
        font-size: 20px;
    }

    .showbutton {
        font-size: 20px;
    }

    .hiddenbutton {
        display: none;
    }

    .showForm {
        margin: 1px;
    }

    .pagination>.active>a {
        background-color: #dde4e9;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->


<?php

use App\Models\Legados;

function dates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('-', '/', $orgDate);
    $newDate = date("d/m/Y", strtotime($date));
    return $newDate;
}

function reverseDates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('/', '-', $orgDate);
    $newDate = date("d/m/Y", strtotime($date));
    return $newDate;
}
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Paciente</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil - <?= $resultado->nome ?></li>
</ol>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><span class="text-danger font-weight-bold">DELETAR </span>Cadastro</h5>
                <button type="button" id="fecharModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você realmente deseja <span class="text-danger font-weight-bold">EXCLUIR</span> esse paciente do sistema?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" id="btnDeletar">Excluir</a>
            </div>
        </div>
    </div>
</div>
<div class="card-box">
    <div class="d-flex justify-content-end">
        <?php
        echo ($_SESSION['usuario']['user']->tipo == '1') ? "<a class='edit me-1' href='" . base_url('atendimento/editar/' . base64_encode($resultado->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true' title='Editar Paciente'></i> </span></a><button class='edit' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $resultado->id . ")' ><span><i class='fa fa-trash' aria-hidden='true' title='Deletar Paciente'></i> </span></button> " : (($_SESSION['usuario']['user']->tipo == '0') ? "<a class='edit me-1' href='" . base_url('atendimento/editar/' . base64_encode($resultado->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true' title='Editar Cadastro'></i> </span></a>" : " ");
        ?>
    </div>
    <div class="row">
        <div class="block col-12" style="padding:0.5 1em;">
            <ul class="list-group">
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none; text-transform: Capitalize;"><span>Nome:</span>&nbsp;<?= $resultado->nome ?></li>
                        <li class="col-6" style="list-style-type: none;"><span>Sexo:</span>&nbsp;<?= $resultado->sexo ?></li>
                    </ul>
                </li>
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none;"><span>CPF:</span>&nbsp;<?= $resultado->cpf ?></li>
                </li>
                <li class="col-6" style="list-style-type: none;"><span>RG:</span>&nbsp;<?= (!empty($resultado->rg)) ? $resultado->rg : 'Não cadastrado!' ?></li>
                </li>
            </ul>
            </li>
            <li class="col-12 list-group-item" style="text-transform: Capitalize;">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>Nome da Mãe:&nbsp;</span> <?= (!empty($resultado->nomeMae)) ? $resultado->nomeMae : ' Não cadastrado!' ?></li>
                    <li class="col-6" style="list-style-type: none;"><span>Data de Nascimento:</span> <?= (!empty($resultado->dataNascimento)) ? reverseDates($resultado->dataNascimento) : ' Não cadastrado!' ?></li>
                </ul>
            </li>
            <li class="col-12 list-group-item">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>Telefone 1:</span>&nbsp;<?= (!empty($resultado->telefone1)) ? $resultado->telefone1 : ' Não cadastrado!' ?></li>
                    <li class="col-6" style="list-style-type: none;"><span>Telefone 2:</span>&nbsp;<?= (!empty($resultado->telefone2)) ? $resultado->telefone2 : ' Não cadastrado!' ?></li>
                </ul>
            </li>
            <li class="list-group-item"><span>Endereço:</span>&nbsp;<?= (!empty($resultado->logradouro)) ? $resultado->logradouro :  'Não cadastrado!' ?>, <?= $resultado->numeroCasa ?> <?= $resultado->complementoCasa ?></li>
            <li class="col-12 list-group-item">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>Bairro:</span>&nbsp; <?= (!empty($resultado->bairro)) ? $resultado->bairro : ' Não cadastrado!' ?></li>
                    <li class="col-6" style="list-style-type: none;"><span>CEP:</span>&nbsp;<?= (!empty($resultado->cep) ? $resultado->cep : ' Não cadastrado!') ?></li>
                </ul>
            </li>
            </ul>
            <br>

        </div>
        <div class="row" style="padding:0 2em;">
            <div class="card col-12" id="cardObs" style="padding:0.5 2em;">
                <div class="card-body">
                    <h5 class="card-title">Observação: <a id="edit" onclick="Editobservacao()"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="text-transform: Capitalize;"> <?= $resultado->nome ?>,</h6> <br>
                    <p class="card-text"><?php if (isset($resultado->obs) || isset($legados)) {
                                                echo $resultado->obs . "</br>";
                                                foreach ($legados as $legado) {
                                                    echo dates($legado->entrada) . " " . $legado->obs . "</br>";
                                                }
                                            } else {
                                                echo 'Não há nenhuma observação registrada.';
                                            }
                                            ?></p>
                </div>
            </div>
            <div class="col-12">
                <form action="<?= base_url('atendimento/obs') ?>" id="form" class="hidden" method="post">
                    <label for="comentario">Observação:</label>
                    <textarea name="obs" id="comentario" class="form-control" name="obs" minlength="5" value="<?= isset($legados->obs) ? $legados->obs : '' ?>" required><?= isset($legados->obs) ? $legados->obs : $resultado->obs ?></textarea>
                    <input name="id" type="text" style="display:none;" value="<?= base64_encode($resultado->id); ?>">
                    <div class="row" style="padding-top:10px;width:100%;">
                        <div class="col-9"><a style="margin:0 1.5em;" id="reverse" onclick="reverse()" class="btn btn-secondary btn-sm">Voltar</a></div>
                        <div class="col-3"><button type="submit" class="btn btn-primary btn-sm float-end">Registrar</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <h2 class="text-center">Histórico de Listagem</h2>
            <div>
                <?php

                echo ($_SESSION['usuario']['user']->tipo == '1' || $_SESSION['usuario']['user']->tipo == '0') ?
                    "<a title='Novo Atendimento' class='btn btn-success mb-2 mt-1' href='" . base_url('listagemcontroller/listagemsubmit/' . base64_encode($resultado->id)) . "'><i class='fa fa-book' aria-hidden='true'></i></a>" : '';
                ?>
            </div>
        </div>
        <table class="table table-striped table-responsive mt-2" style="width: 100%;">
            <tr class='text-center'>
                <th>Senha</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Retorno</th>
                <th>Recomendação</th>
            </tr>
            <?php
            foreach ($listagens as $listagem) {
                echo "<tr'>";
                echo  "<td style='text-align:center;'> <a href='" . base_url('atendimento/senha/' . base64_encode($listagem->id)) . "'> " . $listagem->senha . "</a></td>";
                $entrada = dates($listagem->entrada);
                echo  "<td class='text-center'> " . $entrada . "</td>";
                if (isset($listagem->saida)) {
                    echo "<td class='text-center'>" . dates($listagem->saida) . "</td>";
                } else {
                    echo "<td class='text-center' id='td' style='width:25%;'>
                            <a id='manual_" . $listagem->id . "' onclick='dateManual(" . $listagem->id . ")' class='showbutton' style='margin: 20px;'>
                                <i class='fa fa-calendar' aria-hidden='true'></i>
                            </a>
                            <a class='showbutton' id='automatico_" . $listagem->id . "' href='" . base_url('listagemcontroller/saidaListagem/' . base64_encode($listagem->id)) . "' id='check'>
                                <i class='fa fa-check-square' aria-hidden='true'></i>
                            </a>
                            <form action='" . base_url('listagemcontroller/saidaListagemManual') . "' method='post'>
                                <input name='saida'style='width: 113px;' id='inputManual_" . $listagem->id . "' class='hiddenbutton' type='date' required>
                                <input style='display:none;' name='id' value='" . $listagem->id . "' >
                                    <button id='buttonManual_" . $listagem->id . "' class='hiddenbutton showbutton' style='border:none;background:none;margin:-7px;' type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                    <a onclick='reverseDateManual(" . $listagem->id . ")' id='x_" . $listagem->id . "' class='hiddenbutton' style='border:none;background:none;' type='submit'><i class='fa fa-times' aria-hidden='true'></i></a>
                            </form>
                          </td>";
                }
                $retorno = 0;
                if ($listagem->saida == null) {
                    $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                } else {
                    $retorno =  date("d/m/Y",strtotime("+1 month", strtotime($listagem->saida)));
                }
                echo "<td style='text-align:center;'>$retorno</td>";
                if ($retorno != 0) {
                    $recomendacao =  date("d/m/Y",strtotime("+27 days", strtotime($listagem->saida)));
                } else {
                    $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                }
                echo "<td style='text-align:center;'>$recomendacao</td>";
                echo "</tr>";
            }

            if (isset($legados)) {
                foreach ($legados as $legado) {
                    echo "<tr class='text-center'>";
                    echo "<td class='text-center'>" . (isset($legado->senha) ? $legado->senha : 'Não Tem') . "</td>";
                    echo "<td>" . dates($legado->entrada) . "</td>";
                    if (isset($legado->saida)) {
                        echo "<td>" . dates($legado->saida) . "</td>";
                    } else {
                        echo "<td id='td' style='width:25%;'>
                                <a id='manual_" . $legado->id . "' onclick='dateManual(" . $legado->id . ")' class='showbutton' style='margin: 20px;'>
                                    <i class='fa fa-calendar' aria-hidden='true'></i>
                                </a>
                                <a class='showbutton' id='automatico_" . $legado->id . "' href='" . base_url('legadoscontroller/saidaListagem/' . base64_encode($legado->id)) . "' id='check'>
                                    <i class='fa fa-check-square' aria-hidden='true'></i>
                                </a>
                                <form action='" . base_url('legadoscontroller/saidaListagemManual') . "' method='post'>
                                    <input name='saida'style='width: 113px;' id='inputManual_" . $legado->id . "' class='hiddenbutton' type='date' required>
                                    <input style='display:none;' name='id' value='" . $legado->id . "' >
                                        <button id='buttonManual_" . $legado->id . "' class='hiddenbutton showbutton' style='border:none;background:none;margin:-7px;' type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                        <a onclick='reverseDateManual(" . $legado->id . ")' id='x_" . $legado->id . "' class='hiddenbutton' style='border:none;background:none;' type='submit'><i class='fa fa-times' aria-hidden='true'></i></a>
                                </form>
                              </td>";
                    }


                    $retorno = 0;
                    if ($legado->saida == null) {
                        $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                    } else {
                        $retorno =  date("d/m/Y", strtotime("+1 month", strtotime($legado->saida)));
                    }
                    echo "<td class='text-center'>$retorno</td>";
                    if ($retorno != 0) {

                        $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(reverseDates($retorno))));
                    } else {
                        $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                    }
                    echo "<td class='text-center'>$recomendacao</td>";
                    echo "</tr>";
                }
            }
            ?>
            <?php
            foreach ($listagensAdicionais as $listagem) {
                echo "<tr class='text-center'>";
                echo "<td class='text-center'> <a href='" . base_url('atendimento/senha/' . base64_encode($listagem->id)) . "'> $listagem->senha </a> </td>";
                echo "<td class='text-center'>" . dates($listagem->entrada) . "</td>";
                if (isset($listagem->saida)) {
                    $saida = dates($listagem->saida);
                } else {
                }
                echo (isset($listagem->saida)) ? '<td>' . dates($listagem->saida) . '</td>' : ' <td>Não foi registrado saída</td>';


                $retorno = 0;
                if ($listagem->saida == null) {
                    $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                } else {
                    $retorno =  date("d/m/Y", strtotime("+1 month", strtotime($listagem->saida)));
                }
                echo "<td class='text-center'>$retorno</td>";
                if ($retorno != 0) {

                    $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(reverseDates($retorno))));
                } else {
                    $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                }
                echo "<td class='text-center'>$recomendacao</td>";
                echo "</tr>";
            }
            ?>
        </table>

    </div>
    <?= $this->endSection() ?>

    <?= $this->section('script') ?>
    <!-- Script -->
    <script>
        function preencherModalDelete(id) {
            modal = document.getElementById("deleteModal");
            btnExcluir = modal.getElementsByClassName("btn-danger")[0];
            btnExcluir.setAttribute('dado-alvo', id);
        }

        $('#btnDeletar').on('click', function() {
            var id = btnExcluir.getAttribute('dado-alvo', id);
            // id = 3;
            $.ajax({
                url: '<?= base_url('atendimento/deletar') ?>',
                type: 'post',
                dataType: 'json',

                data: {
                    id: id
                },
                success: function(data) {
                    msg = document.querySelector('#msgInfo');
                    alerta = document.querySelector('#alerta');
                    if (data) {
                        alerta.classList.add('alert-success');
                        msg.textContent = 'Excluido com sucesso!';
                        setTimeout(() => {
                            window.location.href = "/cihecel/public";
                        }, 1000)
                    } else {
                        alerta.classList.add('alert-danger');
                        msg.textContent = 'Erro ao excluir o paciente!';
                    }
                    new bootstrap.Toast(document.querySelector('#basicToast')).show();
                    document.querySelector('#fecharModal').click();
                    document.querySelector('#tr' + id).remove();


                }
            });
        });

        function Editobservacao() {
            let obs = document.getElementById('cardObs');
            obs.classList.add('hidden');

            let form = document.getElementById('form');
            form.classList.remove('hidden');
        }

        function reverse() {
            let obs = document.getElementById('cardObs');
            obs.classList.remove('hidden');

            let form = document.getElementById('form');
            form.classList.add('hidden');
        }

        function dateManual(id) {

            let manual = document.getElementById('manual_' + id);
            manual.classList.remove('showbutton');
            manual.classList.add('hiddenbutton');
            let automatico = document.getElementById('automatico_' + id);
            automatico.classList.remove('showbutton');
            automatico.classList.add('hiddenbutton');
            let input = document.getElementById('inputManual_' + id);
            input.classList.remove('hiddenbutton');
            input.classList.add('showForm');
            let submitManual = document.getElementById('buttonManual_' + id);
            submitManual.classList.remove('hiddenbutton');
            submitManual.classList.add('showForm');
            let x = document.getElementById('x_' + id);
            x.classList.remove('hiddenbutton');
            x.classList.add('showbutton');
            x.classList.add('x');
        }

        function reverseDateManual(id) {
            let manual = document.getElementById('manual_' + id);
            manual.classList.remove('hiddenbutton');
            manual.classList.add('showbutton');
            let automatico = document.getElementById('automatico_' + id);
            automatico.classList.remove('hiddenbutton');
            automatico.classList.add('showbutton');
            let input = document.getElementById('inputManual_' + id);
            input.classList.remove('showForm');
            input.classList.add('hiddenbutton');
            let submitManual = document.getElementById('buttonManual_' + id);
            submitManual.classList.remove('showForm');
            submitManual.classList.add('hiddenbutton');
            let x = document.getElementById('x_' + id);
            x.classList.remove('showbutton');
            x.classList.remove('x');
            x.classList.add('hiddenbutton');
        }

        <?php
        if (isset($_SESSION['mensagem'])) {
            echo "msg = document.querySelector('#msgInfo');
             alerta = document.querySelector('#alerta');
             alerta.classList.add('" . $_SESSION['mensagem']['tipo'] . "');
             msg.textContent = '" . $_SESSION['mensagem']['mensagem'] . "';
             new bootstrap.Toast(document.querySelector('#basicToast')).show();";
        }
        ?>
    </script>
    <?= $this->endSection() ?>
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
        echo ($_SESSION['usuario']['user']->tipo == '1') ? "<a class='edit me-1' href='" . base_url('atendimento/editar/' . base64_encode($resultado->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true' title='Editar Cadastro'></i> </span></a><button class='edit' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $resultado->id . ")' ><span><i class='fa fa-trash' aria-hidden='true' title='Deletar Cadastro'></i> </span></button> " : '';
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
                                                foreach($legados as $legado){
                                                echo $resultado->obs . "</br>";
                                                echo dates($legado->entrada) . " " . $legado->obs. "</br>";
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
                    <textarea name="obs" id="comentario" class="form-control" name="obs" minlength="5" value="<?= isset($legados->obs)? $legados->obs : '' ?>" required><?= isset($legados->obs)? $legados->obs : $resultado->obs ?></textarea>
                    <input name="id" type="text" style="display:none;" value="<?= base64_encode($resultado->id); ?>">
                    <div class="row" style="padding-top:10px;width:100%;">
                        <div class="col-9"><a style="margin:0 1.5em;" id="reverse" onclick="reverse()" class="btn btn-secondary btn-sm">Voltar</a></div>
                        <div class="col-3"><button type="submit" class="btn btn-primary btn-sm float-end">Registrar</button></div>
                    </div>
                </form>
            </div>
        </div>
        <h2 style="text-align:center;">Histórico de Listagem</h2>
        <table class="table table-striped" style="width:100%;">
            <tr>
                <th>Senha</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Retorno</th>
                <th>Recomendação</th>
            </tr>
            <?php
            if (isset($legados)) {
                foreach ($legados as $legado) {
                    echo "<tr>";
                    echo "<td>" . (isset($legado->senha)? $legado->senha : 'Não Tem') . "</td>";
                    echo "<td>" . dates($legado->entrada) . "</td>";
                    if (isset($legado->saida)) {
                        $saida = dates($legado->saida);
                    } else {
                    }
                    echo (isset($legado->saida)) ? '<td>' . dates($legado->saida) . '</td>' : ' <td>Não foi registrado saída</td>';


                    $retorno = 0;
                    if ($legado->saida == null) {
                        $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                    } else {
                        $retorno =  date("d/m/Y", strtotime("+1 month", strtotime($legado->saida)));
                    }
                    echo "<td>$retorno</td>";
                    if ($retorno != 0) {

                        $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(reverseDates($retorno))));
                    } else {
                        $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                    }
                    echo "<td>$recomendacao</td>";
                    echo "</tr>";
                }
            }


                foreach ($listagens as $listagem) {
                    echo "<tr>";
                    echo "<td> <a href='" . base_url('atendimento/senha/' . base64_encode($listagem->id)) . "'> $listagem->senha </a> </td>";
                    echo "<td>" . dates($listagem->entrada) . "</td>";
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
                    echo "<td>$retorno</td>";
                    if ($retorno != 0) {

                        $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(reverseDates($retorno))));
                    } else {
                        $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                    }
                    echo "<td>$recomendacao</td>";
                    echo "<td></td>";
                    echo "</tr>";
                } ?>
            <?php
                foreach ($listagensAdicionais as $listagem) {
                    echo "<tr>";
                    echo "<td> <a href='" . base_url('atendimento/senha/' . base64_encode($listagem->id)) . "'> $listagem->senha </a> </td>";
                    echo "<td>" . dates($listagem->entrada) . "</td>";
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
                    echo "<td>$retorno</td>";
                    if ($retorno != 0) {

                        $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(reverseDates($retorno))));
                    } else {
                        $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                    }
                    echo "<td>$recomendacao</td>";
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
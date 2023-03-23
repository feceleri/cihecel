<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    @media print {
        .print {
            display: none;
        }

        .ajuste {
            margin-right: 150em;
        }
    }

    .row {
        margin-right: -40px;
    }

    h3 {
        font-size: 13px;
    }

    .table {
        width: 29em;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<?php function dates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('-', '/', $orgDate);
    $newDate = date("d/m/Y", strtotime($date));
    return $newDate;
}

function Reversedates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('/', '-', $orgDate);
    $newDate = date("d-m-Y", strtotime($date));
    return $newDate;
} ?>

<ol class="breadcrumb print">
    <li class="breadcrumb-item"><a href="javascript:history.go(-1)">Perfil</a></li>
    <li style='text-transform:capitalize' class="breadcrumb-item active" aria-current="page">Listagem senha : <?= $responsavel->senha ?> Responsável - <?= $responsavel->nome ?></li>
</ol>

<div class="card-box ajuste" style="width:455px">
    <h2>Informações</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="text-end">NC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-transform: capitalize;"><span><?= $responsavel->nome ?></td>
                <td class="text-end" style="text-transform: capitalize;"><span><?= $responsavel->idPaciente ?></span></td>
            </tr>
            <?php
            if (($responsavel->idsAdicional != '0')) {
                foreach ($adicionais as $adicional) {
                    echo '<tr>';
                    echo '<th colspan="2">Adicional</th>';
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td style='text-transform: capitalize;'>" . $adicional->nome . "</td>";
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <br>
    <h2>Datas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Entrada</th>
                <th class="text-end mr-2">Saída</th>
            </tr>
        </thead>
        <tbody>
            <?php
            echo "<tr>";
            echo "<td>" . dates($responsavel->entrada) . "</td>";
            echo   $responsavel->saida == null ? "<td class='text-end'> <i class='fa fa-times' aria-hidden='true'></i> </td> " : "<td class='text-end'>" . dates($responsavel->saida) . "</td>";
            echo "</tr>";

            ?>
        </tbody>
    </table>
    <br>
    <div>
        <h5>Números do responsável <span style='text-transform:capitalize'> <?= $responsavel->nome ?>: </span> </h5>
        <p>Telefone 1:&nbsp;<?php
                            if ($responsavel->telefone1 != null) {
                                echo $responsavel->telefone1;
                            } else {
                                echo 'Número não registrado no sistema.';
                            }
                            ?></p>

        <p>Telefone 2:&nbsp;<?php
                            if ($responsavel->telefone2 != null) {
                                echo $responsavel->telefone2;
                            } else {
                                echo 'Número não registrado no sistema.';
                            }
                            ?></p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
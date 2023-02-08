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
    <li class="breadcrumb-item"><a href="<?= base_url('atendimento/listagem') ?>">Listagem</a></li>
    <li  style='text-transform:capitalize' class="breadcrumb-item active" aria-current="page">Listagem senha : <?= $responsavel->senha ?>   Responsável - <?= $responsavel->nome ?></li>
</ol>

<div class="card-box ajuste" style="width:455px">
    <h2>Informações</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>QTD Receitas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-transform: capitalize;"><?= $responsavel->nome ?></td>
                <td><?= $responsavel->qtdReceitaResponsavel ?></td>
            </tr>
            <?php
            if (($responsavel->idsAdicional != '0')) {
                foreach ($adicionais as $adicional) {
                    echo '<tr>';
                    echo "<td style='text-transform: capitalize;'>" . $adicional->nome . "</td>";

                    echo "<td>" . $adicional->qtd . "<td>";
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
                <th>Saída</th>
                <th>Retorno</th>
                <th>Recomendação</th>
            </tr>
        </thead>
        <tbody>
            <?php
           echo "<tr>";
           echo "<td>" . dates($responsavel->entrada). "</td>" ;

           echo   $responsavel->saida == null ? "<td> <i class='fa fa-times' aria-hidden='true'></i> </td> " : "<td>".dates($responsavel->saida)."</td>" ;
            $retorno = 0;
            if ($responsavel->saida == null) {
                $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
            } else {
                $retorno =  date("d/m/Y", strtotime("+1 month", strtotime($responsavel->saida)));
            }
            echo "<td style='text-align:center;'>$retorno</td>";
            if ($retorno != 0) {

                $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(Reversedates($retorno))));
            } else {
                $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
            }
            echo "<td style='text-align:center;'>$recomendacao</td>";
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
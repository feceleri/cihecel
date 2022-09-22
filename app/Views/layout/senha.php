<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    @media print {
        .print {
            display: none;
        }
    }
        .row{
            margin-right: -40px;
        }
        h3{
            font-size: 13px;
        }

        .table{
            width: 29em;
        }

</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<ol class="breadcrumb print">
    <li class="breadcrumb-item"><a href="<?= base_url('public/atendimento/listagem') ?>">Listagem</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listagem senha : <?= $responsavel->senha ?> Responsável - <?= $responsavel->nome ?></li>
</ol>

<div class="card-box" style="width:455px">
    <div class="row">
        <div class="col-3">
            <h3>Senha: <?= $responsavel->senha ?> </h3>
        </div>
        <div class="col-4">
            <?php
            $entradaData = $responsavel->saida;
            $entradaData = date('d/m/Y');
            ?>
            <h3>Entrada: <?= $entradaData ?> </h3>
        </div>
        <div class="col-4">

            <h3>Saída:&nbsp;<?php if (isset($responsavel->saida)) {
                                $saida = $responsavel->saida;
                                $saida = date('d/m/Y');
                                echo $saida;
                            } else {
                                echo 'Não foi registrado a saída.';
                            } ?> </h3>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>QTD Receitas</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $responsavel->nome ?></td>
                <td><?= $responsavel->cpf ?></td>
                <td><?= $responsavel->qtdReceitaResponsavel ?></td>
            </tr>
            <?php
            if (($responsavel->idsAdicional != '0')) {
                foreach ($adicionais as $adicional) {
                    echo '<tr>';
                    echo "<td>" . $adicional->nome . "</td>";
                    echo "<td>" . $adicional->cpf . "</td>";
                    echo "<td>" . $adicional->qtd . "<td>";
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
    <br>
    <div>
        <h5>Números do responsável <?= $responsavel->nome ?>: </h5>
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
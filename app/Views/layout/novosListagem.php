<?php

use App\Libraries\Resource;

$resources = new Resource;
?>
<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    i:hover {
        color: #009ce7;
    }

    .show{
        display:block;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relátorio</li>
    </ol>
</nav>
<div class="card-box row">
   <!-- Listagem -->
   <div id="listagem">
        <div class="row">
            <div class="col-6"><h3>Pesquisa Listagem</h3></div>
            <div class="col-6 text-end"> <a class="btn btn-primary" href="<?=base_url('public/atendimento/novos')?>">Pacientes</a> </div>
        </div>
        <form action="<?= base_url('public/atendimento/novos') ?>" method="post">
            <div class="row">
                <div class="col-4"><label for="dataPaciente">Digite uma data:</label>
                    <input type="date" name="dataListagem">
                    <button style="border:none; background:none;" type="submit"><i class="fa fa-search"></i>
                </div>
            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Criado em</th>
                    <th>CPF</th>
                    <th style="text-align: center;">Senha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($listagem)) {
                    echo  "Total de " . sizeof($listagem) . " registros.";
                    foreach ($listagem as $value) {
                        echo "<tr>";
                        echo "<td>" . $resources->dates($value->entrada) . "</td>";
                        echo "<td>" . $value->cpfResponsavel . "</td>";
                        echo  "<td style='text-align:center;'> <a href='" . base_url('public/atendimento/senha/' . base64_encode($value->id)) . "'> " . $value->senha . "</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<h2>Digite uma data!</h2>";
                }

                ?>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
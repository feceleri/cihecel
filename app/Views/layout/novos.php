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
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Relatórios</li>
    </ol>
</nav>

<div class="card-box row">
    <!-- Pacientes -->
    <div id="paciente">
        <div class="row">
            <div class="col-6">
                <h3>Pesquisa Pacientes</h3>
            </div>
            <div class="col-6 text-end"> <a class="btn btn-primary" href="<?= base_url('atendimento/novosListagem') ?>">Listagem</a> </div>
        </div>
        <form action="<?= base_url('atendimento/novos') ?>" method="post">
            <div class="row">
                <div class="col-4"><label for="dataPaciente">Digite uma data:</label>
                    <input type="date" name="dataPaciente">
                    <button style="border:none; background:none;" type="submit"><i class="fa fa-search"></i>
                </div>

            </div>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Registrado em</th>
                    <th>NC</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($paciente)) {
                    echo  "Total de " . sizeof($paciente) . " registros.";
                    foreach ($paciente as $value) {
                        echo "<tr>";
                        echo "<td>" . $resources->dates($value->created_at) . "</td>";
                        echo "<td>" . $value->id . "</td>";
                        echo "<td style='text-transform:capitalize;'><a href='" . base_url('atendimento/perfil/' . base64_encode($value->id)) . "'>" . $value->nome . "</a></td>";
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
<script>
    function hiddenShow() {
        let tablePaciente = document.getElementById('paciente');
        tablePaciente.classList.add('hidden');

        let tableListagem = document.getElementById('listagem');
        tableListagem.classList.remove('hidden');
        tableListagem.classList.add('show');
    }
</script>
<?= $this->endSection() ?>
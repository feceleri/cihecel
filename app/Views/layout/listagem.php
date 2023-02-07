<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />
<style>
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
    .pagination>.active>a{
        background-color: #dde4e9;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listagem</li>
    </ol>
</nav>

<p>Foram cadastradas <?php
                        $cadastros = 0;

                        foreach ($date as $value) {
                            if ($value->entrada == date("Y-m-d")) {
                                $cadastros = $cadastros + 1;
                            }
                        }
                        echo $cadastros;
                        ?> novas listagens hoje.</p>

<div class="card-block">
    <?= $this->include('tabelas/tabelaListagem'); ?>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>


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
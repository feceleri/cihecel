<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<style>
    #response {

        display: none;
        align-content: center;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: auto;
    }

    .show {
        display: flex !important;
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/atendimento/legados') ?>">Atendimento</a></li>
        <?php if (isset($editar)) {
            echo '<li class="breadcrumb-item active" aria-current="page">Edição</li>';
        } else {
            echo '<li class="breadcrumb-item active" aria-current="page">Cadastro</li>';
        }
        ?>

    </ol>
</nav>

<?= $this->include('formularios/legadoForm.php') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script CEP -->
<script>

    var buttonForm = document.getElementById('buttonForm');
    // var cpf = document.querySelector('#cpf');

    // <?php
        //      if (isset($_SESSION['mensagem'])) {
        //          echo "msg = document.querySelector('#msgInfo');
        //          alerta = document.querySelector('#alerta');
        //          alerta.classList.add('".$_SESSION['mensagem']['tipo']."');
        //          msg.textContent = '".$_SESSION['mensagem']['mensagem']."';
        //          new bootstrap.Toast(document.querySelector('#basicToast')).show();";
        //      }
        // 
        ?>
</script>






<?= $this->endSection() ?>
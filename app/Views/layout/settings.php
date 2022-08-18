<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('/public') ?>"><?= $_SESSION['usuario']['user']->nome; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">Configurações</li>
    </ol>
</nav>

<div class="card-box row">
    <div class="col">
        <div class="block">

            <h5><?= $_SESSION['usuario']['user']->nome; ?>&nbsp;<?= $_SESSION['usuario']['user']->sobrenome; ?></h5>

            <p class="card-text">User: <?= $_SESSION['usuario']['user']->user; ?></p>
            <p class="card-text">E-mail: <?= $_SESSION['usuario']['user']->email; ?></p>
            <p class="card-text">Permissão: <?= $_SESSION['usuario']['user']->tipo; ?> </p>

            <a class="btn btn-primary" href="<?= base_url('public/login/editar') ?>">Editar</a>
        </div>
    </div>
</div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->

<?= $this->endSection() ?>
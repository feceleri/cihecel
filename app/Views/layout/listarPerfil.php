<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->

<?= $this->include('tabelas/tabelaPrincipal.php')?>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
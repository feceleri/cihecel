<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    tbody tr td a {
        color: black;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url('public')?>">Atendimento</a></li>
    <li class="breadcrumb-item active" aria-current="page">Novo Atendimento</li>
  </ol>
</nav>
<a class="btn btn-success mb-3" href="<?= base_url('public/atendimento/cadastro')?>" style="float:right;top:5px"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
<?= $this->include('tabelas/tabelaPrincipal.php')?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script CEP -->
<?= $this->endSection() ?>
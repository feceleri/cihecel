<?= $this->extend('layout/principal') ?>
<?= $this->section('conteudo') ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Atendimento</li>
  </ol>
</nav>
<div class="container">
    <div class="row align-items-center" style="height:80vh">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Novo atendimento</h5>
                    <p class="card-text">Clique em adicionar para iniciar um novo atendimento.</p> <a href="<?=base_url('public/atendimento/novoAtendimento')?>" class="btn btn-primary">Adicionar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
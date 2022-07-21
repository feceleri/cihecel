<?= $this->extend('layout/principal') ?>
<?= $this->section('conteudo') ?>
<div class="container">
    <div class="row align-items-center" style="height:80vh">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Novo atendimento</h5>
                    <p class="card-text">Clique em adicionar para iniciar um novo atendimento.</p> <a href="#" class="btn btn-primary">Adicionar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Novo paciente</h5>
                    <p class="card-text">Clique em cadastrar para registrar um novo paciente.</p> <a href="<?=base_url('public/home/cadastro')?>" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
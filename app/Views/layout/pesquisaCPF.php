<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('public') ?>">Atendimento</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('public/atendimento/novoAtendimento') ?>">Novo Atendimento</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil </li>
</ol>


<div class="row align-items-center" style="height:80vh">
    <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('public/atendimento/pesquisaCPF')?>" method="POST">
                        <h4>Encontrar cadastro pelo CPF do paciente</h4>
                        <label for="cpf" class="card-text">Insira o CPF:</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" required><br><br>
                        <button type="submit" class="btn btn-primary" id="pesquisar">Pesquisar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<div class="card-box" style="width:360px;">
    <div class="col-12">
        <div class="block">

            <h5><?= $_SESSION['usuario']['user']->nome;?>&nbsp;<?= $_SESSION['usuario']['user']->sobrenome;?></h5>
            
          
           
            <p class="card-text">User: <?= $_SESSION['usuario']['user']->user;?></p>
            <p class="card-text">E-mail: <?= $_SESSION['usuario']['user']->email;?></p>
            <p class="card-text">Permissão: <?= $_SESSION['usuario']['user']->tipo;?></p>



            <div class="btn-group dropup">
                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu dropup">
                    <a class="dropdown-item" href="http://localhost/e-comerce/public/usuario/editar/4">Editar usuário</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
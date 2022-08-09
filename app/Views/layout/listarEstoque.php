<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<!-- <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Medicamento - </li>
</ol> -->
<div class="row">
    <div class="block col-6" style="padding: 20px;">    
        <ul class="list-group">
            <li class="list-group-item col-12"><span>ID:</span>&nbsp;<?= $resultado[0]->id ?></li>
            <li class="list-group-item"><span>Quantidade:&nbsp;</span><?= $resultado[0]->quantidade ?></li>
            <li class="list-group-item"><span>Medicamento:</span>&nbsp;<?= $resultado[0]->nomeMed ?></li>          
        </ul>
        
    </div>

</div>



<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
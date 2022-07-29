<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    div.row div ul li span {
        color: blue;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('public') ?>">Atendimento</a></li>
    <li class="breadcrumb-item"><a href="<?= base_url('public/atendimento/novoAtendimento') ?>">Novo Atendimento</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil - Guilherme Cardoso</li>
</ol>
<div class="row">
    <div class="block col-6" style="padding: 20px;">    
        <ul class="list-group">
            <li class="list-group-item col-12"><span>Nome:</span>&nbsp;Guilherme Cardoso</li>
            <li class="col-12 list-group-item">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>CPF:</span>&nbsp;500.011.878-21</li>
                    <li class="col-6" style="list-style-type: none;"><span>RG:</span>&nbsp;32.569.445-5</li>
                </ul>
            </li>
            <li class="list-group-item"><span>Nome da Mãe:&nbsp;</span>Maria teste Silva</li>
            <li class="col-12 list-group-item">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>Telefone 1:</span>&nbsp;(11) 3666-1245</li>
                    <li class="col-6" style="list-style-type: none;"><span>Telefone 2:</span>&nbsp;(11) 3666-1245</li>
                </ul>
            </li>
            <li class="list-group-item"><span>Endereço:</span>&nbsp;Rua Capote Valente, 487</li>
            <li class="col-12 list-group-item">
                <ul class="list-group list-group-horizontal row">
                    <li class="col-6" style="list-style-type: none;"><span>Bairro:</span>&nbsp;Pinheiros</li>
                    <li class="col-6" style="list-style-type: none;"><span>CEP:</span>&nbsp;05409-001</li>
                </ul>
            </li>            
        </ul>
        <br>
        <input class="btn btn-primary" type="file" id="anexo_documentos" name="anexo_documentos[]" multiple="" onchange="validaFiles(this);" accept="application/pdf, image/jpeg">

    </div>



    <div class="col-6">
        <div class="row-6">1</div>
        <div class="row-6">2</div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<?= $this->endSection() ?>
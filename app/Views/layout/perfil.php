<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    div.row div ul li span {
        color: blue;
    }

    #edit{
        cursor: pointer;
    }
    #edit:hover{
        color:	#6A5ACD ;
    }

    .hidden{
        display:none;
    }
    .check{
        margin-left: 24em;
        margin-top: 10px;
    }
    .checkReverse{
        margin-top: 10px;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= base_url('public') ?>">Paciente</a></li>
    <li class="breadcrumb-item active" aria-current="page">Perfil - <?= $resultado->nome ?></li>
</ol>
<div class="card-box">
    <div class="row">
        <div class="block col-7" style="padding: 20px;">
            <ul class="list-group">
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none;"><span>Nome:</span>&nbsp;<?= $resultado->nome ?></li>
                        <li class="col-6" style="list-style-type: none;"><span>Sexo:</span>&nbsp;<?= $resultado->sexo ?></li>
                    </ul>
                </li>
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none;"><span>CPF:</span>&nbsp;<?= $resultado->cpf ?></li>
                        <li class="col-6" style="list-style-type: none;"><span>RG:</span>&nbsp;<?= $resultado->rg ?></li>
                    </ul>
                </li>
                <li class="list-group-item"><span>Nome da Mãe:&nbsp;</span><?= $resultado->nomeMae ?></li>
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none;"><span>Telefone 1:</span>&nbsp;<?= $resultado->telefone1 ?></li>
                        <li class="col-6" style="list-style-type: none;"><span>Telefone 2:</span>&nbsp;<?= $resultado->telefone2 ?></li>
                    </ul>
                </li>
                <li class="list-group-item"><span>Endereço:</span>&nbsp;<?= $resultado->logradouro ?>, <?= $resultado->numeroCasa ?> <?= $resultado->complementoCasa ?></li>
                <li class="col-12 list-group-item">
                    <ul class="list-group list-group-horizontal row">
                        <li class="col-6" style="list-style-type: none;"><span>Bairro:</span>&nbsp;<?= $resultado->bairro ?></li>
                        <li class="col-6" style="list-style-type: none;"><span>CEP:</span>&nbsp;<?= $resultado->cep ?></li>
                    </ul>
                </li>
            </ul>
            <br>

        </div>
        <div class="card col-5" id="cardObs" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">Observação: <a id="edit" onclick="Editobservacao()" style="margin-left: 11em;" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a></h5>
                <h6 class="card-subtitle mb-2 text-muted"> <?= $resultado->nome?>,</h6> <br>
                <p class="card-text"><?php  if(isset($resultado->obs)){
                 echo $resultado->obs;
                }else{
                    echo 'Não á nenhuma observação registrada.';
                }
                ?></p>
            </div>
        </div>
        <div class="col-5">
            <form action="<?=base_url('public/atendimento/obs')?>" id="form" class="hidden" method="post">
                <label for="comentario">Observação:</label>
                <textarea name="obs" id="comentario" class="form-control" name="obs" minlength="5" required><?=$resultado->obs?></textarea>
                <input name="id" type="text" style="display:none;" value="<?=$resultado->id?>">
                <div class="row" style="padding-top:10px;">
                    <div class="col-9"><a id="reverse" onclick="reverse()" class="btn btn-secondary btn-sm">Voltar</a></div>
                    <div class="col-3"><button type="submit" class="btn btn-primary btn-sm">Registrar</button></div>
                </div>
            </form>
        </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script>
    function Editobservacao(){
        let obs = document.getElementById('cardObs');
        obs.classList.add('hidden');

        let form = document.getElementById('form');
        form.classList.remove('hidden');
    }

    function reverse(){
        let obs = document.getElementById('cardObs');
        obs.classList.remove('hidden');

        let form = document.getElementById('form');
        form.classList.add('hidden');
    }

    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "msg = document.querySelector('#msgInfo');
             alerta = document.querySelector('#alerta');
             alerta.classList.add('" . $_SESSION['mensagem']['tipo'] . "');
             msg.textContent = '" . $_SESSION['mensagem']['mensagem'] . "';
             new bootstrap.Toast(document.querySelector('#basicToast')).show();";
    }
    ?>
</script>
<?= $this->endSection() ?>
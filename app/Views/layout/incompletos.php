<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    #ajaxTable tr td:last-child div {
        display: flex;
        align-items: center;
    }

    #ajaxTable button, #ajaxTable a{
        font-size: 16px;
        line-height: 30px;
        text-transform: capitalize
    }

    #ajaxTable button:hover, #ajaxTable a:hover{
        color: #009ce7;
    }

    button {
        border: none;
        background-color: transparent;
    }

    table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){
        padding: none !important;
    }
</style>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" /> -->
<style>
    tbody tr td a {
        color: black;
    }

    div.dataTables_length select {
        width: 60px !important;
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Pacientes com cadastro incompleto (sem CPF)</li>
    </ol>
</nav>
<?= $this->include('tabelas/tabelaPrincipal.php') ?>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><span class="text-danger font-weight-bold">DELETAR </span>Cadastro</h5>
                <button type="button" id="fecharModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você realmente deseja <span class="text-danger font-weight-bold">EXCLUIR</span> esse paciente do sistema?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" id="btnDeletar">Excluir</a>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    function preencherModalDelete(id) {
        modal = document.getElementById("deleteModal");
        btnExcluir = modal.getElementsByClassName("btn-danger")[0];
        btnExcluir.setAttribute('dado-alvo', id);
    }

    $('#btnDeletar').on('click', function() {
        var id = btnExcluir.getAttribute('dado-alvo', id);
        // id = 3;
        $.ajax({
            url: '<?= base_url('atendimento/deletar') ?>',
            type: 'post',
            dataType: 'json',

            data: {
                id: id
            },
            success: function(data) {
                msg = document.querySelector('#msgInfo');
                alerta = document.querySelector('#alerta');
                if (data) {
                    alerta.classList.add('alert-success');
                    msg.textContent = 'Excluido com sucesso!';
                } else {
                    alerta.classList.add('alert-danger');
                    msg.textContent = 'Erro ao excluir o paciente!';
                }
                new bootstrap.Toast(document.querySelector('#basicToast')).show();
                document.querySelector('#fecharModal').click();
                document.querySelector('#tr' + id).remove();


            }
        });
    });


    window.onload =  function resetAllCpf(cpf){
        cpf=document.getElementById('tdCpf');
        console.log(cpf)
        
        cpf.value.replace(/\D/g, '')

        cpf = cpf.replace(/\D/g, "").slice(0, 11);
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
        return cpf;
    }

    <?php         
         if (isset($_SESSION['mensagem'])) {
             echo "msg = document.querySelector('#msgInfo');
             alerta = document.querySelector('#alerta');
             alerta.classList.add('".$_SESSION['mensagem']['tipo']."');
             msg.textContent = '".$_SESSION['mensagem']['mensagem']."';
             new bootstrap.Toast(document.querySelector('#basicToast')).show();";
         }
    ?>
</script>

<?= $this->endSection() ?>
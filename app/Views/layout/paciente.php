<?= $this->extend('layout/principal') ?>

<?= $this->section('conteudo') ?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Paciente</li>
    </ol>
</nav>

<p>
    Foram cadastradas
    <?php
    $db = db_connect();
    $query = $db->query('SELECT COUNT(*) AS hoje FROM `paciente` WHERE `created_at` = CURDATE()');
    $db->close();
    foreach ($query->getResult() as $row) {
        echo $row->hoje;
    }
    ?>
    novas pessoas hoje.
</p>
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
<!-- Script -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script> -->


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
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 100)
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


    window.onload = function resetAllCpf(cpf) {
        cpf = document.getElementById('tdCpf');
        console.log(cpf)

        cpf.value.replace(/\D/g, '')

        cpf = cpf.replace(/\D/g, "").slice(0, 11);
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
        return cpf;
    }

    // function RetiraMascara(ObjCPF) {
    // return ObjCPF.value.replace(/\D/g, '');
    // }


    // function mascaraCPF(cpf) {
    //     cpf = cpf.replace(/\D/g, "").slice(0, 11);
    //     cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    //     cpf = cpf.replace(/^(\d{3}\.\d{3})(\d)/, "$1.$2");
    //     cpf = cpf.replace(/(.{11})(\d)/, "$1-$2");
    //     return cpf;
    // } // 12345678910 -> 123.456.789-10


    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "msg = document.querySelector('#msgInfo');
             alerta = document.querySelector('#alerta');
             alerta.classList.add('" . $_SESSION['mensagem']['tipo'] . "');
             msg.textContent = '" . $_SESSION['mensagem']['mensagem'] . "';
             new bootstrap.Toast(document.querySelector('#basicToast')).show();";
    }
    ?>

    $(document).ready(function() {
        $('#ajaxTable').DataTable({
            ajax: '<?= base_url('pacientes') ?>',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
            },
            deferRender: true,
            order: [ 0, 'desc' ],
        });
    });
</script>

<?= $this->endSection() ?>

<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    #ajaxTable tr td:last-child div {
        display: flex;
        align-items: center;
    }

    a.pencil {
        margin: 0 5px;
        font-size: 16px;
        line-height: 30px;
    }

    a.pencil:hover {
        font-size: 20px;
        margin-right: 1.6px;
    }

    button.eraser {
        /* color:red; */
        font-size: 16px;
        line-height: 30px;
    }

    button.eraser:hover {
        font-size: 20px;
        color: #009ce7;
    }

    button {
        border: none;
        background-color: transparent;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />
<style>
    tbody tr td a {
        color: black;
    }

    div.dataTables_length select {
        width: 65px !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('conteudo') ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Paciente</li>
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

<div class="toast-container position-fixed bottom-0 end-0 p-3" style="top: 10px; right: 10px; z-index: 9999;">
    <div id="basicToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="1000">
        <div class="alert" style="margin-bottom: 0;" id="alerta">
            <span id="msgInfo"></span>
            <button type="button" class="btn-close btn-close-black float-end" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>


<script>
    function preencherModalDelete(id) {
        modal = document.getElementById("deleteModal");
        btnExcluir = modal.getElementsByClassName("btn-danger")[0];
        btnExcluir.setAttribute('data-target', id);
    }

    $('#btnDeletar').on('click', function() {
        var id = btnExcluir.getAttribute('data-target', id);
        // id = 3;
        $.ajax({
            url: '<?= base_url('public/atendimento/deletar') ?>',
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


    $(document).ready(function() {
        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ pacientes",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 pacientes",
            "sInfoFiltered": "(Filtrados de _MAX_ pacientes)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "select": {
                "rows": {
                    "_": "Selecionado %d linhas",
                    "0": "Nenhuma linha selecionada",
                    "1": "Selecionado 1 linha"
                }
            }
        }
        $('#ajaxTable').DataTable({
            "oLanguage": DATATABLE_PTBR,
            ajax: '',
            columns: [{
                    data: 'Nome'
                },
                {
                    data: 'CPF'
                },
                {
                    data: 'Data de nascimento'
                },
                {
                    data: 'status'
                },


            ],
        });
    });
    <?php
    if (session('mensagem')) {
        $certo = session('mensagem');
        if ($certo) {
            echo "msg = document.querySelector('#msgInfo');
        alerta = document.querySelector('#alerta');
        alerta.classList.add('alert-success');
        msg.textContent = 'Paciente cadastrado com sucesso!';
        new bootstrap.Toast(document.querySelector('#basicToast')).show();";
        } else {
            echo "msg = document.querySelector('#msgInfo');
        alerta = document.querySelector('#alerta');
        alerta.classList.add('alert-danger');
        msg.textContent = 'Não foi possível cadastrar!';
        new bootstrap.Toast(document.querySelector('#basicToast')).show();";
        }
    }
    ?>
</script>

<?= $this->endSection() ?>
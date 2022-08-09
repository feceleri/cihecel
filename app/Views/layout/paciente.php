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
<a class="btn btn-success mb-3" href="<?= base_url('public/atendimento/cadastro') ?>" style="float:right;top:5px"><i class="fa fa-user-plus" aria-hidden="true"></i></a>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><span class="text-danger font-weight-bold">DELETAR </span>Cadastro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você realmente deseja <span class="text-danger font-weight-bold">EXCLUIR</span> esse paciente do sistema?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger" href="<?= base_url('public/atendimento/deletar/') ?>">Excluir</a>
            </div>
        </div>
    </div>
</div>

<?= $this->include('tabelas/tabelaPrincipal.php') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

<!-- JavaScript Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


<script>
    function preencherModalDelete(id) {
        modal = document.getElementById("deleteModal");
        btnExcluir = modal.getElementsByClassName("btn-danger")[0];
        link = "<?= base_url('public/atendimento/deletar/') ?>/"+id;        
        btnExcluir.setAttribute('href', link);
    }

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
</script>

<?= $this->endSection() ?>
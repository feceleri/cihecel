<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->
<style>
    #ajaxTable tr td:last-child div {
        display: flex;
        align-items: center;
    }

    a.pencil  {
        margin: 0 5px;
        font-size: 16px;
        line-height: 30px;
    }

    a.pencil:hover {
        font-size: 20px;
        margin-right: 1.6px;
    }

    a.eraser  {
        /* color:red; */
        font-size: 16px;
        line-height: 30px;
    }

    a.eraser:hover  {
        font-size: 20px;
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
<?= $this->include('tabelas/tabelaPrincipal.php') ?>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>

<script>
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
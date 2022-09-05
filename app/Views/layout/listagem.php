<?= $this->extend('layout/principal') ?>

<?= $this->section('css') ?>
<!-- Style -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.css" />
<style>
    div.table-responsive>div.dataTables_wrapper>div.row {
        margin: 0;
    }

    td {
        height: 30px;
    }
    i.fa.fa-book {
        font-size: 17px;
    }

    .table.dataTable td a#check {
        font-size: 20px;
    }
    .table.dataTable td a#check:hover {
        font-size: 20px;
        cursor: pointer;
        color: #55ce63;
    }
    table tbody td.sorting_1 a:hover {
        font-size: 20px;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('conteudo') ?>
<!-- Conteudo -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Listagem</li>
    </ol>
</nav>

<div class="card-block">
    <?= $this->include('tabelas/tabelaListagem'); ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Script -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.12.1/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        const DATATABLE_PTBR = {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registro",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registro",
            "sInfoFiltered": "(Filtrados de _MAX_ registro)",
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
        $('#ajaxTableListagem').DataTable({
            "oLanguage": DATATABLE_PTBR,
            ajax: '',
            columns: [{
                    data: 'Senha'
                },
                {
                    data: 'Responsável'
                },
                {
                    data: 'CPF'
                },
                {
                    data: 'Entrada'
                },
                {
                    data: 'Saída'
                },

            ],
        });
    });

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
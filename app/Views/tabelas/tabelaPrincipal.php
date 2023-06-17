<style>
    #ajaxTable tr td:last-child div {
        display: flex;
        align-items: center;
    }

    #ajaxTable button,
    #ajaxTable a {
        font-size: 16px;
        line-height: 30px;
        text-transform: capitalize
    }

    #ajaxTable button:hover,
    #ajaxTable a:hover {
        color: #009ce7;
    }

    button {
        border: none;
        background-color: transparent;
    }

    table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled) {
        padding: none !important;
    }

    tbody tr td a {
        color: black;
    }

    .dataTables_empty {
        font-weight: bolder;
        font-size: 3rem;
        text-transform: uppercase;
    }

    #ajaxTable_filter input {
        width: 450px;
    }
</style>

<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <div class="d-flex justify-content-between align-center">
            <h4 class="card-title" style="display: initial;">Pacientes</h4>
                <div style="margin-left: auto;">
                    <?php
                    $cadastrar = base_url('atendimento/salvar');
                    echo ($_SESSION['usuario']['user']->tipo == '1' || $_SESSION['usuario']['user']->tipo == '0') ?
                        "<a title='Cadastrar Paciente' class='btn btn-success mb-3' href='$cadastrar'>
                    <i class='fa fa-user-plus' aria-hidden='true' style='font-size: 1.5rem;'></i></a>" : " ";
                    ?>
                </div>
            </div>
            <div style="width: 100%;">

                <table class="table mb-0 table-sm align-middle" id="ajaxTable">
                    <thead>
                        <tr>
                            <th>NC</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Nascimento</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


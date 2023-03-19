<style>
    #pager a {
        color: black !important;
    }

    #pager {
        margin-top: 15px;
    }

    #pager li {
        border-radius: 10px;
    }

    table a {
        cursor: pointer;
    }

    .utilityTable {
        display: flex;
        justify-content: space-between;
    }

    .searchTable {
        margin-top: 5px;
        display: flex;
        flex-direction: row;
    }

    form {
        display: flex;
    }

    form button {
        font-size: 16px;
        background-color: white;
        color: #009ce7;
        width: 45px;
        border-radius: 0 10px 10px 0;
    }

    form button:hover {
        background-color: #009ce7;
        color: white;
        border-radius: 0 10px 10px 0;
    }
</style>

<?php function dates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('-', '/', $orgDate);
    $newDate = date("d/m/Y", strtotime($date));
    return $newDate;
}

function reverseDates($oldData)
{
    // $oldData = $value->entrada;
    $orgDate = $oldData;
    $date = str_replace('/', '-', $orgDate);
    $newDate = date("d/m/Y", strtotime($date));
    return $newDate;
}
?>

<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title" style="display: initial;">Pacientes</h4>
            <div class="utilityTable">
                <div style="top:5px">
                    <div class="searchTable">
                        <form action="<?= isset($incompletos) ? base_url('atendimento/incompletos') : base_url('atendimento/index') ?>" method="get">
                            <input name="search" id="search" class="form-control" type="search" placeholder="Pesquisar">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
                <div>
                    <?php
                    $cadastrar = base_url('atendimento/salvar');
                    echo ($_SESSION['usuario']['user']->tipo == '1' || $_SESSION['usuario']['user']->tipo == '0') ?
                        "<a title='Cadastrar Paciente' class='btn btn-success mb-3' href='$cadastrar'>
                    <i class='fa fa-user-plus' aria-hidden='true' style='font-size: 17px;'></i></a>" : " ";
                    ?>
                </div>
            </div>
            <div style="width: 100%;">

                <table class="table mb-0 table-sm align-middle" id="ajaxTable">
                    <thead>
                        <tr style='font-size:11px;'>
                            <th>NC</th>
                            <th>Nome</th>
                            <th class="text-center">CPF</th>
                            <th class="text-center">Nascimento</th>
                            <th>Ação</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $key => $paciente) {
                            echo "<tr id='tr" . $paciente->id . "'>";
                            echo "<td style='font-size:17px;'>" . $paciente->id . "</td>";
                            echo    "<td ><a style='text-transform:uppercase;'href='" . base_url('atendimento/perfil/' . base64_encode($paciente->id)) . "'>" . $paciente->nome . "</a></td>";
                            echo    "<td class='text-center' id='tdCpf'>" . (!empty($paciente->cpf) ? $paciente->cpf : '<span class="badge bg-danger">Não Cadastrado!</span>') . "</td>";
                            echo    "<td class='text-center'>" . (!empty($paciente->dataNascimento) ? reverseDates($paciente->dataNascimento) : '<span class="badge bg-danger">Não Cadastrado!</span>') . "</td>";
                            echo ($_SESSION['usuario']['user']->tipo == '1') ? "<td> <div><a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i> </span></a><button title='Deletar Paciente' class='eraser' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $paciente->id . ")' ><span><i class='fa fa-eraser' aria-hidden='true'></i> </span></button></div> </td>" : (($_SESSION['usuario']['user']->tipo == '0') ? "<td> <div><a title='Editar Paciente' class='pencil' href='" . base_url('atendimento/editar/' . base64_encode($paciente->id)) . "'><span><i class='fa fa-pencil' aria-hidden='true'></i>" : "");
                            echo "</tr>";
                        }; ?>

                    </tbody>
                </table>
                <div class="row" id="pager">
                    <?php
                    if ($pager) {
                        echo $pager->links();
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>
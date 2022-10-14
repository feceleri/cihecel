<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title" style="display: initial;">Pacientes</h4>
            <a class="btn btn-success mb-3" href="<?= base_url('public/atendimento/salvar') ?>" style="float:right;top:5px"><i class="fa fa-user-plus" aria-hidden="true" style="font-size: 17px;"></i></a>
            <div class="table-responsive" style="width: 100%;">

                <table class="table mb-0 table-sm align-middle" id="ajaxTable">
                    <thead>
                        <tr style='font-size:11px;'>
                            <th>NC</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Nascimento</th>
                            <th>Ação</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $key => $paciente) {
                            echo "<tr id='tr" . $paciente->id . "'>";
                            echo "<td style='font-size:17px;'>".$paciente->id."</td>";
                            echo    "<td><a href='" . base_url('public/atendimento/perfil/' . base64_encode($paciente->id)) . "'>" . $paciente->nome . "</a></td>";
                            echo    "<td>" . $paciente->cpf . "</td>";
                            $oldData = $paciente->dataNascimento;
                            $orgDate = $oldData;
                            $date = str_replace('-"', '/', $orgDate);
                            $newDate = date("d/m/Y", strtotime($date));
                            echo "<td>" . $newDate . "</td>";
                            echo    "<td> <div><a class='pencil' href='". base_url('public/atendimento/editar/'. base64_encode($paciente->id) )."'><span><i class='fa fa-pencil' aria-hidden='true'></i> </span></a><button class='eraser' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(" . $paciente->id . ")' ><span><i class='fa fa-eraser' aria-hidden='true'></i> </span></button></div> </td>";
                            echo "</tr>";
                        }; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
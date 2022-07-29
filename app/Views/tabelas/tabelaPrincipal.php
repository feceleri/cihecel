<div class="card-block">
    <h5 class="text-bold card-title">Pacientes</h5>
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de nascimento</th>
                    <th>Status</th>
                </tr>
                
            </thead>
            <tbody>
                    <?php
                    foreach ($resultado as $key => $paciente) {
                        echo "<tr>";
                        echo    "<td><a href='". base_url('public/atendimento/perfil?id='. $paciente->id  ) . "'>" . $paciente->nome . "</a></td>";
                        echo    "<td>" . $paciente->cpf . "</td>";
                        echo    "<td>" . $paciente->dataNascimento . "</td>";
                        echo    "<td><i class='fa fa-lock' style='font-size:25px;' aria-hidden='true'></i></td>";
                        echo "</tr>";
                    }; ?>
            </tbody>
        </table>
    </div>
</div>
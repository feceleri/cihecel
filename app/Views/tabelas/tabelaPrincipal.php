<div class="card-block">
    <h5 class="text-bold card-title">Pacientes</h5>
    <div class="table-responsive">
        <table class="table table-striped mb-0 table-sm" id="ajaxTable">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de nascimento</th>
                    <th>Ação</th>
                </tr>
                
            </thead>
            <tbody>
                    <?php
                    foreach ($resultado as $key => $paciente) {
                        echo "<tr>";
                        echo    "<td><a href='". base_url('public/atendimento/perfil/'. $paciente->id  ) . "'>" . $paciente->nome . "</a></td>";
                        echo    "<td>" . $paciente->cpf . "</td>";
                        $oldData = $paciente->dataNascimento;
                        $orgDate = $oldData;  
                        $date = str_replace('-"', '/', $orgDate);  
                        $newDate = date("d/m/Y", strtotime($date));  
                        echo "<td>" .$newDate. "</td>";       
                        echo    "<td> <div><a class='pencil' href=''><span><i class='fa fa-pencil' aria-hidden='true'></i> </span></a> <button class='eraser' data-bs-target='#deleteModal' data-bs-toggle='modal' onclick='preencherModalDelete(".$paciente->id.")' ><span><i class='fa fa-eraser' aria-hidden='true'></i> </span></button></div> </td>";
                        echo "</tr>";
                    }; ?>
                    
            </tbody>
        </table>
    </div>
</div>
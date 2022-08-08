<div class="card-block">
    <h5 class="text-bold card-title">Estoque</h5>
    <div class="table-responsive">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>ID</th>
                    <th>Quantidade</th>
                    <!-- <th>Status</th> -->
                </tr>
                
            </thead>
            <tbody>
                    <?php
                    foreach ($resultado as $key => $medicamento) {
                        
                        echo "<tr>";
                        echo    "<td><a href='". base_url('public/atendimento/consultaEstoque/'. $medicamento->idEstoque  ) . "'>" . $medicamento->nome . "</a></td>";
                        echo    "<td>" . $medicamento->idMedicamento . "</td>";
                        echo    "<td>" . $medicamento->quantidade . "</td>";
                        // echo    "<td><i class='fa fa-lock' style='font-size:25px;' aria-hidden='true'></i></td>";
                        echo "</tr>";
                    }; ?>
            </tbody>
        </table>
    </div>
</div>
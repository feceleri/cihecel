<div class="card-block">
    <h5 class="text-bold card-title">Estoque</h5>
    <div class="table-responsive">
        <table class="table table-striped mb-0 " id="ajaxTable">
            <thead>
                <tr>
                    <th>Medicamento</th>
                    <th>ID</th>
                    <th>Quantidade</th>
                    <th>Observação</th>
                </tr>
                
            </thead>
            <tbody>
                    <?php
                    foreach ($resultado as $key => $medicamento) {
                        echo "<tr>";
                        echo    "<td><a href='". base_url('public/estoque/estoque/'. $medicamento->id  ) . "'>" . $medicamento->nomeMed . "</a></td>";
                        echo    "<td>" . $medicamento->idMedicamento . "</td>";
                        echo    "<td>" . $medicamento->quantidade . "</td>";
                        echo    "<td>" . $medicamento->observacao . "</td>";
                        echo "</tr>";
                    }; ?>
            </tbody>
        </table>
    </div>
</div>
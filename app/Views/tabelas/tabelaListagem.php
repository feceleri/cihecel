<div class="row" style="height:80vh">
    <?php function dates($oldData)
    {
        // $oldData = $value->entrada;
        $orgDate = $oldData;
        $date = str_replace('-', '/', $orgDate);
        $newDate = date("d/m/Y", strtotime($date));
        return $newDate;
    } 
     function Reversedates($oldData)
    {
        // $oldData = $value->entrada;
        $orgDate = $oldData;
        $date = str_replace('/', '-', $orgDate);
        $newDate = date("d-m-Y", strtotime($date));
        return $newDate;
    } ?>
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title" style="display: initial;">Listagem</h4>
            <a class="btn btn-success mb-3" href="<?= base_url('atendimento/salvarListagem') ?>" style="float:right;top:5px"><i class="fa fa-book" aria-hidden="true"></i></a>
            <a class="btn btn-dark mb-3" title="Gerar PDF" href="<?= base_url('atendimento/listagemPDF') ?>" role="button" style="float:right;top:5px; margin-right:1rem;color: white;"><i class="fa fa-file" aria-hidden="true"></i></a>
            <div class="table-responsive" style="width: 100%;">
                <table class="table table-sm table-striped" id="ajaxTableListagem" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>Senha</th>
                            <th >Responsável</th>
                            <th>Telefone</th>
                            <th>Entrada</th>
                            <th style="text-align:center;">Saída</th>
                            <th style="text-align:center;">Retorno</th>
                            <th style="text-align:center;">Recomendação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($date as $key => $value) {
                            echo "<tr>";
                            echo  "<td style='text-align:center;'> <a href='" . base_url('atendimento/senha/' . base64_encode($value->id)) . "'> " . $value->senha . "</a></td>";
                            echo  "<td style='text-transform: capitalize; width:20%;'> " . $value->nome . "</td>";
                            (!empty($value->telefone1)) ? $tel = $value->telefone1 : $tel = ' Não cadastrado!';
                            echo  "<td style='width:17%;'> $tel</td>";
                            $entrada = dates($value->entrada);
                            echo  "<td> " . $entrada . "</td>";
                            if (isset($value->saida)) {
                                $saida = dates($value->saida);
                                echo "<td style='text-align:center;'>" . $saida . "</td>";
                            } else {
                                echo "<td id='td' style='text-align:center; width:25%;'>
                                        <a id='manual_" . $value->id . "' onclick='dateManual(" . $value->id . ")' class='showbutton' style='margin: 20px;' href='#'>
                                            <i class='fa fa-calendar' aria-hidden='true'></i>
                                        </a>
                                        <a class='showbutton' id='automatico_" . $value->id . "' href='" . base_url('atendimento/saidaListagem/' . base64_encode($value->id)) . "' id='check'>
                                            <i class='fa fa-check-square' aria-hidden='true'></i>
                                        </a>
                                        <form action='" . base_url('atendimento/saidaListagemManual') . "' method='post'>
                                            <input name='saida'style='width: 113px;' id='inputManual_" . $value->id . "' class='hiddenbutton' type='date' required>
                                            <input style='display:none;' name='id' value='" . $value->id . "' >
                                                <button id='buttonManual_" . $value->id . "' class='hiddenbutton showbutton' style='border:none;background:none;margin:-7px;' type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                                <a onclick='reverseDateManual(" . $value->id . ")' id='x_" . $value->id . "' class='hiddenbutton' style='border:none;background:none;' type='submit'><i class='fa fa-times' aria-hidden='true'></i></a>
                                        </form>
                                      </td>";
                            }
                            $retorno=0;
                            if ($value->saida == null) {
                                $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                            } else {
                                $retorno =  date("d/m/Y", strtotime("+1 month",strtotime($value->saida)));
                            }
                            echo "<td style='text-align:center;'>$retorno</td>";
                            if($retorno != 0){

                                $recomendacao= date('d/m/Y', strtotime('-4 days', strtotime(Reversedates($retorno))));
                            }else{
                                $recomendacao="<i class='fa fa-times' aria-hidden='true'></i>";
                            }
                            echo "<td style='text-align:center;'>$recomendacao</td>";
                            echo "</tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
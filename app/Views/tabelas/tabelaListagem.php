<div class="row" style="height:80vh">
    <?php function dates($oldData){
        // $oldData = $value->entrada;
        $orgDate = $oldData;
        $date = str_replace('-', '/', $orgDate);
        $newDate = date("d/m/Y", strtotime($date));
        return $newDate;
    }?>
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title" style="display: initial;">Listagem</h4>
            <a class="btn btn-success mb-3" href="<?= base_url('public/atendimento/salvarListagem') ?>" style="float:right;top:5px"><i class="fa fa-book" aria-hidden="true"></i></a>
              <div class="table-responsive" style="width: 100%;">
                <table class="table table-sm table-striped" id="ajaxTableListagem">
                    <thead>
                        <tr>
                            <th>Senha</th> 
                            <th style="width:fit-content;">Responsável</th>
                            <th>CPF</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($date as $key => $value) {
                               echo "<tr>";
                               echo  "<td> <a href='".base_url('public/atendimento/senha/'.$value->id)."'> ".$value->senha."</a></td>";
                               echo  "<td> ".$value->nome."</td>";
                               echo  "<td> ".$value->cpf."</td>"; 
                               $entrada=dates($value->entrada);
                               echo  "<td> ".$entrada."</td>";
                               if(isset($value->saida)){
                                $saida=dates($value->saida);
                                echo "<td>".$saida."</td>";
                               } else {
                                echo "<td id='td'>
                                        <a id='manual_".$value->id."' onclick='dateManual(".$value->id.")' class='showbutton' style='margin: 20px;' href='#'>
                                            <i class='fa fa-calendar' aria-hidden='true'></i>
                                        </a>
                                        <a class='showbutton' id='automatico_".$value->id."' href='".base_url('public/atendimento/saidaListagem/'.$value->id)."' id='check'>
                                            <i class='fa fa-check-square' aria-hidden='true'></i>
                                        </a>
                                        <form action='".base_url('public/atendimento/saidaListagemManual')."' method='post'>
                                            <input name='saida'style='width: 113px;' id='inputManual_".$value->id."' class='hiddenbutton' type='date' required>
                                            <input style='display:none;' name='id' value='".$value->id."' >
                                                <button id='buttonManual_".$value->id."' class='hiddenbutton showbutton' style='border:none;background:none;margin:-7px;' type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                                <a onclick='reverseDateManual(".$value->id.")' id='x_".$value->id."' class='hiddenbutton' style='border:none;background:none;' type='submit'><i class='fa fa-times' aria-hidden='true'></i></a>
                                        </form>
                                      </td>";
                               echo "</tr>";
                            }}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

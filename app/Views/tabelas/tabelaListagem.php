<div class="row" style="height:80vh">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="card-title" style="display: initial;">Listagem</h4>
            <a class="btn btn-success mb-3" href="<?= base_url('public/atendimento/salvarListagem') ?>" style="float:right;top:5px"><i class="fa fa-book" aria-hidden="true"></i></a>
              <div class="table-responsive" style="width: 100%;">
                <table class="table mb-0 table-sm align-middle" id="ajaxTableListagem">
                    <thead>
                        <tr>
                            <th>Senha</th> 
                            <th>Responsável</th>
                            <th>CPF</th>
                            <th>Entrada</th>
                            <th>Saída</th> <a href=""></a>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($date as $key => $value) {
                                echo "<tr>";
                               echo  "<td> <a href='".base_url('public/atendimento/senha/'.$value->id)."'> ".$value->senha."</a></td>";
                               echo  "<td> ".$value->nome."</td>";
                               echo  "<td> ".$value->cpf."</td>"; 
                               $oldData = $value->entrada;
                               $orgDate = $oldData;
                               $date = str_replace('-"', '/', $orgDate);
                               $newDate = date("d/m/Y", strtotime($date));
                               echo  "<td> ".$newDate."</td>";
                               if(isset($value->saida)){
                                $saida=$value->saida;
                                $saida=date('d/m/Y');
                                echo "<td>".$saida."</td>";
                               } else {
                                echo "<td><a href='".base_url('public/atendimento/saidaListagem/'.$value->id)."' id='check'><i class='fa fa-check-square' aria-hidden='true'></i></a></td>";
                               }
                               echo "</tr>";
                            };
                        
                        ?>
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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

    .table-responsive {
        overflow: hidden;
    }
</style>
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
            <div style="float:left;">
                <h4 class="card-title" style="display: initial;">Listagem</h4>
                <div class="utilityTable">
                    <div style="top:5px">
                        <div class="searchTable">
                            <form action="<?= base_url('atendimento/listagem') ?>" method="post">
                                <input name="search" class="form-control" type="search" placeholder="Pesquisar">
                                <button type="submit" style="border: none;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div style="float:right;" class="align-items-center">
                <?php if ($_SESSION['usuario']['user']->tipo == '1' || $_SESSION['usuario']['user']->tipo == '0') : ?>
                    <a class="btn btn-success mb-2 mt-1" href="<?= base_url('listagemcontroller/salvarlistagem/'. base64_encode(0)) ?>" style="float:right;"><i class="fa fa-book" aria-hidden="true"></i></a>
                <?php endif; ?>
                <form class="form-inline align-items-center mt-0" action="<?= base_url('atendimento/listagemPDF') ?>" method="post">
                    <div class="form-group input-group align-items-center">
                        <label for="data" class="form-label" style="min-width: 3em !important">Dia: </label>
                        <input name="dataLista" class="form-control form-control-sm mb-3" type="date" placeholder="Pesquisar" id="data">
                    </div>
                    <div class="form-group form-row">
                        <button type="submit" class="btn btn-dark mb-3" href="<?= base_url('atendimento/listagemPDF') ?>" title="Gerar PDF" style="float:right;top:5px; margin-right:1rem;color: white;"><i class="fa fa-file" aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>

            <div class="table-responsive mt-2" style="width: 100%;">
                <table class="table table-sm table-striped" id="ajaxTableListagem" style="width:100% !important">
                    <thead>
                        <tr>
                            <th>Senha</th>
                            <th>Responsável</th>
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
                            echo "<tr style='font-size: 15px;'>";
                            echo  "<td style='text-align:center;'> <a href='" . base_url('atendimento/senha/' . base64_encode($value->id)) . "'> " . $value->senha . "</a></td>";
                            echo  "<td style='text-transform: capitalize; width:20%;'> " . $value->nomeResponsavel . "</td>";
                            (!empty($value->telResponsavel)) ? $tel = $value->telResponsavel : $tel = ' Não cadastrado!';
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
                                        <a class='showbutton' id='automatico_" . $value->id . "' href='" . base_url('listagemcontroller/saidaListagem/' . base64_encode($value->id)) . "' id='check'>
                                            <i class='fa fa-check-square' aria-hidden='true'></i>
                                        </a>
                                        <form action='" . base_url('listagemcontroller/saidaListagemManual') . "' method='post'>
                                            <input name='saida'style='width: 113px;' id='inputManual_" . $value->id . "' class='hiddenbutton' type='date' required>
                                            <input style='display:none;' name='id' value='" . $value->id . "' >
                                                <button id='buttonManual_" . $value->id . "' class='hiddenbutton showbutton' style='border:none;background:none;margin:-7px;' type='submit'><i class='fa fa-check' aria-hidden='true'></i></button>
                                                <a onclick='reverseDateManual(" . $value->id . ")' id='x_" . $value->id . "' class='hiddenbutton' style='border:none;background:none;' type='submit'><i class='fa fa-times' aria-hidden='true'></i></a>
                                        </form>
                                      </td>";
                            }
                            $retorno = 0;
                            if ($value->saida == null) {
                                $retorno = "<i class='fa fa-times' aria-hidden='true'></i>";
                            } else {
                                $retorno =  date("d/m/Y", strtotime("+1 month", strtotime($value->saida)));
                            }
                            echo "<td style='text-align:center;'>$retorno</td>";
                            if ($retorno != 0) {

                                $recomendacao = date('d/m/Y', strtotime('-4 days', strtotime(Reversedates($retorno))));
                            } else {
                                $recomendacao = "<i class='fa fa-times' aria-hidden='true'></i>";
                            }
                            echo "<td style='text-align:center;'>$recomendacao</td>";
                            echo "</tr>";
                        } ?>
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
    <!-- <div class="modal fade" id="modalPDF" tabindex="-1" aria-labelledby="modalPDFgenerator" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPDFgenerator">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>testando</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-target='#deleteModal' data-bs-toggle='modal' onclick="modalPDF">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <script>
        $(document).ready(function(){
            $("#myModal").modal();
        });
        $('#modalPDF').on('show.bs.modal', function (e) {
            $('#modalPDF').modal('show');
        })
        
    </script> -->
</div>
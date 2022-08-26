<div class="row align-items-center">
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="card-title">Cadastro de Listagem</h4>
                <form action="#">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" maxlength="14"  id="cpfResp" name="cpfResp" class="form-control"  onkeyup="searchPeople(this.value)">
                        
                    </div>
                    <div class="form-group">
                        <label>N° da Senha</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="responsavel">Responsavel</label>
                        <input type="text" name="responsavel" id="responsavel" class="form-control" readonly required/> 
                    </div>
                    <div style="display:flex;" class="adicional">
                        <div class="form-group" style="margin-right: 10px;">
                            <label>Nome</label>
                            <input type="email" class="form-control">
                        </div>
                        <!--  -->
                        <div class="form-group" style="margin-right: 10px;">
                            <label>CPF</label>
                            <input type="email" class="form-control" maxlength="14" id="cpfAdicional">
                        </div>
                        <!--  -->
                        <div class="form-group" style="margin-right: 10px;">
                            <label>QTD de receitas</label>
                            <input type="email" class="form-control">
                        </div>
                        <button class="btn btn-success" style="height: min-content;"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                    </div>
                    
                    
                    
                    
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </h4>
            </h4>
        </div>
    </div>
</div>
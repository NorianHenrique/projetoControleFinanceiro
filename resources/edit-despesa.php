<?php $this->layout('templates/dashboard',['title'=>'Despesa','subtitle'=>'Cadastro e Listagem']) ?>

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Editar despesa</h3>
            <?php if (!empty($error)):?>
                <div class="alert alert-danger">
                    <span><?=$error;?></span>
                </div>
            <?php endif; ?>
            <form class="form-horizontal form-material" action="<?=BASE_URL;?>/atualizar-despesa" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-12 p-0" for="descricao">Descrição</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="Descrição da conta" name="descricao" id="descricao"
                                    class="form-control p-0 border-0" value="<?=$despesa['descricao'];?>"> 
                                <input type="hidden" name="id" value="<?=$despesa['id'];?>">    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dataVencimento" class="col-md-12 p-0">Data de Vencimento</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="date" class="form-control p-0 border-0" name="dataVencimento"
                                    id="dataVencimento" value="<?=$despesa['vencimento'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0" for="valor">Valor</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="R$ 0,00" name="valor" class="form-control p-0 border-0" id="valor"
                                value="<?=$despesa['valor'];?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0" for="situacao">Situação</label>
                            <div class="col-md-12 border-bottom p-0">
                                <select name="situacao" class="form-control p-0 border-0" id="situacao">
                                    <option value="" selected="selected" disabled>Escolher Opção</option>    
                                    <option value="Apagar" <?php echo ($despesa['situacao']== 'Apagar') ?'selected="selected"' :false; ?>>Apagar</option>
                                    <option value="Pago">Pago</option>
                                </select>    
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0" for="pagamento">Forma de Pagamento</label>
                            <div class="col-md-12 border-bottom p-0" for="celular">
                                <select name="pagamento" class="form-control p-0 border-0" id="pagamento">
                                        <option value="" selected="selected" disabled>Escolher Opção</option>
                                    <?php foreach ($pagamento as $lista) { ?>
                                        <option value="<?php echo $lista['nome'] ?>" <?php echo ($despesa['pagamento']== $lista['nome']) ?'selected="selected"' :false; ?>>
                                            <?php echo $lista['nome']; ?>
                                        </option>
                                    <?php } ?>    
                                </select>    
                            </div>
                        </div>
                    </div>
                </div>    
                    
                    <div class="form-group mb-4">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
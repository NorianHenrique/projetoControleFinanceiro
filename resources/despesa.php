<?php $this->layout('templates/dashboard',['title'=>'Despesa','subtitle'=>'Cadastro e Listagem']) ?>

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Cadastro de despesa</h3>
            <?php if (!empty($error)):?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <span><?=$error;?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form class="form-horizontal form-material" action="<?=BASE_URL;?>/cad-despesa" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="col-md-12 p-0" for="descricao">Descrição</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="Descrição da conta" name="descricao" id="descricao"
                                    class="form-control p-0 border-0"> </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dataVencimento" class="col-md-12 p-0">Data de Vencimento</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="date" class="form-control p-0 border-0" name="dataVencimento"
                                    id="dataVencimento">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0" for="valor">Valor</label>
                            <div class="col-md-12 border-bottom p-0">
                                <input type="text" placeholder="R$ 0,00" name="valor" class="form-control p-0 border-0" id="valor">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-4">
                            <label class="col-md-12 p-0" for="situacao">Situação</label>
                            <div class="col-md-12 border-bottom p-0">
                                <select name="situacao" class="form-control p-0 border-0" id="situacao">
                                    <option value="" selected="selected" disabled>Escolher Opção</option>    
                                    <option value="Apagar">Apagar</option>
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
                                        <option value="<?php echo $lista['nome']; ?>"><?php echo $lista['nome']; ?></option>
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

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Listagem de despesa</h3>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover" id="tabelaDespesa">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Desconto</th>
                                <th>Vencimento</th>
                                <th>Data de Pag.</th>
                                <th>Forma de pagamento</th>
                                <th>Situação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($despesas)) { ?>
                            <?php foreach ($despesas as $listagem) { ?>
                            <tr>
                                <td><?php echo $listagem['descricao']; ?></td>
                                <td>R$ <?php echo number_format($listagem['valor'],2,',','.'); ?></td>
                                <td>R$ <?php echo number_format($listagem['desconto'],2,',','.');?></td>
                                <td><?php echo $listagem['vencimento']; ?></td>
                                <td><?php echo $listagem['data_pagamento']; ?></td>
                                <td><?php echo $listagem['pagamento'];?></td>
                                <td><?php echo $listagem['situacao'];?></td>
                                <td>
                                    <?php if ($listagem['situacao'] != 'Pago') { ?>
                                    <a class="btn btn-primary" title="Editar" href="<?php echo BASE_URL;?>/edit-despesa/<?php echo $listagem['id'];?>"><i class="fas fa-edit"></i></a> 
                                    <?php } ?>
                                    <a class="btn btn-danger text-white" title="Excluir" href="<?php echo BASE_URL;?>/excluir-despesa/<?php echo $listagem['id'];?>"><i class="fas fa-trash"></i></a>
                                    <?php if ($listagem['situacao'] != 'Pago') { ?>
                                     <a class="btn btn-success text-white" title="Pago" href="<?php echo BASE_URL;?>/pagamento-despesa/<?php echo $listagem['id'];?>"><i class="fas fa-money-bill-alt"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>   

<?php $this->unshift('styles') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css" />
<?php $this->end() ?>


<?php $this->push('scripts') ?>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script>
$('#tabelaDespesa').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json"
    }
});
</script>
<?php $this->end() ?>
<style type="text/css">
    .col-ip-1 {
        width: 100px;
    }
    .col-ip-2 {
        width: 200px;
    }
    .col-ip-3 {
        width: 300px;
    }
    .col-ip-4 {
        width: 400px;
    }
    .col-ip-5 {
        width: 500px;
    }
    .float-right {
        float: right;
    }
</style>
<?php
  // echo debugEx(current_url());
?>
<form action="<?php echo base_url(); ?>index.php/bens/pesquisar" method="post" accept-charset="UTF-8" id="formPesquisar">
    <div class="form-group col-cl-3">
    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) { ?>
        <a href="<?php echo base_url();?>index.php/bens/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Bens</a>
    <?php } ?>
        <button id="pesquisar" type="submit" class="float-right btn btn-info"><i class="icon-search icon-white"></i> Pesquisar</button>
        <input type="text" name="pesquisa" class="form-control col-ip-4 float-right" id="pesquisa" placeholder="Digite número protocolo ou descrição do bem">
    </div>
</form>
<?php
if (!$results) {?>
    <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Bens</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Descrição</th>
            <th>Classificação do Bem</th>
            <th>Valor Unitário</th>
            <th>Fornecedor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6" style="text-align: center;">Nenhum Bem Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<?php } else {?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Bens</h5>

     </div>

<div class="widget-content nopadding">

<?php if (isset($pesquisar)): ?>
<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Descrição</th>
            <th>Cod. Protocolo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->id.'</td>';
            echo '<td>'.$r->descricao.'</td>';
            echo '<td>'.zerosAEsquerda($r->protocolo,5).'</td>';

            echo '<td>';
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                // echo '<a style="margin-right: 1%" href="'.base_url().'index.php/produtos/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Produto"><i class="icon-eye-open"></i></a>  ';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/bens/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Bem"><i class="icon-pencil icon-white"></i></a>';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                // echo '<a href="#modal-excluir" role="button" data-toggle="modal" produto="'.$r->id.'" class="btn btn-danger tip-top" title="Excluir Produto"><i class="icon-remove icon-white"></i></a>';
            // }

            echo '</td>';
            echo '</tr>';
}?>
        <tr>

        </tr>
    </tbody>
</table>
<?php else: ?>

<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Descrição</th>
            <th>Nota Fiscal</th>
            <th>Valor Unitário</th>
            <th>Fornecedor</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->id.'</td>';
            echo '<td>'.$r->descricao.'</td>';
            echo '<td>'.$r->nota_fiscal.'</td>';
            echo '<td>'.number_format($r->valor_unitario, 2, ',', '.').'</td>';
            echo '<td>'.$r->origem_fornecedor.'</td>';

            echo '<td>';
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                // echo '<a style="margin-right: 1%" href="'.base_url().'index.php/produtos/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Produto"><i class="icon-eye-open"></i></a>  ';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/bens/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Bem"><i class="icon-pencil icon-white"></i></a>';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                // echo '<a href="#modal-excluir" role="button" data-toggle="modal" produto="'.$r->id.'" class="btn btn-danger tip-top" title="Excluir Produto"><i class="icon-remove icon-white"></i></a>';
            // }

            echo '</td>';
            echo '</tr>';
          }?>
        <tr>

        </tr>
    </tbody>
</table>
<?php endif ?>
</div>
</div>

<?php echo $this->pagination->create_links();
}?>



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/produtos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Produto</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idProduto" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este produto?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>



<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {

        var produto = $(this).attr('produto');
        $('#idProduto').val(produto);

    });


   // $('button#pesquisar').on('click', function(event) {
   //     event.preventDefault();
   //     // console.log("cliquei no botao");
   //      $('#formPesquisar').submit();
   // });

   // $('#formPesquisar').on('submit', function(event) {
   //     event.preventDefault();
   //     var $post = $(this).serialize();
   //     // console.log($post);

   // });

});

</script>

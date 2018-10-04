<!-- <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) { ?> -->
    <a href="<?php echo base_url();?>index.php/setores/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Setor</a>
<!-- <?php } ?> -->

<?php

if (!$results) {?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Setores</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Instituição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="4">Nenhum Setor Cadastrado</td>
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
        <h5>Setores</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Instituição</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->id.'</td>';
            echo '<td>'.$r->descricao.'</td>';
            echo '<td>'.$r->instituicao_id.'</td>';

            echo '<td>';
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/setores/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Setor"><i class="icon-eye-open"></i></a>  ';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                echo '<a style="margin-right: 1%" href="'.base_url().'index.php/setores/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Setor"><i class="icon-pencil icon-white"></i></a>';
            // }
            // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" setor="'.$r->id.'" class="btn btn-danger tip-top" title="Excluir Setor"><i class="icon-remove icon-white"></i></a>';
            // }

            echo '</td>';
            echo '</tr>';
}?>
        <tr>

        </tr>
    </tbody>
</table>
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

        var setor = $(this).attr('setor');
        $('#id').val(setor);

    });

});

</script>

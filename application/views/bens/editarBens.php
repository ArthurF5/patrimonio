
<style>
/* Hiding the checkbox, but allowing it to be focused */
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
    width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */

    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
    text-indent: 0;
}

.col-cl-1 {
    width: 10%;
    float: left;
    /*margin-left: 15px;*/
    padding: 10px;
}
.col-cl-2 {
    width: 20%;
    float: left;
    /*margin-left: 15px;*/
    padding: 10px;
}
.col-cl-3 {
    width: 30%;
    float: left;
    /*margin-left: 15px;*/
    padding: 10px;
}
.col-cl-4 {
    width: 40%;
    float: left;
    /*margin-left: 15px;*/
    padding: 10px;
}
.col-cl-5 {
    width: 50%;
    float: left;
    /*margin-left: 15px;*/
    padding: 10px;
}


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

tr:hover {
    background: #FAE47A;
}

</style>

<div class="alert alert-success alert-dismissible fade in" id="mensagem_sucesso" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong></strong>
</div>
<div class="alert alert-danger alert-dismissible fade in" id="mensagem_erro" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong></strong>
</div>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Bens</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>

                <form action="<?php echo current_url(); ?>" id="formBens" method="post" class="form-horizontal" >
                <div class="form-row control-group">
                    <div class="form-group col-cl-1">
                        <label for="codigo">Código</label>
                        <input name="codigo" type="text" class="form-control col-ip-1" id="codigo" disabled=""  value="<?php echo $result->id; ?>" >
                    </div>
                    <div class="form-group col-cl-3">
                        <label for="descricao">Descrição</label>
                        <input name="descricao"  value="<?php echo $result->descricao; ?>"  type="text" class="form-control col-ip-3" id="descricao" >
                    </div>
                    <div class="form-group col-cl-1 " style="display: none">
                        <label for="documento">Documento</label>
                        <input name="documento"  value="<?php echo $result->registro_documento; ?>"  type="text" class="form-control col-ip-1" id="documento">
                    </div>

                    <div class="form-group col-cl-2">
                        <label for="nota_fiscal">Nota Fiscal</label>
                        <input name="nota_fiscal" value="<?php echo $result->nota_fiscal; ?>" type="text" class="form-control col-ip-2" id="nota_fiscal">
                    </div>
                    <div class="form-group col-cl-2">
                        <label for="valor_unitario">Valor Unitário</label>
                        <input  name="valor_unitario" value="<?php echo $result->valor_unitario; ?>" type="text" class="form-control col-ip-2 money" id="valor_unitario">
                    </div>
                </div>
                <div class="form-row control-group">
                    <div class="form-group col-cl-2">
                        <label for="classificacao_bem">Classificação do Bem</label>
                        <label for="id_label_single_classificacao_bens">
                            <select class="col-ip-2 js-example-basic-single js-states form-control" id="id_label_single_classificacao_bens" name="classificacao_bem" >
                                    <?php echo $selectClassificacaoBens; ?>
                            </select>
                        </label>

                    </div>
                    <div class="form-group col-cl-2">
                        <label for="tipo_bem"  >Tipo de bem</label>
                        <select id="tipo_bem" name="tipo_bem">
                                <option value="1">PROJETOR</option>
                                <option value="2">COMPUTADOR</option>
                                <option value="3">CADEIRAS</option>
                                <option value="4">DOCUMENTOS</option>

                        </select>
                    </div>
                    <div class="form-group col-cl-5">
                        <label for="fornecedor">Fornecedor</label>
                        <input name="fornecedor" value="<?php echo $result->origem_fornecedor; ?>" type="text" class="form-control col-ip-4" id="fornecedor"  >
                        <button type="submit" class="btn btn-success" id="adicionarBens" style="display: none"><i class="icon-plus icon-white"></i> Adicionar</button>


                    </div>
                </div>
        </form>


    <div class="form-row control-group">
        <div class="widget-box " style=" ">
             <div class="widget-title">
                <span class="icon">
                    <i class="icon-barcode"></i>
                 </span>
                <h5>Movimentações</h5>

             </div>

            <div class="widget-content padding" >
            <?php if (!$protocolo) {?>
            <table class="table table-bordered " style="    border: 1px solid #ddd;">
                <thead>
                    <tr style="background-color: #2D335B">
                        <th>Protocolo</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Setor de Saída</th>
                        <th>Setor de Entrada</th>
                        <th>Número de Serie</th>
                    </tr>
                </thead>
                <tbody>

                    <tr >
                        <td colspan="6" style="text-align: center;">Nenhum Protocolo Cadastrado</td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>

            <?php } else {?>
            <table class="table table-bordered " id="tabelaMov" style="border-top-right-radius: 6px;border-top-left-radius: 6px;     border: 1px solid #ddd; cursor: default;">
                <thead>
                    <tr style="background-color: white">
                        <!-- <th>#</th> -->
                        <th>Protocolo</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Setor de Saída</th>
                        <th>Setor de Entrada</th>
                        <th>Número de Série</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($protocolo as $r) {
                        echo '<tr>';
                            echo '<td>'.str_pad((string) $r->protocolo, 5 , '0' ,STR_PAD_LEFT).'</td>';
                            echo '<td>'.$r->tipo.'</td>';
                            echo '<td>'.data_pt($r->data).'</td>';
                            echo '<td>'.$r->setor_anterior.'</td>';
                            echo '<td>'.$r->setor_atual.'</td>';
                            echo '<td>'.$r->numero_serie.'</td>';
                        echo '<td>';
                        // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                            // echo '<a style="margin-right: 1%" href="'.base_url().'index.php/produtos/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Produto"><i class="icon-eye-open"></i></a>  ';
                        // }
                        // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                            echo '<a id="movimentarProtocolo" style="margin-right: 1%" href="" class="btn btn-info tip-top" idProtocolo="'.$r->id.'" title="Movimentar item"><i class="icon-exchange icon-white"></i></a>';

                            echo '<a  id="historico_movimentacao" href="#modal-historico" role="button" data-toggle="modal" CodProtocolo="'.$r->protocolo.'" class="btn tip-top" title="Ver Histórico de Movimentações"><i class="icon-eye-open" ></i></a>';
                            // cleyton

                            // echo '<a id="editarProtocolo" style="margin-right: 1%" href="" class="btn btn-info tip-top" idProtocolo="'.$r->id.'" title="Editar Protocolo"><i class="icon-pencil icon-white"></i></a>';
                        // // }
                        // // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {


                        // }

                        echo '</td>';
                        echo '</tr>';
            }?>
                    <tr>

                    </tr>
                </tbody>

            </table>
            <?php } ?>
            </div>
            <form action="<?php echo current_url(); ?>" id="formProtocolo" method="post" class="form-horizontal" accept-charset="UTF-8">
            <div class="form-row control-group ">
                <div class="form-group col-cl-2 " >
                    <label for="cod_protocolo">Código</label>
                    <input type="text" value="<?php echo zerosAEsquerda($protocolo[0]->protocolo,5); ?>"
                    name="cod_protocolo" class="form-control col-ip-2 " id="cod_protocolo" placeholder="" >
                </div>
            </div>
            <div class="form-row control-group ">
                <div class="form-group col-cl-2 " style="display: none ">
                    <label for="bem_id">bem_id</label>
                    <input type="text" name="bem_id" class="form-control col-ip-2 " id="bem_id" placeholder="" >
                </div>
                <div class="form-group col-cl-1 " style="display: none">
                    <label for="id_protocolo">id_protocolo</label>
                    <input type="text"  name="id_protocolo" class="form-control col-ip-1 " id="id_protocolo" placeholder="" >
                </div>

                <div class="form-group col-cl-2">
                    <label for="tipo"  >Tipo de Processo</label>
                    <select id="tipo" name="tipo">
                            <option value="BAIXA" <?=($protocolo[0]->tipo == 'BAIXA')?'selected':''?> >BAIXA</option>
                            <option value="REGISTRAR" <?=($protocolo[0]->tipo == 'REGISTRAR')?'selected':''?> >REGISTRAR</option>
                            <option value="TRANSFERÊNCIA" <?=($protocolo[0]->tipo == 'TRANSFERÊNCIA')?'selected':''?> >TRANSFERÊNCIA</option>
                            <option value="MANUTENÇÃO" <?=($protocolo[0]->tipo == 'MANUTENÇÃO')?'selected':''?> >MANUTENÇÃO</option>

                    </select>
                </div>
                <div class="form-group col-cl-2 ">
                    <label for="data">Data</label>
                    <input value="<?php echo $protocolo[0]->data; ?>"  type="text" name="data" class="form-control col-ip-2  datepicker" id="data" placeholder="" autocomplete="off">
                </div>
                <div class="form-group col-cl-2">
                    <label for="numero_serie">Número de Série</label>
                    <input type="text" name="numero_serie" class="form-control col-ip-2" id="numero_serie" placeholder="" >
                </div>
                <div class="form-group col-cl-1" style="display: none">
                    <label for="qtde">Quantidade</label>
                    <input type="text" name="qtde" class="form-control col-ip-1" id="qtde" placeholder="" disabled="">
                </div>
                <div class="form-group col-cl-3">
                    <label for="setor_id">Setor de Destino</label>
                    <label for="id_label_single">
                      <select name="setor_id" class="js-example-basic-single js-states form-control" id="id_label_single">
                            <?php echo $selectSetores; ?>
                      </select>
                    </label>
                </div>
            </div>
            <div class="form-row control-group">
                <div class="form-group col-cl-2">
                    <label for="estado_conservacao">Estado de conservação</label>
                    <select id="estado_conservacao" name="estado_conservacao">
                            <option value="Ótimo" <?=($protocolo[0]->estado_conservacao == 'Ótimo')?'selected':''?> >Ótimo</option>
                            <option value="Bom" <?=($protocolo[0]->estado_conservacao == 'Bom')?'selected':''?> >Bom</option>
                            <option value="Regular" <?=($protocolo[0]->estado_conservacao == 'Regular')?'selected':''?> >Regular</option>
                            <option value="Ruim" <?=($protocolo[0]->estado_conservacao == 'Ruim')?'selected':''?> >Ruim</option>
                    </select>
                </div>
                <div class="form-group col-cl-2">
                    <label for="valor_atual">Valor atual</label>
                    <input type="text" value="<?php echo $protocolo[0]->valor_atual; ?>" name="valor_atual" class="form-control col-ip-2 money" id="valor_atual" placeholder="" >
                </div>
                <div class="form-group col-cl-5">
                    <label for="historico">Histórico</label>
                    <input name="historico"  value="<?php echo $protocolo[0]->historico; ?>"  type="text" class="form-control col-ip-5" id="historico" placeholder="" >
                </div>
            </div>
            </form>
        </div>
    </div>


            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
                        <button type="button" class="btn btn-primary" id="novoProtocolo"><i class="icon-plus icon-white"></i> Novo</button>
                        <button type="submit" class="btn btn-success" id="adicionarProtocolo"><i class="icon-plus icon-white"></i> Salvar</button>
                        <!-- <button type="button" id="teste">executar</button> -->
                        <a href="<?php echo base_url() ?>index.php/bens" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                    </div>
                </div>
            </div>



            </div>

         </div>
     </div>
</div>
<div class="row-fluid" style="margin-top:0">

</div>
<!-- Modal -->
<div id="modal-historico" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/bens/historico" method="post" style="background: white;">
  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h5 id="myModalLabel">Histórico de Movimentações</h5>
  </div>
  <div class="modal-body" style="background: white;">
        <input type="hidden" id="idProduto" name="id" value="" />
        <!-- <h5 style="text-align: center">Deseja realmente excluir este produto?</h5> -->
        <table class="table table-bordered " id="tabelaHistorico" style=" border: 1px solid #ddd;
        background: white; border-top-right-radius: 6px; border-top-left-radius: 6px;  cursor: default;">
            <thead>
                <tr style="background-color: white;  ">
                    <!-- <th>#</th> -->
                    <th>Protocolo</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Setor de Saída</th>
                    <th>Setor de Entrada</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
  </div>
  <div class="modal-footer">
        <h6 style="float: left;" id="setor_atual">Setor Atual: COMUNICAÇÃO</h6>
        <button class="btn" data-dismiss="modal" aria-hidden="true" style="float: right;">Voltar</button>
        <!-- <button class="btn btn-danger">Excluir</button> -->
  </div>
  </form>
</div>
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/Bens.js"></script>


<!-- cleyton -->

<script type="text/javascript">
    var $vg_modo = 'visualizando';

    desabilitarInputsProtocolo();

    $('#tabelaMov #historico_movimentacao').on('click', function(event) {
        var CodProtocolo = $(this).attr('CodProtocolo');
        // var idProtocolo = $('#movimentarProtocolo').attr('idProtocolo');
        // console.log(idProtocolo);
        // $('.modal-header #myModalLabel').html(idProtocolo);
        var retorno = inserirHistorico(CodProtocolo);

    });

    function inserirHistorico(CodProtocolo) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/protocolo/historico',
            type: 'POST',
            data: 'CodProtocolo=' + CodProtocolo,
            async: true
        })
        .done(function(data) {
            var coluna = '';
            $('table#tabelaHistorico tbody tr').remove();
            array = $.parseJSON(data);
            array.forEach(logArrayElements);
            function logArrayElements(element, index, array) {
                // console.log("a[" + index + "] = " + element['tipo']);
                coluna = "<tr>";
                coluna +=   "<td>"+element['protocolo']+"</td>";
                coluna +=   "<td>"+element['tipo']+"</td>";
                coluna +=   "<td>"+element['data']+"</td>";
                coluna +=   "<td>"+element['setor_anterior']+"</td>";
                coluna +=   "<td>"+element['setor_atual']+"</td>";
                coluna +="</tr>";

                $('table#tabelaHistorico tbody').prepend(coluna);
                if (index == 0) {
                    $('.modal-footer #setor_atual').html('');
                    $('.modal-footer #setor_atual').html('Setor Atual: '+element['setor_atual']);
                }
            }

        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {

        });

    }

    function desabilitarInputsProtocolo(){
        $('input[name=cod_protocolo]').prop("disabled", true);
        $('select[name=tipo]').prop("disabled", true);
        $('input[name=data]').prop("disabled", true);
        $('input[name=qtde').prop("disabled", true);
        $('select[name=setor_id]').prop("disabled", true);
        $('select[name=estado_conservacao]').prop("disabled", true);
        $('input[name=valor_atual]').prop("disabled", true);
        $('input[name=historico]').prop("disabled", true);
        $('input[name=numero_serie]').prop("disabled", true);
    }

    // // movimentacao de bens
    $('a#movimentarProtocolo').on('click', function(event) {
        event.preventDefault();
        var $id = $(this).attr("idProtocolo");
        var $bem_id = $('input#codigo').val();
        itemSelecionado = $(this).parent().parent();

        // colocando id protocolo no form para ser visto pelo sumit
        $('input#id_protocolo').val($id);
        // colocando id do bem no form para ser visto pelo sumit
        $('input#bem_id').val($bem_id);


        $vg_modo = 'movimentando';
        var retorno = carregar($id);



    });

    // editar
    $('a#editarProtocolo').on('click', function(event) {
        event.preventDefault();
        var $id = $(this).attr("idProtocolo");
        var $bem_id = $('input#codigo').val();

        // colocando id protocolo no form para ser visto pelo sumit
        $('input#id_protocolo').val($id);
        // colocando id do bem no form para ser visto pelo sumit
        $('input#bem_id').val($bem_id);


        $vg_modo = 'editando';

        var retorno = carregar($id);

    });

    $('button#teste').on('click', function(event) {
        event.preventDefault();
        console.log("cliquei no botao");
        var a = $("#tabelaMov tbody tr td a:first").attr('idProtocolo');
        console.log(a);
        carregar(a);
    });



    $('#tabelaMov tbody tr').on('mouseover', function(event) {
        event.preventDefault();
        if ($vg_modo == 'visualizando') {
            var $id = $(this).children().children().attr("idProtocolo");
            var retorno = carregar($id);
        }
    });


    // botao novo
    $('#novoProtocolo').on('click', function(event) {
        event.preventDefault();
        $vg_modo = 'novo';
        $('#formProtocolo input').val("");
        $('#formProtocolo input').attr("disabled",false);
        $('#formProtocolo select').attr("disabled",false);
        $('input[name=cod_protocolo]').attr("disabled",true);

        var $bem_id = $('input#codigo').val();
        // colocando id do bem no form para ser visto pelo sumit
        $('input#bem_id').val($bem_id);
        tratamentoCampoTipoProcesso();


    });



    function carregar(id){
        $.ajax({
            url: '<?php echo base_url(); ?>/index.php/bens/carregar/',
            type: 'POST',
            data: 'protocoloID=' + id,

        })
        .done(function(dados) {
            var cod_protocolo = $.parseJSON(dados)['protocolo'];
            // console.log(dados);
            var tipo = $.parseJSON(dados)['tipo'];
            var data = $.parseJSON(dados)['data'];
            var $setor_id = ($.parseJSON(dados)['setor_id']).toString();
            var estado_conservacao = $.parseJSON(dados)['estado_conservacao'];
            var valor_atual = $.parseJSON(dados)['valor_atual'];
            var historico = $.parseJSON(dados)['historico'];
            var numero_serie = $.parseJSON(dados)['numero_serie'];


            $('input[name=cod_protocolo]').val(cod_protocolo);
            $('select[name=tipo]').val(tipo);
            $('input[name=data]').val(data);
            $('select[name=setor_id]').select2("val",""+$setor_id+"");
            $('select[name=estado_conservacao]').val(estado_conservacao);
            $('input[name=valor_atual]').val(valor_atual);
            $('input[name=historico]').val(historico);
            $('input[name=numero_serie]').val(numero_serie);


            if ($vg_modo == 'visualizando') {
                desabilitarInputsProtocolo();

            } else if ($vg_modo == 'editando'  ) {
                habilitarCamposMovimentacao();

            } else if ($vg_modo == 'movimentando') {
                habilitarCamposMovimentacao();
                limparInputsMovimentacao();
                tratamentoCampoTipoProcesso(tipo);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });

    }

    function tratamentoCampoTipoProcesso(tipo=null) {
        if (tipo == 'REGISTRAR') {
            $("select[name=tipo]").val('TRANSFERÊNCIA');
            $("select[name=tipo] option[value=REGISTRAR]").hide();
            $("select[name=tipo] option[value=BAIXA]").show();
            $("select[name=tipo] option[value=TRANSFERÊNCIA]").show();

        } else if (tipo == 'TRANSFERÊNCIA'){
            $("select[name=tipo]").val('TRANSFERÊNCIA');
            $("select[name=tipo] option[value=REGISTRAR]").hide();
            $("select[name=tipo] option[value=TRANSFERÊNCIA]").show();
            $("select[name=tipo] option[value=BAIXA]").show();
        } else if (tipo == 'BAIXA'){
            $("select[name=tipo]").val('MANUTENÇÃO');
            $("select[name=tipo] option[value=REGISTRAR]").hide();
            $("select[name=tipo] option[value=TRANSFERÊNCIA]").hide();
            $("select[name=tipo] option[value=BAIXA]").hide();
            $("select[name=tipo] option[value=MANUTENÇÃO]").show();
        } else if (tipo == 'MANUTENÇÃO'){
            $("select[name=tipo]").val('BAIXA');
            $("select[name=tipo] option[value=REGISTRAR]").hide();
            $("select[name=tipo] option[value=MANUTENÇÃO]").hide();
            $("select[name=tipo] option[value=TRANSFERÊNCIA]").show();
            $("select[name=tipo] option[value=BAIXA]").show();
        } else {
            $("select[name=tipo]").val('REGISTRAR');
            $("select[name=tipo] option[value=REGISTRAR]").show();
            $("select[name=tipo] option[value=MANUTENÇÃO]").show();
            $("select[name=tipo] option[value=TRANSFERÊNCIA]").show();
            $("select[name=tipo] option[value=BAIXA]").show();
        }
    }
    function limparInputsMovimentacao() {
        $('input[name=data]').val('');
        // $('input[name=valor_atual]').val('');
        $('input[name=historico]').val('');
    }

    function habilitarCamposMovimentacao(){
        $('select[name=tipo]').prop("disabled", false);
        $('input[name=data]').prop("disabled", false);
        $('select[name=setor_id]').prop("disabled", false);
        $('select[name=estado_conservacao]').prop("disabled", false);
        $('input[name=valor_atual]').prop("disabled", false);
        $('input[name=historico]').prop("disabled", false);
        $('input[name=numero_serie]').prop("disabled", false);
    }


    // botão salvar
    $('#adicionarProtocolo').on('click', function(event) {
        event.preventDefault();
        //forçando o submit do formulario, já que o botao nao está dentro do form
        $('#formProtocolo').submit();
    });

    // depois de forçar o submit aqui irá acontecer o evento pra salvar protocolo
    $('#formProtocolo').on('submit', function(event) {
        event.preventDefault();
        var formulario = $(this);

        if ($vg_modo == 'novo') {
            var retorno = inserirProtocolo(formulario);
        } else if ($vg_modo == 'editando') {
            // estou habilitando o campo codigo protocolo só para poder pegar o valor do input dele pelo post
            // mas esse campo não pode ficar habilitado para o usuário
            $("input#cod_protocolo").prop('disabled',false);
            var idProtocolo = $("input#id_protocolo").val();
            var retorno = inserirProtocolo(formulario,idProtocolo);
        } else if ($vg_modo == 'movimentando'){
            // habilitei só pra pegar o valor do input
            $("input#cod_protocolo").prop('disabled',false);
            var retorno = inserirMovimentacao(formulario);
        }

    });

    function inserirMovimentacao(dados) {
        $.ajax({
            url: '<?php echo base_url(); ?>/index.php/protocolo/movimentacao/',
            type: 'POST',
            data: dados.serialize(),
            async: true
        })
        .done(function(data) {
            // desabilitando porque eu habilitei ele anteriormente em $('#formProtocolo').on('submit'
            // $("input#cod_protocolo").prop('disabled',true);

            $sucesso = $.parseJSON(data)['sucesso'];
            $mensagem = $.parseJSON(data)['mensagem'];
            if($sucesso){
                $objProtocolo = $.parseJSON(data)['objProtocolo'];
                // remove a linha selecionado que cliquei no botao movimentar
                itemSelecionado.fadeOut('slow', function() {
                    mostrarProtocoloNaTabela($objProtocolo['protocolo'], $objProtocolo['id'] , $objProtocolo['tipo'], $objProtocolo['data'], $objProtocolo['setor_atual'], $objProtocolo['setor_anterior']);

                    $('#mensagem_sucesso strong').prepend($mensagem);
                });


            } else {
                $('#mensagem_erro strong').html('');
                $('#mensagem_erro strong').prepend($mensagem);
                $('#mensagem_erro').show();
                $('html, body').animate({ scrollTop: 0 }, 500);


            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {

        });

    }

    function inserirProtocolo(dados,idProtocolo=''){
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/protocolo/salvar/'+idProtocolo,
            type: 'POST',
            data: dados.serialize(),
            async: false,
        })
        .done(function(data) {
            // desabilitando porque eu habilitei ele anteriormente em $('#formProtocolo').on('submit'
            $("input#cod_protocolo").prop('disabled',true);

            $sucesso = $.parseJSON(data)['sucesso'];
            $mensagem = $.parseJSON(data)['mensagem'];

            if ($sucesso) {
                $id_protocolo = $.parseJSON(data)['id_protocolo'];
                $objProtocolo = $.parseJSON(data)['objProtocolo'];

                mostrarProtocoloNaTabela($objProtocolo['protocolo'], $objProtocolo['id'] , $objProtocolo['tipo'], $objProtocolo['data'], $objProtocolo['setor_atual'], $objProtocolo['setor_anterior'],$objProtocolo['numero_serie']);
                $vg_modo = 'visualizando';

                // console.log($objProtocolo);

            } else {
                console.log($mensagem);
            }

        })
        .fail(function() {
            console.log("error : arquivo nao encontrado");
        })
        .always(function() {
            // console.log("complete");
        });
    }



    function mostrarProtocoloNaTabela(codigoProtocolo, idProtocolo , tipo, data, setor_atual,setor_anterior,numero_serie){
        var coluna = '';
        var colunaTag = '<a id="movimentarProtocolo" style="margin-right: 1%" idProtocolo="'+idProtocolo+'" href="" class="btn btn-info tip-top"  title="Movimentar item"><i class="icon-exchange icon-white"></i></a>';

        colunaTag += '<a  id="historico_movimentacao" href="#modal-historico" role="button" data-toggle="modal" CodProtocolo="'+codigoProtocolo+'" class="btn tip-top" title="Ver Histórico de Movimentações"><i class="icon-eye-open" ></i></a>';

        // colunaTag += "<a href='#modal-excluir' role='button' data-toggle='modal' produto='' class='btn btn-danger tip-top' title='Excluir Protocolo'><i class='icon-remove icon-white'></i></a>"

        coluna = "<tr>";
        coluna +=   "<td>"+codigoProtocolo+"</td>";
        coluna +=   "<td>"+tipo+"</td>";
        coluna +=   "<td>"+data+"</td>";
        coluna +=   "<td>"+setor_anterior+"</td>";
        coluna +=   "<td>"+setor_atual+"</td>";
        coluna +=   "<td>"+numero_serie+"</td>";
        coluna +=   "<td>"+colunaTag+"</td>";
        coluna +="</tr>";



        $('table#tabelaMov tbody').prepend(
            $(coluna).hide().fadeIn(500)
        );

        $("table#tabelaMov tbody tr:first").animate({
            backgroundColor: "#FAE47A"
        }, 500, function() {
            $("table#tabelaMov tbody tr:first").animate({
                backgroundColor: "#F9F9F9"
            },500, function(){
                $("table#tabelaMov tbody tr:first").removeAttr("style")
            });
        });

    }


</script>




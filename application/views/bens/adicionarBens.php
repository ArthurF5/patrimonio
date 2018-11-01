
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
                        <input name="codigo" type="text" class="form-control col-ip-1" id="codigo" disabled="" >
                    </div>

                    <div class="form-group col-cl-3">
                        <label for="descricao">Descrição</label>
                        <input name="descricao" type="text" class="form-control col-ip-3" id="descricao" >
                    </div>
                    <div class="form-group col-cl-1" style="display: none">
                        <label for="documento">Documento</label>
                        <input name="documento" type="text" class="form-control col-ip-1" id="documento">
                    </div>

                    <div class="form-group col-cl-2">
                        <label for="nf">Nota Fiscal</label>
                        <input name="nf"  type="text" class="form-control col-ip-2" id="nf">
                    </div>
                    <div class="form-group col-cl-2">
                        <label for="valor_unitario">Valor Unitário</label>
                        <input  name="valor_unitario"  type="text" class="form-control col-ip-2 money" id="valor_unitario">
                    </div>
                </div>
                <div class="form-row control-group">
                    <div class="form-group col-cl-2">
                        <label for="classificacao_bem">Classificação do Bem</label>
                        <label for="id_label_single_classificacao_bens">
                            <select class="col-ip-2 js-example-basic-single js-states form-control" id="id_label_single_classificacao_bens" name="classificacao_bem">
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
                        <input name="fornecedor" type="text" class="form-control col-ip-4" id="fornecedor"  >
                        <button type="submit" class="btn btn-success" id="adicionarBens"><i class="icon-plus icon-white"></i> Adicionar</button>
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
            <?php if (!$results) {?>
            <table class="table table-bordered " id="tabelaMov" style="  cursor: default;   border: 1px solid #ddd;">
                <thead>
                    <tr style="background-color: #2D335B">
                        <th>Protocolo</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Setor de Entrada</th>
                        <th>Setor de Saída</th>
                        <th>Número de Serie</th>
                    </tr>
                </thead>
                <tbody>

                    <tr id="nenhumProtocolo">
                        <td colspan="6" style="text-align: center;">Nenhum Protocolo Cadastrado</td>
                    </tr>
                </tbody>
            </table>
            </div>
            </div>

            <?php } else {?>
            <table class="table table-bordered " id="tabelaMov" style="    border: 1px solid #ddd;">
                <thead>
                    <tr style="background-color: #2D335B">
                        <!-- <th>#</th> -->
                        <th>Protocolo</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Setor de Entrada</th>
                        <th>Setor de Saída</th>
                        <th>Número de Série</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $r) {
                        // debugEx($r);
                        echo '<tr>';
                        echo '<td>'.str_pad((string) $r->protocolo, 5 , '0' ,STR_PAD_LEFT).'</td>';
                        echo '<td>'.$r->tipo.'</td>';
                        echo '<td>'.data_pt($r->data).'</td>';
                        echo '<td>'.$r->setor_atual.'</td>';
                        echo '<td>'.$r->setor_anterior.'</td>';
                        echo '<td>'.$r->numero_serie.'</td>';

                        echo '<td>';
                        // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
                            // echo '<a style="margin-right: 1%" href="'.base_url().'index.php/produtos/visualizar/'.$r->id.'" class="btn tip-top" title="Visualizar Protocolo"><i class="icon-eye-open"></i></a>  ';
                        // }
                        // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
                            echo '<a style="margin-right: 1%" href="'.base_url().'index.php/produtos/editar/'.$r->id.'" class="btn btn-info tip-top" title="Editar Protocolo"><i class="icon-pencil icon-white"></i></a>';
                        // }
                        // if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
                            echo '<a href="#modal-excluir" role="button" data-toggle="modal" produto="'.$r->id.'" class="btn btn-danger tip-top" title="Excluir Protocolo"><i class="icon-remove icon-white"></i></a>';
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
            <div class="form-row control-group " style="display: none;">

            </div>
            <div class="form-row control-group ">
                <div class="form-group col-cl-2 " style="display: none">
                    <label for="bem_id"></label>
                    <input type="text" name="bem_id" class="form-control col-ip-2 " id="bem_id" placeholder="" >
                </div>
                <div class="form-group col-cl-2">
                        <label for="tipo"  >Tipo de Processo</label>
                        <select id="tipo" name="tipo">
                                <option value="REGISTRAR" >REGISTRAR</option>
                                <option value="BAIXA">BAIXA</option>
                                <option value="TRANSFERÊNCIA">TRANSFERÊNCIA</option>
                                <option value="MANUTENÇÃO">MANUTENÇÃO</option>

                        </select>
                </div>
                <div class="form-group col-cl-2 ">
                    <label for="data">Data</label>
                    <input type="text"  autocomplete="off" name="data" class="form-control col-ip-2  datepicker" id="data" placeholder="" >
                </div>
                <div class="form-group col-cl-2">
                    <label for="numero_serie">Número de Série</label>
                    <input type="text" name="numero_serie" class="form-control col-ip-2" id="numero_serie" placeholder="" >
                </div>
                <div class="form-group col-cl-2" style="display: none;">
                    <label for="qtde">Quantidade</label>
                    <input type="text" name="qtde" class="form-control col-ip-2" id="qtde" placeholder="" disabled="true">
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
                            <option value="Ótimo">Ótimo</option>
                            <option value="Bom">Bom</option>
                            <option value="Regular">Regular</option>
                            <option value="Ruim">Ruim</option>
                    </select>
                </div>
                <div class="form-group col-cl-2">
                    <label for="valor_atual">Valor atual</label>
                    <input type="text" name="valor_atual" class="form-control col-ip-2 money" id="valor_atual" placeholder="" >
                </div>
                <div class="form-group col-cl-5">
                    <label for="historico">Histórico</label>
                    <input name="historico" type="text" class="form-control col-ip-5" id="historico" placeholder="" >
                </div>
            </div>
            </form>
        </div>
    </div>


            <div class="form-actions">
                <div class="span12">
                    <div class="span6 offset3">
                        <button type="submit" class="btn btn-success" id="adicionarProtocolo"><i class="icon-plus icon-white"></i> Adicionar</button>
                        <!-- <button type="button" id="qualquer">lkjfjalk</button> -->
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
<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/Bens.js"></script>


<script type="text/javascript">
    $(function() {

        var $vg_modo = 'novo';

        $('#adicionarProtocolo').on('click', function(event) {
            event.preventDefault();
            $('#formProtocolo').submit();
        });

        $('#formProtocolo').on('submit', function(event) {
            event.preventDefault();
            var formulario = $(this);
            var bem_id = $('#bem_id').val();
            var mensagem = '';
            var sucesso = true;
            var data_protocolo = $('input[name=data').val();

            if (bem_id == '') {
                mensagem = 'Adicione primeiro um BEM.';
                sucesso = false;
            } else if (data_protocolo == ''){
                sucesso = false;
                mensagem = 'Insira uma data para o protocolo';
            } else {
                sucesso = true;
            }


            if (sucesso) {
                if ($vg_modo == 'novo' ) {
                    var retorno = inserirProtocolo(formulario);
                }
            } else {
                $('#mensagem_erro strong').html('');
                $('#mensagem_erro strong').prepend(mensagem);
                $('#mensagem_erro').show();
                $('html, body').animate({ scrollTop: 0 }, 500);
            }


        });


        function inserirProtocolo(dados){
            $.ajax({
                url: '<?php echo base_url(); ?>index.php/protocolo/salvar/',
                type: 'POST',
                data: dados.serialize(),
                async: false,
            })
            .done(function(data) {
                $sucesso = $.parseJSON(data)['sucesso'];
                $mensagem = $.parseJSON(data)['mensagem'];

                if ($sucesso) {
                    $id_protocolo = $.parseJSON(data)['id_protocolo'];
                    $objProtocolo = $.parseJSON(data)['objProtocolo'];

                    mostrarProtocoloNaTabela($objProtocolo['protocolo'], $objProtocolo['id'] , $objProtocolo['tipo'], $objProtocolo['data'], $objProtocolo['setor_atual'], $objProtocolo['setor_anterior'],$objProtocolo['numero_serie']);
                } else {
                    $('#mensagem_erro strong').prepend($mensagem);
                    $('#mensagem_erro').show();
                    $('html, body').animate({ scrollTop: 0 }, 500);

                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });

        }

    function mostrarProtocoloNaTabela(codigoProtocolo, idProtocolo , tipo, data, setor_atual,setor_anterior,numero_serie){
        var coluna = '';
        var colunaTag = '';
        // var colunaTag = '<a id="movimentarProtocolo" style="margin-right: 1%" idProtocolo="'+idProtocolo+'" href="" class="btn btn-info tip-top" title="Movimentar item"><i class="icon-exchange icon-white"></i></a>';

        // var colunaTag = "<a id='editarProtocolo' style='margin-right: 1%' href='' class='btn btn-info tip-top' idProtocolo='' title='Editar Protocolo'><i class='icon-pencil icon-white'></i></a>";

        // colunaTag += "<a href='#modal-excluir' role='button' data-toggle='modal' produto='' class='btn btn-danger tip-top' title='Excluir Protocolo'><i class='icon-remove icon-white'></i></a>"

        coluna = "<tr>";
        coluna +=   "<td>"+codigoProtocolo+"</td>";
        coluna +=   "<td>"+tipo+"</td>";
        coluna +=   "<td>"+data+"</td>";
        coluna +=   "<td>"+setor_anterior+"</td>";
        coluna +=   "<td>"+setor_atual+"</td>";
        coluna +=   "<td>"+numero_serie+"</td>";
        // coluna +=   "<td>"+colunaTag+"</td>";
        coluna +="</tr>";


        $('table#tabelaMov tbody #nenhumProtocolo').remove();

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





    });


</script>




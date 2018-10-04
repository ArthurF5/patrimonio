$(function() {

    $('.js-example-basic-single').select2();

    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

    $(".money").maskMoney();

    $('#formProduto').validate({
        rules :{
              descricao: { required: true},
              unidade: { required: true},
              precoCompra: { required: true},
              precoVenda: { required: true},
              estoque: { required: true}
        },
        messages:{
              descricao: { required: 'Campo Requerido.'},
              unidade: {required: 'Campo Requerido.'},
              precoCompra: { required: 'Campo Requerido.'},
              precoVenda: { required: 'Campo Requerido.'},
              estoque: { required: 'Campo Requerido.'}
        },

        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
       });



    $('#formBens').on('submit', function(e) {
        e.preventDefault();
        var formulario = $(this);
        var retorno = inserirBens(formulario);

    });

    function inserirBens(dados) {
         $.ajax({
            url: 'salvar',
            type: 'POST',
            data: dados.serialize(),
            async: true
        })
        .done(function(data) {
            $sucesso = $.parseJSON(data)["sucesso"];
            $mensagem = $.parseJSON(data)["mensagem"];
            $id_bem = $.parseJSON(data)["codigo"];
            // console.log($id_bem);
            if ($sucesso) {
                // $("div#mensagem p").html($.parseJSON(data)["mensagem"]);
                $('#codigo').val($id_bem);
                $('#bem_id').val($id_bem);
                $('html, body').animate({ scrollTop: 0 }, 500);

                $('#mensagem_sucesso strong').html('');
                $('#mensagem_sucesso strong').prepend($mensagem);
                $('#mensagem_sucesso').show();


            } else {
                $('#mensagem_erro strong').html('');
                $('#mensagem_erro strong').prepend($mensagem);
                $('#mensagem_erro').show();

            }

        })
        .fail(function() {
            console.log("error: PAGINA NAO ENCONTRADA");
        })
        .always(function() {

        });
    }






});










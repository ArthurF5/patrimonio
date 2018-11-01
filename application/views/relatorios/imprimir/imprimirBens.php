<html>
<head>
  <title>Grupos Magister</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/rel_bens_por_tipo.css" /> -->

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body >
 <div class="geral">
  <div class="row-fluid">
    <div class="span12">
      <div class="cabecalho">
        <div class="logo">
          <img src="assets/img/logo-fatepi-p.png" alt="">
        </div>
        <div class="empresa">
          <?php foreach ($bens as $b) {
              $setor_atual = $b->d_setor_atual;
              $cod_setor = $b->setor_id;
          } ?>
          <h3>GRUPO MAGISTER DE ENSINO</h3>
             <h4><?php   echo "SETOR: ".zerosAEsquerda($cod_setor,3)." - ".$b->d_setor_atual; ?></h4>
        </div>
        <div class="espaco"></div>
      </div>
    </div>
  </div>
  <div class="conteudo-1">
    <div class="titulo">
      <h3>Relatório de Bens por Tipo</h3>
    </div>
    <div class="dados">
      <?php
          foreach ($bens as $b => $value) {

            $array[$value->tipo][$b] = $value;
      ?>

      <?php
          }
          // echo "<pre>";
          // var_dump($array);
          // echo "</pre>";

          foreach ($array as $tipo_bem => $valor ) {
      ?>

            <div class="teste">
              <p><?php echo "> ".$tipo_bem; ?></p>

            </div>
            <table class="table table-bordered" id="tabela">
                  <thead>
                    <tr>
                      <th style="">Código Protocolo</th>
                      <th style="">Tipo</th>
                      <th style="">Descrição</th>
                      <th style="">Número Série</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $qtde = 0;
                      foreach ($valor as $value) {
                        $qtde++;
                     ?>
                      <tr>
                          <td><?php echo zerosAEsquerda($value->num_protocolo,5) ?></td>
                          <td><?php echo $value->tipo ?></td>
                          <td><?php echo $value->descricao ?></td>
                          <td><?php echo $value->numero_serie ?></td>


                      </tr>
                    <?php
                      }
                    ?><tr class="rodape_tabela">
                          <td>Total</td>
                          <td><?php echo $qtde ?></td>
                          <td></td>
                          <td></td>
                      </tr>
                  </tbody>
                  </table>
      <?php
          }
      ?>


              </div>

              <div class="footer">

                <div class="assinatura">
                 <div class="texto">
                  <p>Declaro que estou recebendo os bens citados acima e que estou responsável pelo mesmo.</p>
                </div>
                <div class="nome1">
                  <div>_______________________________________</div>
                  <p>Assinatura do Responsável pelo Setor</p>
                </div>
                <div class="nome2">
                  <div>_______________________________________</div>
                  <p>Assinatura do Receptor dos Bens</p>
                </div>
              </div>
            </div>


          </div>

        </body>

        </html>

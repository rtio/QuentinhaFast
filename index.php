<?php 
include_once('banco.php');
$rs_pessoa = mysql_query("SELECT * FROM `pessoa` ORDER BY nome");
$rs_almoco = mysql_query("SELECT * FROM `almoco` WHERE isDoDia=1 ORDER BY sabor");
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>Quentinha Fast</title>

  <link rel="shortcut icon" href="images/diner.png">

  <link href="css/metro-bootstrap.css" rel="stylesheet">
  <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
  <link href="css/iconFont.css" rel="stylesheet">
  <link href="css/docs.css" rel="stylesheet">
  <link href="js/prettify/prettify.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- Load JavaScript Libraries -->
  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/jquery/jquery.widget.min.js"></script>
  <script src="js/jquery/jquery.mousewheel.js"></script>
  <script src="js/prettify/prettify.js"></script>

  <!-- Metro UI CSS JavaScript plugins -->
  <script src="js/load-metro.js"></script>
</head>
<body class="metro">


  <img src="ajax-loader.gif" id="load" style="display: none"/>

  <?php include_once('header.html'); ?>
  <div class="container">
    <div class="grid fluid">
      <div class="row">
        <div class="span12 padding20">
          <div class="form">
            <form method="POST" id="formPedido">
              <input type="hidden" value="index" name="pagina"/>
              <fieldset>
                <legend>Faça seu pedido</legend>
                <label>Qual seu nome?</label>
                <div class="input-control select">
                  <select id="pessoa" name="pessoa" required>

                    <option value="" selected>Selecionar...</option>

                    <?php 
                    while ($row = mysql_fetch_array($rs_pessoa, MYSQL_ASSOC)) {
                      printf('<option value="%s">%s</option>', $row["id_pessoa"], utf8_encode($row["nome"]));
                    }
                    mysql_free_result($rs_pessoa);
                    ?>

                  </select>
                  <label>Qual seu pedido?</label>
                  <select id="almoco" name="almoco" required>
                    <option value="" selected>Selecionar...</option>

                    <?php 
                    while ($row = mysql_fetch_array($rs_almoco, MYSQL_ASSOC)) {
                      printf('<option value="%s">%s</option>', $row["id_almoco"], utf8_encode($row["sabor"]));
                    }
                    mysql_free_result($rs_almoco);
                    ?>

                  </select>
                </div> <!-- end div select -->
                <label>Observação</label>
                <div class="input-control text">
                  <input type="text" name="obs" id="obs"/>
                  <button class="btn-clear"></button>
                </div>
                <div class="row">
                  <button class="button large primary span8 offset2" title="Enviar pedido"/>Enviar</button>
                  <!--<input class="button large primary span8 offset2" onclick="return sendData()" type="submit" value="Enviar" title="Enviar pedido"/>-->
                </div>
                <div class="row">
                  <input class="button large warning span8 offset2" type="reset" value="Cancelar" title="Cancelar pedido"/>
                </div>
                <div class="row">
                  <div class="notice fg-white marker-on-top" id="resposta"></div>
                </div>
              </fieldset>
            </form>
          </div> <!-- end div form -->
        </div> <!-- end div span -->
      </div> <!-- end div row -->
    </div> <!-- end div grid -->
  </div> <!-- end div container -->
  <script>
  $('#formPedido').submit(function(){

  $('#load').show();

    var pessoa = $("#pessoa").val();

    var almoco = $("#almoco").val();

    var obs = $("#obs").val();

  $.ajax({
    type: "POST",
    url: "gravar_dados.php",
    data: {'pagina': 'index', 'pessoa': pessoa, 'almoco': almoco, 'obs': obs}
  })
    .done(function(data) {
      $('#load').hide();
   }).always(function() {
      $('#resposta').html('<h4>Gravado com sucesso!</h4>').show().fadeOut(5000);     
  });
  return false;
});
  </script>
</body>
</html>
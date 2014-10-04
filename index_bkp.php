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
          <form method="post">
            <fieldset>
              <legend>Faça seu pedido</legend>
              <label>Qual seu nome?</label>
              <div class="input-control select">
                <select name="pessoa" required>

                  <option value="" selected>Selecionar...</option>

                  <?php 
                  while ($row = mysql_fetch_array($rs_pessoa, MYSQL_ASSOC)) {
                    printf('<option value="%s">%s</option>', $row["id_pessoa"], utf8_encode($row["nome"]));
                  }
                  mysql_free_result($rs_pessoa);
                  ?>

                </select>
                <label>Qual seu pedido?</label>
                <select name="almoco" required>
                  <option value="" selected>Selecionar...</option>

                  <?php 
                  while ($row = mysql_fetch_array($rs_almoco, MYSQL_ASSOC)) {
                    printf('<option value="%s">%s</option>', $row["id_almoco"], utf8_encode($row["sabor"]));
                  }
                  mysql_free_result($rs_almoco);
                  ?>

                </select>
              </div> <!-- end div select -->
              <div class="row">
                  <input class="button large primary span8 offset2" type="submit" value="Enviar" title="Enviar pedido"/>
              </div>
              <div class="row">
                  <input class="button large warning span8 offset2" type="reset" value="Cancelar" title="Cancelar pedido"/>
              </div>
            </fieldset>
          </form>
        </div> <!-- end div form -->
      </div> <!-- end div span -->
    </div> <!-- end div row -->
  </div> <!-- end div grid -->
</div> <!-- end div container -->
  <script>
  $(function() {
    $("input[type=submit]").click(function() {

      $("#load").show();

      var pessoa = $("select[name=pessoa]").val();

      var almoco = $("select[name=almoco]").val();

      $.post("gravar_dados.php", 
      {
        'pagina': 'index',
        'pessoa': pessoa,
        'almoco': almoco
      })
      .done(function() {

        $("#load").hide();

      });

    });

  })
  </script>
</body>
</html>
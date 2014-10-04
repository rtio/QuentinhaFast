<?php 
include_once('banco.php');
$rs_pedido = mysql_query("SELECT pessoa.nome, almoco.sabor, pedido_do_dia.obs  FROM pedido_do_dia INNER JOIN pessoa ON (pessoa.id_pessoa=pedido_do_dia.fk_pessoa_id) INNER JOIN almoco ON (almoco.id_almoco=pedido_do_dia.fk_almoco_id) WHERE pedido_do_dia.data=CURDATE()") or die (mysql_error());
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
	<h3 class="text-center">(85) 3494-2151</h3>
  <div class="grid fluid">
    <div class="row">
      <div class="span12 padding20">
		<table class="table striped hovered">
			<thead>
				<tr>
					<th>Pessoa</th>
					<th>Sabor</th>
					<th>Observação</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				while($row = mysql_fetch_array($rs_pedido)){

					printf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>', utf8_encode($row['nome']), utf8_encode($row['sabor']), utf8_encode($row['obs']));
				}
				mysql_free_result($rs_pedido);
				?>
			</tbody>
		</table>
</div> <!-- end div span9 offset4 -->
</div> <!-- end div row -->
</div> <!-- end div grid -->
</div> <!-- end div container -->
</body>
</html>
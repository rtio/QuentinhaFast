<?php 
include_once('banco.php');
//zerar todas as opções
$rs_ultDia = mysql_query("SELECT data FROM `pedido_do_dia` ORDER BY id_pedido_do_dia DESC LIMIT 1") or die(mysql_error());
$ultDia = mysql_fetch_assoc($rs_ultDia);
if($ultDia['data'] != date('Y-m-d')){
	mysql_query("UPDATE almoco SET isDoDia = 0") or die(mysql_error());
}
//end zerar todas as opções
$rs_almoco = mysql_query("SELECT * FROM `almoco` ORDER BY sabor") or die(mysql_error());
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
		<form method="POST">
			<div class="grid fluid">
				<div class="row">
					<div class="span12 padding20">
						<table class="table striped hovered">
							<thead>
								<tr>
									<th>Sabor</th>
									<th>Tem?</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								while ($row = mysql_fetch_array($rs_almoco, MYSQL_ASSOC)) {
									if($row["isDoDia"] == 1){
										echo '<tr>
										<td>'.utf8_encode($row["sabor"]).'</td>
										<td><label>
										<div class="input-control switch margin10" data-role="input-control">
										<input type="checkbox" value="'.$row["id_almoco"].'|" checked/>
										<span class="check"></span>
										</label></td>
										</tr>';
									}else{
										echo '<tr>
										<td>'.utf8_encode($row["sabor"]).'</td>
										<td><label>
										<div class="input-control switch margin10" data-role="input-control">
										<input type="checkbox" value="'.$row["id_almoco"].'|"/>
										<span class="check"></span>
										</label></td>
										</tr>';
									}
								}
								mysql_free_result($rs_almoco);
								?>
							</tbody>
						</table>
					</div> <!-- end div span9 offset4 -->
				</div> <!-- end div row -->
			</div> <!-- end div grid -->
		</form>
	</div> <!-- end div container -->
	<script>
	$(function() {
		$("input[type=checkbox]").change(function(){

			$("#load").show();
			
			var isChecked = $(this).is(':checked');

			var dados = "0";

			if(isChecked){

				dados = $(this).val() + "1";

			}else{

				dados = $(this).val() + dados;

			}

			//alert(dados);

			$.post("gravar_dados.php", 
			{
				'pagina': 'opcao_dia',
				'isTem': dados
			})
			.done(function() {

				$("#load").hide();

			});

		})

	})
	</script>
</body>
</html>
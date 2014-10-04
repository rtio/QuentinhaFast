<?php
include('banco.php');

if(isset($_POST)){

	if($_POST['pagina'] == "index"){

		$pessoa = $_POST['pessoa'];

		$almoco = $_POST['almoco'];

		$obs = $_POST['obs'];

		mysql_query("INSERT INTO `pedido_do_dia`(`fk_pessoa_id`, `fk_almoco_id`, `data`, `obs`) VALUES ('".$pessoa."','".$almoco."',CURDATE(), '".$obs."')") or die(mysql_error());

		//return header ("location: index.php");

	}else if($_POST['pagina'] == "opcao_dia"){

		$isTem = $_POST['isTem'];

		$dados = explode("|", $isTem);

		mysql_query("UPDATE `almoco` SET `isDoDia`='".$dados[1]."' WHERE `id_almoco`='".$dados[0]."'") or die(mysql_error());

	}
	
}
?>
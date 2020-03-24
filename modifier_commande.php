<?php

require("auth/EtreAuthentifie.php");
$title = 'Modifier commande';
include 'header.php';
include 'toolbar.php';

if(empty($_POST["cid"])){
	echo "<div class='error'>Attention! vous ne pouvez modifier que les commandes en preparation</div>";
	echo "<div class='center'>Selectionner la commande a modifier</div>";
	include 'form_modif.php';
}else{
	echo "<div class='center'><a class='btn btn-warning' href='modification_commande.php?cid=".htmlspecialchars($_POST["cid"])."' title='modifier la commande'> modifier la commande ".htmlspecialchars($_POST["cid"]). "</a> <br/></div>";
}

include 'footer.php';
?>
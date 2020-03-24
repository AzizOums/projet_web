<?php

require("auth/EtreAuthentifie.php");

$title = 'Terminer';
include 'header.php';
include 'toolbar_admin.php';

if ($idm -> getRole() == "admin") {
	if (!empty($_GET["cid"]) && is_numeric($_GET["cid"])) {
		$req = $db -> prepare("SELECT statut FROM commandes WHERE cid = ?");
		$res = $req -> execute(array($_GET["cid"]));
		$row = $req -> fetch();
		if($row){
			$statut = $row["statut"];
			if($statut == 'preparation'){
				$req = $db -> prepare("UPDATE commandes SET statut = 'terminee' WHERE cid = ?");
				$res = $req -> execute(array($_GET["cid"]));
				if($res)
					echo "<p class='center'>Commande terminée !</p>";
				else{
					echo "<p class='error'>Erreur !</p>";
				}
			} else if ($statut == 'terminee') {
				echo "<p class='error'>Commande déjà terminée !</p>";
			} else {
				echo "<p class='error'>Commande déjà en livraison !</p>";
			}
		}else {
			echo "<p class='error'>Cette commande n'existe pas</p>";
		}
	}else{
		echo "<p class='error'>Erreur !</p>";
	}
}else {
	echo "<p class='error'>Vous n'etes pas administrateur !</p>";
}

include 'footer.php';
?>
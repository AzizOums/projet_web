<?php

require("auth/EtreAuthentifie.php");

$title = 'Mes commandes';
include 'header.php';
include 'toolbar.php';

include "select_trie.php";

if(!empty($_POST["trier"]) && $_POST["trier"] == "nom"){
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? ORDER BY pizza";
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "date"){
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? ORDER BY date";
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "preparation"){
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? AND statut = 'preparation'";
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "terminee"){
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? AND statut = 'terminee'";
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "livraison"){
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? AND statut = 'livraison'";
}
else{
	$sql = "SELECT cid, ref, nom as pizza, date, statut FROM commandes JOIN recettes on commandes.rid = recettes.rid WHERE uid = ? ORDER BY cid";
}


$req = $db -> prepare($sql);
$res = $req -> execute(array($idm -> getUid()));
if($res){
	if($req -> rowcount() == 0)
		echo "<p class='error'>Aucune commande</p>";
	else{
		$affiche = "<div class=center> <table class='table table-sm table-dark'>";
		$affiche .= "<tr><td>cid</td> <td>ref</td> <td>pizza</td> <td>date</td> <td>statut</td></tr>";
		while($row = $req -> fetch()){
			foreach (["cid", "ref", "pizza", "date", "statut"] as $nom) {
				if($nom == "cid")
					$affiche .= "<tr><td>". htmlspecialchars($row[$nom]) . "</td>";
				else if($nom == "statut"){
					$var = $row["cid"];
					$affiche .= "<td>" . htmlspecialchars($row[$nom]) . "<td/>" .'  <td><a class="btn btn-primary" href="details_commande.php?cid='.$var.'">voir détails et extras</a></td> <td><a class="btn btn-warning" href="modification_commande.php?cid='.$var.'">Modifier</a></td></tr>';
				}
				else
					$affiche .= "<td>" . htmlspecialchars($row[$nom]) . "</td>";
			}
		}
		$sql = "SELECT SUM(prix) as prix FROM recettes JOIN commandes on recettes.rid = commandes.rid WHERE uid = ?";
		$req = $db -> prepare($sql);
		$res = $req -> execute(array($idm -> getUid()));
		if($res){
			$row = $req -> fetch();
			$prix = $row["prix"];

			$sql = "SELECT SUM(prix) as prix FROM commandes JOIN extras ON extras.cid = commandes.cid LEFT OUTER JOIN supplements on supplements.sid = extras.sid WHERE uid = ?";
			$req = $db -> prepare($sql);
			$res = $req -> execute(array($idm -> getUid()));
			if($res){
				$row = $req -> fetch();
				$prix += $row["prix"];

				$affiche .= "<div><td>Prix totale:</td><td>" .$prix. " €</td></div>";
				$affiche .= "</table> </div>";
				echo $affiche;
			} else
				echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
		} else
			echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
	}
}else{
	echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
}
 

include 'footer.php';

?>
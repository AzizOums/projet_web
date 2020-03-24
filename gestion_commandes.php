<?php

require("auth/EtreAuthentifie.php");

$title = 'Gestion commandes';
include 'header.php';
include 'toolbar_admin.php';

include "select_trie.php";

if(!empty($_POST["trier"]) && $_POST["trier"] == "nom"){
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid ORDER BY user ASC");
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "date"){
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid ORDER BY date ASC");
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "preparation"){
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid where statut = 'preparation'");
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "terminee"){
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid where statut = 'terminee'");
}
else if(!empty($_POST["trier"]) && $_POST["trier"] == "livraison"){
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid where statut = 'livraison'");
}
else{
	$res = $db -> query("SELECT cid, users.nom as user, ref, recettes.nom as pizza, date, statut FROM commandes JOIN recettes ON commandes.rid = recettes.rid JOIN users ON commandes.uid = users.uid");
}

echo "<div class='center'><table class='table table-dark'><tr><td>cid</td><td>Ref</td><td>User</td><td>Pizza</td><td>Prix total</td><td>Date</td><td>Statut</td></tr>";

while($row = $res -> fetch()){
	$req = $db -> prepare("SELECT prix FROM recettes WHERE rid IN (SELECT rid FROM commandes WHERE cid = ?)");
	$res_prix = $req -> execute(array($row["cid"]));
	$row2 = $req -> fetch();
	$prix = $row2["prix"];

	$req = $db -> prepare("SELECT prix FROM supplements WHERE sid IN (SELECT sid FROM extras WHERE cid = ?)");
	$res_prix = $req -> execute(array($row["cid"]));
	while ($row2 = $req -> fetch()) {
		$prix += $row2["prix"];
	}
	echo "<tr><td>".$row["cid"]."</td><td>".$row["ref"]."</td><td>".htmlspecialchars($row["user"])."</td><td>".htmlspecialchars($row["pizza"])."</td><td>".$prix."€</td><td>".$row["date"]."</td><td>".$row["statut"]."</td><td><a class='btn btn-primary' href='details_commande.php?cid=".$row["cid"]."'>Détails</a></td><td><a class='btn btn-warning' href='terminer.php?cid=" .$row["cid"]."'>Terminer</a></td><td><a class='btn btn-warning' href='livrer.php?cid=".$row["cid"]."'>Livrer</a></td></tr>";
}
echo "</table></div>";


include 'footer.php';

?>


<?php

require("auth/EtreAuthentifie.php");

$title = 'Commander';
include 'header.php';
include 'toolbar.php';

$bouton = "commander";
if (empty($_POST["pizza"])){
	//afficher le formulaire pour selectionner la commande
	include 'form_commande_modif.php';
}else{
	//randome.php contient la fonction random($var) pour créer la ref de la commande
	include 'random.php';
	$ref = random(5);
	$sql = "INSERT INTO commandes VALUES (null,?,?,?,NOW(),'preparation')";
	$req = $db -> prepare($sql);

	$req_test = $db -> query("SELECT * FROM supplements");
	$n = $req_test -> rowcount();

	$test = true;
	for ($i=1; $i<=$n ; $i++) { 
		$test &= empty($_POST[$i]);
	}

	//si il n'y a pas de supplément
	if($test){
		$res = $req -> execute(array($ref, $idm->getUid(), $_POST["pizza"]));
		if($res)
			echo "<p class=center>commande efféctué! votre commande sera prete dans 15 minutes</p>";
		else
			echo "<p class=error>une erreur s'est produite veuillez contacter l'admin</p>";
	}

	//si il y a un ou plusieurs suppléments
	else{
		$res = $req -> execute(array($ref, $idm->getUid(), $_POST["pizza"]));
		$sql2 = "INSERT INTO extras VALUES ((SELECT cid FROM commandes WHERE ref = ?),?)";
		$req2 = $db -> prepare($sql2);
		
		$res2 = true;
		for ($i=1; $i<=$n ; $i++){
			if (!empty($_POST[$i]))
				$res2 &= $req2 -> execute(array($ref, $_POST[$i]));
		}

		if($res && $res2){
			$req = $db -> prepare("SELECT prix FROM recettes WHERE rid IN (SELECT rid FROM commandes WHERE cid IN (SELECT cid FROM commandes WHERE ref = ?))");
			$res = $req -> execute(array($ref));
			$row = $req -> fetch();
			$prix = $row["prix"];

			$req = $db -> prepare("SELECT prix FROM supplements WHERE sid IN (SELECT sid FROM extras WHERE cid IN (SELECT cid FROM commandes WHERE ref = ?))");
			$res = $req -> execute(array($ref));
			while ($row2 = $req -> fetch()) {
				$prix += $row2["prix"];
			}
			echo "<p class=center>Commande efféctué!</p>";
			echo "<p class=center>Reference de votre commande: ".$ref."</p>";
			echo "<p class=center>Prix total: ".$prix."€</p>";
		}
		else
			echo "<p class=error>une erreur s'est produite veuillez contacter l'admin</p>";
	}
}


include 'footer.php';

?>
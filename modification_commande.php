<?php

require("auth/EtreAuthentifie.php");
$title = 'Modifier commande';
include 'header.php';
include 'toolbar.php';

$bouton = "Modifier";
if(!empty($_GET["cid"])){
	$test = $db -> prepare("SELECT * FROM commandes WHERE cid = ? AND uid = ? AND statut = 'preparation'");
	$res = $test -> execute(array($_GET["cid"], $idm -> getUid()));
	if ($res && $test -> rowcount() != 0) {
		if(empty($_POST["pizza"])) {
			include('form_commande_modif.php');
		}else{
			$sql_del = "DELETE FROM extras WHERE cid = ?";
			$req_del = $db -> prepare($sql_del);
			$req_del -> execute(array($_GET["cid"]));

			$req_test = $db -> query("SELECT * FROM supplements");
			$n = $req_test -> rowcount();

			$test = true;
			for ($i=1; $i<=$n ; $i++) { 
				$test &= empty($_POST[$i]);
			}

			if($test) {
				$sql = "UPDATE commandes SET date = NOW(), rid = ? WHERE cid = ?";
				$req = $db -> prepare($sql);
				$res = $req -> execute(array($_POST["pizza"], $_GET["cid"]));
				if($res && $req_del){
					echo "<p class='center'>modification effectuée</p>";
				}
				else
					echo "<p class='error'>une erreur s'est produite veuillez contacter l'admin</p>";
			}else{
				$sql = "UPDATE commandes SET date = NOW(), rid = ? WHERE cid = ?";
				$req = $db -> prepare($sql);
				$res = $req -> execute(array($_POST["pizza"], $_GET["cid"]));

				$sql2 = "INSERT INTO extras(sid, cid) VALUES(?,?)";
				$req2 = $db -> prepare($sql2);

				for ($i=1; $i<=$n ; $i++) { 
					if (!empty($_POST[$i])) {
						$res2 = $req2 -> execute(array($_POST[$i], $_GET["cid"]));
					}
				}
				if($res && $res2){
					$req = $db -> prepare("SELECT prix FROM recettes WHERE rid IN (SELECT rid FROM commandes WHERE cid = ?)");
					$res_prix = $req -> execute(array($_GET["cid"]));
					$row2 = $req -> fetch();
					$prix = $row2["prix"];

					$req = $db -> prepare("SELECT prix FROM supplements WHERE sid IN (SELECT sid FROM extras WHERE cid = ?)");
					$res_prix = $req -> execute(array($_GET["cid"]));
					while ($row2 = $req -> fetch()) {
						$prix += $row2["prix"];
					}
					echo "<p class='center'>modification effectuée</p>";
					echo "<p class=center>Prix total: ".$prix."€</p>";
				} else{
					echo "<p class='error'>une erreur s'est produite veuillez contacter l'admin</p>";
				}
			}
		}
	}else{
		echo "<p class='error'>Erreur! Commande inexistante ou déjà terminée</p>";
	}	
}

include 'footer.php';

?>
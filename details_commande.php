<?php

require("auth/EtreAuthentifie.php");

$title = 'Détails commande';
include 'header.php';

if ($idm -> getRole() == 'admin') {
	include 'toolbar_admin.php';

	if(!empty($_GET["cid"])){
		if (is_numeric($_GET["cid"])) {
			$sql = "SELECT users.uid as uid, nom, prenom, ref, date, statut FROM commandes JOIN users ON users.uid = commandes.uid WHERE cid = ?";
			$req = $db -> prepare($sql);
			$res = $req -> execute(array($_GET["cid"]));
			if($res && $req -> rowcount() != 0){
				$row = $req -> fetch();

				echo "<div class=center>User id: ".htmlspecialchars($row["uid"]). "</div>";
				echo "<div class=center>Nom et prenom: ".htmlspecialchars($row["nom"])." ".htmlspecialchars($row["prenom"]). "</div>";
				echo "<br/>";
				echo "<div class=center>Référence de la commande: ".htmlspecialchars($row["ref"])."</div>";
				echo "<div class=center>Date de la commande: ".htmlspecialchars($row["date"])."</div>";
				echo "<div class=center>Statut de la commande: ".htmlspecialchars($row["statut"])."</div>";
				echo "<br/>";


				$sql = "SELECT * FROM recettes WHERE rid IN (SELECT rid FROM commandes WHERE cid = ?)";
				$req = $db -> prepare($sql);
				$res = $req -> execute(array($_GET["cid"]));
				
				if($res && $req -> rowcount() != 0){
					$row = $req -> fetch();
					echo "<div class=center>Pizza commandée: " .htmlspecialchars($row["nom"]). " - Prix: " .htmlspecialchars($row["prix"])." €</div>";
					$prix = $row["prix"];

					$sql = "SELECT * FROM supplements WHERE sid IN (SELECT sid FROM extras WHERE cid = ?)";
					$req = $db -> prepare($sql);
					$res = $req -> execute(array($_GET["cid"]));
					if($res){
						echo "<div class=center>Suppléments commandés:";
						if ($req -> rowcount() == 0) {
							echo "<li>Aucun</li> </div>";
						}else{
							while ($row = $req -> fetch()) {
								echo "<li>".htmlspecialchars($row["nom"]). " - Prix: " .htmlspecialchars($row["prix"])." €</li>";
								$prix += $row["prix"];
							}
							echo "</div>";
						}
						echo "<br/>";
						echo "<div class=center>Prix total de la commande: " .$prix. " €</div>";
						echo "<br/>";
						echo "<div class=center> <a class='btn btn-warning' href='terminer.php?cid=" .htmlspecialchars($_GET["cid"]). "'>Terminer</a> <a class='btn btn-warning' href='livrer.php?cid=" .htmlspecialchars($_GET["cid"]). "'>Livrer</a> </div>";
					}else {
						echo "<p class=error>une erreur s'est produite !</p>";
					}
				}else{
					echo "<p class=error>Cette commande n'existe pas !</p>";
				}
			}else{
				echo "<p class=error>une erreur s'est produite !</p>";
			}
		}else{
			echo "<p class=error>une erreur s'est produite !</p>";
		}
	}	
}

else{
	include 'toolbar.php';
	if(!empty($_GET["cid"])){
		if (is_numeric($_GET["cid"])) {
			$sql = "SELECT ref, date, statut FROM commandes WHERE cid = ? AND uid = ?";
			$req = $db -> prepare($sql);
			$res = $req -> execute(array($_GET["cid"], $idm -> getUid()));
			if($res && $req -> rowcount() != 0){
				$row = $req -> fetch();
				echo "<div class=center>Référence de la commande: ".htmlspecialchars($row["ref"])."</div>";
				echo "<div class=center>Date de la commande: ".htmlspecialchars($row["date"])."</div>";
				echo "<div class=center>Statut de la commande: ".htmlspecialchars($row["statut"])."</div>";
				echo "<br/>";
				$sql = "SELECT * FROM recettes WHERE rid IN (SELECT rid FROM commandes WHERE cid = ?)";
				$req = $db -> prepare($sql);
				$res = $req -> execute(array($_GET["cid"]));
				if($res && $req -> rowcount() != 0){
					$row = $req -> fetch();
					echo "<div class=center>Pizza commandée: " .htmlspecialchars($row["nom"]). " Prix: " .htmlspecialchars($row["prix"])." €</div>";
					$prix = $row["prix"];

					$sql = "SELECT * FROM supplements WHERE sid IN (SELECT sid FROM extras WHERE cid = ?)";
					$req = $db -> prepare($sql);
					$res = $req -> execute(array($_GET["cid"]));
					if($res){
						echo "<div class=center>Suppléments commandés:";
						if ($req -> rowcount() == 0) {
							echo "<li>Aucun</li> </div>";
						}else{
							while ($row = $req -> fetch()) {
								echo "<li>".htmlspecialchars($row["nom"]). " Prix: " .htmlspecialchars($row["prix"])." €</li>";
								$prix += $row["prix"];
							}
							echo "</div>";
							echo "<br/>";
						}
						echo "<div class=center>Prix total de la commande: " .$prix. " €</div>";
						echo "<br/>";
						echo '<div class="center"> <a class="btn btn-warning" href="modification_commande.php?cid='.htmlspecialchars($_GET["cid"]).'">Modifier</a> </div>';
					}else {
						echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
					}
				}else{
					echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
				}
			}else{
				echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
			}
		}else{
			echo "<p class=error>une erreur s'est produite veillez contacter l'admin</p>";
		}
	}
}



include 'footer.php';
?>


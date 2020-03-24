<?php

require("auth/EtreAuthentifie.php");
$title = 'Gestion des Recettes et Suppléments';
include 'header.php';

if ($idm -> getRole() == 'admin') {
	include 'toolbar_admin.php';
	echo "<h1 class='center'>Recettes: </h1>";
	$res = $db->query("SELECT * FROM recettes");

	echo '<div class="center"><table> <tr> <td> Nom </td> <td> Prix </td> </tr>';
	while($row = $res->fetch())
		echo '<tr> <td> ' .htmlspecialchars($row["nom"]). ' </td> <td> ' .htmlspecialchars($row["prix"]). '€ </td> <td> <a class="btn btn-warning" href="modification_trs.php?rid='. $row["rid"] .'">Modifier</a> </td> <td> <a class="btn btn-danger" href="suppression.php?rid='. $row["rid"] .'">Supprimer</a> </td> </tr>';
	echo '<tr><td><a href="ajouter_recette.php" class="btn btn-primary">Ajouter</a></td></tr></table></div>';
	echo "<br/>";


	echo "<h1 class='center'>Supplements: </h1>";
	$res = $db->query("SELECT * FROM supplements");

	echo '<div class="center"><table> <tr> <td> Nom </td> <td> Prix </td> </tr>';
	while($row = $res->fetch())
		echo '<tr> <td> ' .htmlspecialchars($row["nom"]). ' </td> <td> ' .htmlspecialchars($row["prix"]). '€ </td> <td> <a class="btn btn-warning" href="modification_trs.php?sid='. $row["sid"] .'">Modifier</a> </td> <td> <a class="btn btn-danger" href="suppression.php?sid='. $row["sid"] .'">Supprimer</a> </td> </tr>';
	echo '<tr><td><a href="ajouter_supplement.php" class="btn btn-primary">Ajouter</a></td></tr></table></div>';
}else{
	echo "<p class='error'>Vous n'etes pas administrateur</p>";
}

include 'footer.php';
?>
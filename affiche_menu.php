<?php

require("auth/EtreAuthentifie.php");

$title = 'Nos pizzas';
include 'header.php';
include 'toolbar.php';

$res = $db->query("SELECT nom, prix FROM recettes");
echo "<h1 class=center>Nos Pizzas: </h1>";
echo "<div class=center><table class='table table-sm table-dark'><tr><td>Pizza</td><td>Prix</td></tr>";
while($row = $res->fetch())
	echo "<tr><td>" .htmlspecialchars($row["nom"]). "</td><td>" .htmlspecialchars($row["prix"]). "€</td></tr>";

echo "</table></div>";

$res = $db->query("SELECT nom, prix FROM supplements");

echo "<h1 class=center>Nos Supplements: </h1>";
echo "<div class=center><table class='table table-sm table-dark'><tr><td>Pizza</td><td>Prix</td></tr>";
while($row = $res->fetch())
	echo "<tr><td>" .htmlspecialchars($row["nom"]). "</td><td>" .htmlspecialchars($row["prix"]). "€</td></tr>";

echo "</table></div>";


include 'footer.php';

?>

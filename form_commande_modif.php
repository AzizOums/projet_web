<?php

//le formulaire de selection ou modification de commande 
echo '<div class="center"><h1>Commander</h1> <form class="form-group" method="post" >';
$res = $db->query("SELECT * FROM recettes");

//pizza
echo '<table><tr><td><label for="inputNom" class="control-label">Pizzas</label></td> <td><select name="pizza" class="form-control" id="inputNom">';
while($row = $res -> fetch()){
	echo '<option value="' .htmlspecialchars($row['rid']). '">' .htmlspecialchars($row['nom']).': '.htmlspecialchars($row['prix']). '€</option>';
}
echo '</select></td></tr></table>';

//supplements
$res = $db->query("SELECT * FROM supplements");
echo "<div>Suppléments:</div>";

$i = 1;
while($row = $res -> fetch()){
	echo '<div><input class="form-check-input" type="checkbox" name="' .$i. '" value="'.htmlspecialchars($row['sid']).'" id="'.$i.'"><label class="form-check-label" for="'.$i.'">' .$row['nom']. ": " .htmlspecialchars($row['prix']). '€</label></div>';
	$i ++;
}

echo '<div><button type="submit" class="btn btn-primary">'.$bouton.'</button></div></form></div>';

?>

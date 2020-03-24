<?php

$sql = "SELECT cid FROM commandes where uid = ? AND statut = 'preparation'";
$req = $db -> prepare($sql);
$res = $req -> execute(array($idm -> getUid()));

if($req -> rowcount() != 0){
	?>

	<div class='center'>
		<h1>modifier commande</h1>
		<form class='form-group' action='' method='post'>
			<table>
				<tr>
					<td><label for='inputCid' class='control-label'>commande id</label></td>
					<td><select name='cid' class='form-control' id='inputCid'>
					<?php
					while($row = $req -> fetch()){
					?>
	    				<option value=" <?php echo $row["cid"]; ?> "><?php echo htmlspecialchars($row["cid"]); ?></option>
					<?php
					}
					?>
					</select></td>
				</tr>
			</table> 
			<button type='submit' class='btn btn-primary'>modifier</button>
		</form>
	</div>

<?php
}else{
	echo "<p class='error'>Aucune commande a modifier</p>";
}

?>

<div class="center">
    <h1>Mdification</h1>
    <form method="post">
        <table>
            <tr>
                <td><label for="inputNom" class="control-label"><?php echo htmlspecialchars($_GET['modif']); ?></label></td>
                 <td><input type="text" name="modif" class="form-control" id="inputNom" placeholder="<?php echo htmlspecialchars($_GET['modif']); ?>">
                 </td>
            </tr>
        </table>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
    </form>
</div>
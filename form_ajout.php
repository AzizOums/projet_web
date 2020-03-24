<div class="center">
    <h1><? echo $head; ?></h1>
    <form method="post">
        <table>
            <tr>
                <td><label for="inputNom" class="control-label">Nom</label></td>
                 <td><input type="text" name="nom" class="form-control" id="inputNom" placeholder="Nom">
                 </td>
            </tr>
            <tr>
               <td> <label for="inputPrix" class="control-label">Prix</label></td>
                  <td>  <input type="number" step="0.01" name="prix" class="form-control" id="inputPrix" placeholder="Prix"></td>
            </tr>
        </table>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><?php echo $bouton; ?></button>
            </div>
    </form>
</div>
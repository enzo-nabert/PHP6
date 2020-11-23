<form method="get" action="index.php">
    <fieldset>
        <legend>Mon formulaire :</legend>
        <p>
            <label for="immat_id">Immatriculation</label>
            <?php
            echo "<input type='text' placeholder='Ex : 256AB34' name='immatriculation' readonly id='immat_id' value='{$_GET["immat"]}'/>"
            ?>
            <label for="marque_id">Marque</label>
            <input type="text" name="marque" id="marque_id" required/>
            <label for="couleur_id">Couleur</label>
            <input type="text" name="couleur" id="couleur_id" required/>
            <input type='hidden' name='action' value='updated'>
            <input type='hidden' name="controller" value="voiture">
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
    </fieldset>
</form>
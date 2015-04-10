<label for="lstMois" accesskey="n">Mois : </label>
<select id="lstMois" class="form-control" name="lstMois">
    <?php
    foreach ($lesFichesFrais as $uneFiche) {
        $mois = $uneFiche['mois'];
        $numAnnee = $uneFiche['numAnnee'];
        $numMois = $uneFiche['numMois'];
        if ($mois == $ficheASelectionner) {
            ?>
            <option selected value="<?php echo $uneFiche ?>"><?php echo $numMois . "/" . $numAnnee." - ".$uneFiche['id']." - ".$unFiche['etat'] ?> </option>
            <?php
        } else {
            ?>
            <option value="<?php echo $uneFiche ?>"><?php echo $numMois . "/" . $numAnnee." - ".$uneFiche['id']." - ".$unFiche['etat'] ?> </option>
            <?php
        }
    }
    ?>            
</select>

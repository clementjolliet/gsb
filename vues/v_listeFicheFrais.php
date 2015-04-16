<label for="lstFichefrais" accesskey="n">Fiche de frais : </label>
<select id="lstFichefrais" class="form-control" name="lstFichefrais">
    <?php
    foreach ($lesFichesFrais as $uneFiche) {
        $mois = $uneFiche['mois'];
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        ?>
        <option selected value="<?php echo $uneFiche['idvisiteur'].'/'.$mois ?>"><?php echo $numMois . "/" . $numAnnee . " - " . $uneFiche['nom'] . " " . $uneFiche['prenom'] ?> </option>
        <?php
    }
    ?>            
</select>

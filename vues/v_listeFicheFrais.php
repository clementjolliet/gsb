<label for="lstFichefrais" accesskey="n">Fiche de frais : </label>
<select id="lstFichefrais" class="form-control" name="lstFichefrais">
    <?php
    foreach ($lesFichesFrais as $uneFiche) {
        $idvisiteur=$uneFiche['idvisiteur'];
        $nom=$uneFiche['nom'];
        $prenom=$uneFiche['prenom'];
        $mois = $uneFiche['mois'];
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
            ?>
        <option selected value="<?php echo $idvisiteur.'/'.$mois ?>"><?php echo $numMois . "/" . $numAnnee . " - " . $nom . " " . $prenom ?> </option>
        <?php
    }
    ?>            
</select>

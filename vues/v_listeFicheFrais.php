<label for="1stFicheFrais" accesskey="n">Fiche de frais : </label>
<select id="1stFicheFrais" class="form-control" name="1stFicheFrais">
    <?php
    foreach ($lesFichesFrais as $uneFiche) {
        $idvisiteur = $uneFiche['idvisiteur'];
        $nom = $uneFiche['nom'];
        $prenom = $uneFiche['prenom'];
        $mois = $uneFiche['mois'];
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        if ($idvisiteur == $idASelectionner) {
            ?>
            <option selected value="<?php echo $idvisiteur . '/' . $mois ?>"><?php echo $numMois . "/" . $numAnnee . " - " . $nom . " " . $prenom ?> </option>
            <?php
        } else {
            ?>
            <option  value="<?php echo $idvisiteur . '/' . $mois ?>"><?php echo $numMois . "/" . $numAnnee . " - " . $nom . " " . $prenom ?> </option>
            <?php
        }
    }
    ?>            
</select>

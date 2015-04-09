<label for="lstVisiteurs" accesskey="n">Visiteurs : </label>
<select id="lstVisiteurs" class="form-control" name="lstVisiteurs">
    <?php
    foreach ($lesVisiteurs as $unVisiteur) {
        $idVisiteur = $unVisiteur->id;
        $nomVisiteur = $unVisiteur->nom;
        $prenomVisiteur = $unVisiteur->prenom;

        if($idVisiteur == $visiteurASelectionner) {
            ?>
            <option selected value="<?php echo $idVisiteur ?>"><?php echo $nomVisiteur . " " . $prenomVisiteur ?> </option>
            <?php
        }
        else{
            ?>
            <option value="<?php echo $idVisiteur ?>"><?php echo $nomVisiteur . " " . $prenomVisiteur ?> </option>
            <?php
        }
    }
    ?>    

</select>
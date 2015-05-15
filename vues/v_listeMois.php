<label for="lstMois" accesskey="n">Mois : </label>
<select id="lstMois" class="form-control" name="lstMois">
    <?php
    foreach ($lesMois as $unMois) {
        $mois = $unMois['mois'];
        $numAnnee = $unMois['numAnnee'];
        $numMois = $unMois['numMois'];
        if (isset($moisASelectionner)) {
            if ($mois == $moisASelectionner) {
                ?>
                <option selected value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                <?php
            } else {
                ?>
                <option value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                <?php
            }
        } else {
            ?>
            <option value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
            <?php
        }
    }
    ?>            
</select>
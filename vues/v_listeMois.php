<!--﻿ <div id="contenu">-->
<div class="container-fluid">
    <h2>Mes fiches de frais</h2>
    <h3>Mois à sélectionner : </h3>
    <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
        <!--      <div class="corpsForm">-->
        <div class=" col-lg-2 col-md-2 col-xs-2 form-group">
            <label for="lstMois" accesskey="n">Mois : </label>
            <select id="lstMois" class="form-control" name="lstMois">
                <?php
                foreach ($lesMois as $unMois) {
                    $mois = $unMois['mois'];
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    if ($mois == $moisASelectionner) {
                        ?>
                        <option selected value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $mois ?>"><?php echo $numMois . "/" . $numAnnee ?> </option>
                        <?php
                    }
                }
                ?>            
            </select>
        </div>      
        <div class="col-lg-offset-9 col-md-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-xs-3">
            <input id="ok" type="submit" class="btn btn-success" value="Valider" />
        </div>

    </form>
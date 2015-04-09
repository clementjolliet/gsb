
<!--<div id="contenu">-->
<div class="container-fluid">
    <div class="col-lg-12 col-md-10 col-xs-10">
        <h3 class="well">Renseigner ma fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?></h3>
        <div class="col-lg-12">
            <form method="POST" action="index.php?uc=gererFrais&action=validerMajFraisForfait">
                <!--        <div class="corpsForm">-->

                <fieldset>
                    <legend>Eléments forfaitisés
                    </legend>
                    <?php
                    foreach ($lesFraisForfait as $unFrais) {
                        $idFrais = $unFrais['idfrais'];
                        $libelle = $unFrais['libelle'];
                        $quantite = $unFrais['quantite'];
                        ?>
                        <div class="col-lg-12">
                            <div class="form-horizontal">
                                <div class="form-group"
                                     <label for="idFrais[<?php echo $idFrais ?>]"><?php echo $libelle ?></label>
                                    <input type="text" id="idFrais" class="form-control" name="lesFrais[<?php echo $idFrais ?>]" size="10" maxlength="5" value="<?php echo $quantite ?>" >
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </fieldset>
                <!--        </div>-->
                <!--        <div class="piedForm">-->
                <div class="col-lg-12">
                    <div class="col-lg-offset-10 col-md-offset-10 col-xs-offset-10 col-lg-2 col-md-2 col-xs-2">
                        <div class="form-group">
                            <input id="ok" class="btn btn-success" type="submit" value="Valider"  />
                        </div> 
                    </div>
                </div>
                <!--        </div>-->
            </form>
        </div>
    </div>


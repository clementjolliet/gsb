<?php
if ($action == "affichePageFraisComptable" && $_SESSION['fonction'] == "comptable") {
    ?>
    <form action="index.php?uc=comptableValidationFiche&action=validerFraisComptable" method="post">
        <?php
    } else if ($action == "" && $_SESSION['fonction'] == "comptable") {
        ?>

        <form action="index.php?uc=comptableValidationFiche&action=#" method="post">
        <?php } ?>

        <div class="col-lg-12">
            <h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
            </h3>
            <?php
            if ($action == "affichePageFraisComptable" && $_SESSION['fonction'] == "comptable") {
                ?>
                <input name="idVisiteur" style="display: none" value="<?php echo $visiteurASelectionner; ?>"/>
                <input name="moiSelected" style="display: none" value="<?php echo $moisASelectionner; ?>"/>
                <?php
            }
            ?>
        </div>
        <div class="col-lg-12">
            <p>
                Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>           
            </p>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <caption>Eléments forfaitisés </caption>
                    <tr>
                        <?php
                        foreach ($lesFraisForfait as $unFraisForfait) {
                            $libelle = $unFraisForfait['libelle'];
                            ?>	
                            <th> <?php echo $libelle ?></th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        foreach ($lesFraisForfait as $unFraisForfait) {
                            $idFrais = $unFraisForfait['idfrais'];
                            $quantite = $unFraisForfait['quantite'];
                            if ($action == "affichePageFraisComptable" && $_SESSION['fonction'] == "comptable") {
                                ?>
                                <td class="qteForfait">
                                    <input id="idFrais" name="lesFrais[<?php echo $idFrais ?>]" value="<?php echo $quantite ?>">
                                </td>
                                <?php
                            } else {
                                ?>
                                <td class="qteForfait"><?php echo $quantite ?> </td>
                                <?php
                            }
                        }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
                    </caption>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Libellé</th>
                            <th>Montant</th>                
                        </tr>
                    </thead>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $date = $unFraisHorsForfait['date'];
                        $libelle = $unFraisHorsForfait['libelle'];
                        $montant = $unFraisHorsForfait['montant'];

                        if ($action == "affichePageFraisComptable" && $_SESSION['fonction'] == "comptable") {
                            ?>
                            <tr>
                                <td>
                                    <input value="<?php echo $date ?>">
                                </td>
                                <td>
                                    <input value="<?php echo $libelle ?>">
                                </td>
                                <td>
                                    <input value="<?php echo $montant ?>">
                                </td>
                                <td>
                                    <input type="checkbox" checked="true">
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <tr>
                                <td><?php echo $date ?></td>
                                <td><?php echo $libelle ?></td>
                                <td><?php echo $montant ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>



        </div>
        <div class="col-lg-offset-9 col-md-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-xs-3">
            <input id="ok" type="submit" class="btn btn-success" value="Valider" />
        </div>
    </form>
</div>
</div>

<div class="col-lg-12">
    <h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> : 
    </h3></div>
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
                    $quantite = $unFraisForfait['quantite'];
                    if ($_SESSION['fonction'] == "visiteur") {
                        ?>
                        <td class="qteForfait"><?php echo $quantite ?> </td>
                        <?php
                    }
                    else{
                        ?>
                        <td class="qteForfait">
                            <input value="<?php echo $quantite ?>">
                        </td>
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

                if ($_SESSION['fonction'] == "visiteur") {
                    ?>
                    <tr>
                        <td><?php echo $date ?></td>
                        <td><?php echo $libelle ?></td>
                        <td><?php echo $montant ?></td>
                    </tr>
                    <?php
                } else {
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
                            <input type="checkbox">
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</div>
</div>















<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <caption>Descriptif des éléments hors forfait
            </caption>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Libellé</th>  
                    <th>Montant</th>  
                    <th>&nbsp;</th>              
                </tr>
            </thead>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $libelle = $unFraisHorsForfait['libelle'];
                $date = $unFraisHorsForfait['date'];
                $montant = $unFraisHorsForfait['montant'];
                $id = $unFraisHorsForfait['id'];
                ?>		
                <tr>
                    <td> <?php echo $date ?></td>
                    <td><?php echo $libelle ?></td>
                    <td><?php echo $montant ?></td>
                    <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>" 
                           onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
                </tr>
                <?php
            }
            ?>	  
        </table>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <form class="form-horizontal" action="index.php?uc=gererFrais&action=validerCreationFrais" method="post">
        <!--    <div class="corpsForm">-->
        <fieldset>
            <legend>Nouvel élément hors forfait</legend> 
            <div class="form-group">
                <label for="txtDateHF" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Date (jj/mm/aaaa) : </label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <input type="text" id="txtDateHF" class="form-control" name="dateFrais" size="10" maxlength="10" value=""  />
                </div>
            </div>
            <div class="form-group">
                <label for="txtLibelleHF" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Libellé : </label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <input type="text" id="txtLibelleHF" class="form-control" name="libelle" size="70" maxlength="256" value="" />
                </div>
            </div>
            <div class="form-group">
                <label for="txtMontantHF" class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Montant : </label>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                    <input type="text" id="txtMontantHF" class="form-control" name="montant" size="10" maxlength="10" value="" />
                </div>
            </div>
        </fieldset>
        <!--    </div>-->
        <!--    <div class="piedForm">-->

        <div id="grpButtonFraishorsforfait">           
            <input type="submit" class="btn btn-success" value="Ajouter" size="20" />         
        </div>
        <!--    </div>-->
    </form>
</div>
</div>




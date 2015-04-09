<!--﻿ <div id="contenu">-->
<div class="container-fluid">
    <h2>Validation de fiche de frais</h2>
    <h3>Visiteur à sélectionner : </h3>
    <form action="index.php?uc=comptable&action=pageFraisComptable" method="post">
        <div class=" col-lg-2 col-md-2 col-xs-2 form-group">

            <p>

                <?php
                include 'v_listeVisiteurs.php';
                ?>
                
            </p>
            
            <p>
                <?php
                include 'v_listeMois.php';
                ?>
            </p>
        </div>
        <div class="col-lg-offset-9 col-md-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-xs-3">
            <p>
                <input id="ok" type="submit" value="Valider" size="20" />
            </p> 
        </div>

    </form>
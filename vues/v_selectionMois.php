<!--﻿ <div id="contenu">-->
<div class="container-fluid">
    <h2>Mes fiches de frais</h2>
    <h3>Mois à sélectionner : </h3>
    <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
        <!--      <div class="corpsForm">-->
        <div class=" col-lg-2 col-md-2 col-xs-2 form-group">
            <?php
            include 'v_listeMois.php';
            ?>
        </div>      
        <div class="col-lg-offset-9 col-md-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-xs-3">
            <input id="ok" type="submit" class="btn btn-success" value="Valider" />
        </div>

    </form>
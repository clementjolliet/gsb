<div class="container-fluid">
    <h2>Suivi des fiches de frais</h2>
    <h3>Fiche à sélectionner : </h3>
    <form action="index.php?uc=comptableSuiviPaiementFiche&action=voirFicheFrais" method="post">
        <!--      <div class="corpsForm">-->
        <div class=" col-lg-5 col-md-5 col-xs-5 form-group">
            <?php
            include 'v_listeFicheFrais.php';
            ?>
        </div>      
        <div class="col-lg-offset-9 col-md-offset-9 col-xs-offset-9 col-lg-3 col-md-3 col-xs-3">
            <input id="ok" type="submit" class="btn btn-success" value="Valider" />
        </div>

    </form>


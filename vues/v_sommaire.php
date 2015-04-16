    <!-- Division pour le sommaire -->

<div id="menuGauche" class="col-lg-2 col-md-2 col-xs-2">
    <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#"><?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?></a></li>
        <!--    <ul id="menuList">-->
        <?php
        echo "<style type='text/css'>";
        if ($_SESSION['fonction'] == "comptable") {
            echo "body { background-color: #E67E30 !important; }";
            echo ".nav-pills>li.active>a { background-color: #E67E30 !important; }";
        } else {
            echo "body { background-color: #357AB7 !important; }";
        }
        echo "</style>";
        ?>
        <!-- Affichage du menu si l'utilisateur est un visiteur -->
        <?php
        if ($_SESSION['fonction'] == "visiteur") {
            ?>
            <li><a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais">Saisie</a></li>
            <li><a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches</a></li>
            <li><a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a></li>

            <!--        <li class="smenu">
                        <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
                    </li>
                    <li class="smenu">
                        <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
                    </li>-->

            <!-- Affichage du menu si l'utilisateur est un comptable -->
            <?php
        } else if ($_SESSION['fonction'] == "comptable") {
            ?>
            <li><a href="index.php?uc=comptableValidationFiche&action=#" title="Valider fiche de frais">Validation</a></li>
            <li><a href="index.php?uc=comptableSuiviPaiementFiche&action=selectionnerFicheFrais" title="Suivie des fiches de frais">Suivies</a></li>
            <li><a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a></li>

            <!--            <li class="smenu">
                            <a href="#" title="Valider fiche de frais">Valider une fiche de frais</a>
                        </li>
                        <li class="smenu">
                            <a href="#" title="Suivie des fiches de frais">Suivie des fiches de frais</a>
                        </li>
                        <li class="smenu">
                            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
                        </li>-->
            <?php
        }
        ?>
    </ul>
</div>


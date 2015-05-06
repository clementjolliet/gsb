<?php

include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$lesFichesFrais = $pdo->getFicheFraisEtat('CL');
if (isset($_REQUEST['1stFicheFrais'])) {
    $valueListe = $_REQUEST['1stFicheFrais'];
    $fichefrais = explode('/', $valueListe);
    $idASelectionner = $fichefrais[0];
    $leMois = $fichefrais[1];
}
include("vues/v_selectionFicheFrais.php");


switch ($action) {
    case 'affichePageFraisComptable': {

            try {
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idASelectionner, $leMois);
                $lesFraisForfait = $pdo->getLesFraisForfait($idASelectionner, $leMois);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idASelectionner, $leMois);
                $numAnnee = substr($leMois, 0, 4);
                $numMois = substr($leMois, 4, 2);

                $StateFiche = $lesInfosFicheFrais[0];

                $libEtat = $lesInfosFicheFrais['idEtat'];
                $montantValide = $lesInfosFicheFrais['montantValide'];
                $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
                $dateModif = $lesInfosFicheFrais['dateModif'];
                $dateModif = dateAnglaisVersFrancais($dateModif);
                include("vues/v_etatFrais.php");
            } catch (Exception $ex) {
                ajouterErreur('Erreur pour l\'affichage des Frais');
                include('vues/v_erreurs.php');
            }
            break;
        }
    case 'validerFraisComptable': {
            $lesFrais = $_REQUEST['lesFrais'];
            $visiteurSelected = $_REQUEST['idVisiteurFicheFrais'];
            $moiSelected = $_REQUEST['moiSelectedFicheFrais'];

            $lesFichesFraisHorsForfait = $_REQUEST['lesFicheHorsForfait'];

            if (lesQteFraisValides($lesFrais)) {
                $pdo->majFraisForfait($visiteurSelected, $moiSelected, $lesFrais);
                echo '<div class="col-lg-10 col-md-10 col-xs-10"><div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                . '<strong>Succés !</strong> La fiche de frais a bien été mis à jour.</div></div>';
            } else {
                ajouterErreur("Les valeurs des frais doivent être numériques");
                include("vues/v_erreurs.php");
            }
            for ($i = 0; $i < count($lesFichesFraisHorsForfait); $i++) {
                $idLigne = $lesFichesFraisHorsForfait[$i]['id'];
                $libelleLigne = $lesFichesFraisHorsForfait[$i]['libelle'];
                $montantLigne = $lesFichesFraisHorsForfait[$i]['montant'];
                if (isset($lesFichesFraisHorsForfait[$i]['valide'])) {

                    $valide = $lesFichesFraisHorsForfait[$i]['valide'];
                    if ($valide == 'on') {
                        $pdo->majFraisHorsForfait($idLigne, $libelleLigne, $montantLigne);
                    }
                } else {
                    $pdo->supprimerFraisHorsForfait($idLigne);
                }
            }

            $pdo->majEtatFicheFrais($visiteurSelected, $moiSelected, 'VA');

            break;
        }
}
?>
<?php

include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$lesFichesFrais = $pdo->getFicheFraisAValider();
if (isset($_REQUEST['1stFicheFrais'])) {
    $valueListe = $_REQUEST['1stFicheFrais'];
    $fichefrais = explode('/', $valueListe);
    $idASelectionner = $fichefrais[0];
    $leMois = $fichefrais[1];
}
include("vues/v_selectionFicheFrais.php");

switch ($action) {
    case 'voirFicheFrais': {
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idASelectionner, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idASelectionner, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idASelectionner, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_etatFrais.php");
            break;
        }
    case 'updateEtatFicheFrais': {
            $visiteurSelected = $_REQUEST['idVisiteur'];
            $moiSelected = $_REQUEST['moiSelected'];
            if ($uneFiche['idetat'] == 'CL') {
                $pdo->majEtatFicheFrais($visiteurSelected, $moiSelected, 'VA');
            } else if ($uneFiche['idetat'] == 'VA') {
                $pdo->majEtatFicheFrais($visiteurSelected, $moiSelected, 'RB');
            }
            break;
        }
}
<?php

include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];

$lesVisiteurs = $pdo->getLesVisiteurs();
$lesMois = $pdo->getTousLesMois();

$lesCles = array_keys($lesMois);

if (isset($_REQUEST['lstMois'])) {
    $leMois = $_REQUEST['lstMois'];
    $moisASelectionner = $leMois;
} else {
    $moisASelectionner = $lesCles[0];
}

if (isset($_REQUEST['lstVisiteurs'])) {
    $leVisiteur = $_REQUEST['lstVisiteurs'];
    $visiteurASelectionner = $leVisiteur;
}
include("vues/v_selectionVisiteur.php");


switch ($action) {
    case 'affichePageFraisComptable': {

            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($leVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($leVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($leVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);

            $StateFiche = $lesInfosFicheFrais[0];

            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif = $lesInfosFicheFrais['dateModif'];
            $dateModif = dateAnglaisVersFrancais($dateModif);
            include("vues/v_etatFrais.php");
            break;
        }
    case 'validerFraisComptable': {
            $lesFrais = $_REQUEST['lesFrais'];
            $visiteurSelected = $_REQUEST['idVisiteur'];
            $moiSelected = $_REQUEST['moiSelected'];
            if (lesQteFraisValides($lesFrais)) {
                $pdo->majFraisForfait($visiteurSelected, $moiSelected, $lesFrais);
            } else {
                ajouterErreur("Les valeurs des frais doivent être numériques");
                include("vues/v_erreurs.php");
            }
            break;
        }
}
?>
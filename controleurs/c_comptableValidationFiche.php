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

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
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
    case 'validerFraisComptable': {

            break;
        }
}
?>
<?php

include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];

$lesVisiteurs = $pdo->getLesVisiteurs();
$lesMois = $pdo->getTousLesMois();

$lesCles = array_keys($lesMois);
$moisASelectionner = $lesCles[0];
include("vues/v_selectionVisiteur.php");


switch ($action) {
    case 'affichePageFraisComptable': {

            $leMois = $_REQUEST['lstMois'];
            $leVisiteur = $_REQUEST['lstVisiteurs'];

            //permet de re selectionner le mois et le visiteur de la fiche en cours de validation

            $lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
            $moisASelectionner = $leMois;
            $visiteurASelectionner = $leVisiteur;

            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);

            //include("vues/v_selectionVisiteur.php");

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
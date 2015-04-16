<?php

include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];

switch ($action) {
    case 'selectionnerFicheFrais': {
            $lesFichesFrais = $pdo->getFicheFraisAValider();
            include("vues/v_selectionFicheFrais.php");
            break;
        }
    case 'voirFicheFrais': {
            $fichefrais = explode('/', $_REQUEST['lstFichefrais']);
            $idVisiteur = $fichefrais[0];
            $leMois = $fichefrais[1];
            $lesFichesFrais = $pdo->getFicheFraisAValider();
            include("vues/v_selectionFicheFrais.php");
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
        }
}
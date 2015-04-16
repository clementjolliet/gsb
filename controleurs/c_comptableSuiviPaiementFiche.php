<?php

include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$lesFichesFrais = $pdo->getFicheFraisAValider();
include("vues/v_selectionFicheFrais.php");
$fichefrais = explode('/', $_REQUEST['lstFichefrais']);
$id = $fichefrais[0];
$leMois = $fichefrais[1]; 
//$visiteurASelectionner = $id;
switch ($action) {
//    case 'selectionnerFicheFrais': {
//            $lesFichesFrais = $pdo->getFicheFraisAValider();
//            include("vues/v_selectionFicheFrais.php");
//            break;
//        }
    case 'voirFicheFrais': {
//            $lesFichesFrais = $pdo->getFicheFraisAValider();
//            include("vues/v_selectionFicheFrais.php");
//            $fichefrais = explode('/', $_REQUEST['lstFichefrais']);
//            $id = $fichefrais[0];
//            $leMois = $fichefrais[1];
           
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($id, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($id, $leMois);
            $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($id, $leMois);
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
            if ($lesFichesFrais['idetat'] == 'CL') {
                $pdo->majEtatFicheFrais($idVisiteur, $leMois, 'VA');
            } else if ($lesFichesFrais['idetat'] == 'VA') {
                $pdo->majEtatFicheFrais($idVisiteur, $leMois, 'RB');
            }
            break;
        }
}
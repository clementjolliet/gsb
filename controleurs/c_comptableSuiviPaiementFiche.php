<?php
include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];
$mois = getMois(date("d/m/Y"));
$numAnnee = substr($mois, 0, 4);
$numMois = substr($mois, 4, 2);
switch($action){
    case 'selectionnerFicheFrais':{
        $lesFichesFrais=$pdo->getFicheFraisAValider();
        $lesCles = array_keys($lesFichesFrais);
        $ficheASelectionner = $lesCles[0];
        break;
    }
    case 'voirFicheFrais':{
        
    }
}
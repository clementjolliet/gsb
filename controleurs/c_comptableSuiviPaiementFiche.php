<?php
include('vues/v_sommaire.php');
$idVisiteur = $_SESSION['idVisiteur'];
$action = $_REQUEST['action'];

switch($action){
    case 'selectionnerFicheFrais':{
        $lesFichesFrais=$pdo->getFicheFraisAValider();
        include("vues/v_selectionFicheFrais.php");
        break;
    }
    case 'voirFicheFrais':{
        
    }
}
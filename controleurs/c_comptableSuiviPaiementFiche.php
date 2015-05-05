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
            try {
                $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idASelectionner, $leMois);
                $lesFraisForfait = $pdo->getLesFraisForfait($idASelectionner, $leMois);
                $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idASelectionner, $leMois);
                $numAnnee = substr($leMois, 0, 4);
                $numMois = substr($leMois, 4, 2);
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
    case 'updateEtatFicheFrais': {
        try{
            $visiteurSelectedFF = $_REQUEST['idVisiteurFicheFrais'];
            $moiSelectedFF = $_REQUEST['moiSelectedFicheFrais'];
            $etatFF = $_REQUEST['etatFicheFrais'];
            if ($etatFF == 'CL') {
                $pdo->majEtatFicheFrais($visiteurSelectedFF, $moiSelectedFF, 'VA');
            } else if ($etatFF == 'VA') {
                $pdo->majEtatFicheFrais($visiteurSelectedFF, $moiSelectedFF, 'RB');
            }
        }catch(Exception $ex){
            ajouterErreur('Erreur de mise à jour des FicheFrais dans la base de données');
            include('vues/v_erreurs.php');
        }
            break;
        }
}
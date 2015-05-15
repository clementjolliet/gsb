<?php
include("vues/v_sommaire.php");
$idVisiteur = $_SESSION['idVisiteur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
                        echo '<div class="col-lg-10 col-md-10 col-xs-10"> <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                    . '<strong>Succés !</strong> Le frais a bien été ajouté.</div></div>';
		}
		break;
	}
	case 'validerMajFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$mois,$lesFrais);
                         echo '<div class="col-lg-10 col-md-10 col-xs-10"> <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                    . '<strong>Succés !</strong> Le frais forfait a bien été mis à jour.</div></div>';
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	} 
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
                 echo '<div class="col-lg-10 col-md-10 col-xs-10"> <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                    . '<strong>Succés !</strong> Le frais entré est valide.</div></div>';
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois,$libelle,$dateFrais,$montant);
                         echo '<div class="col-lg-10 col-md-10 col-xs-10"> <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                    . '<strong>Succés !</strong> Le frais hors forfait a bien été ajouté.</div></div>';
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
             echo '<div class="col-lg-10 col-md-10 col-xs-10"> <div id="alert" class="alert alert-success alert-dismissible fade in" role="alert">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>'
                    . '<strong>Succés !</strong> Le frais hors forfait a bien été supprimé.</div></div>';
		break;
	}
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$mois);

if (empty($pdo->getLesFraisForfait($idVisiteur,$mois))){
    $pdo->genFraisForfait($idVisiteur, $mois);
}

$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);

include("vues/v_listeFraisForfait.php");
include("vues/v_listeFraisHorsForfait.php");

?>
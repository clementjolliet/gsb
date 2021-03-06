﻿<?php

/**
 * Classe d'accès aux données. 

 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe

 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */
class PdoGsb {

    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=alclerom_gsb';
    private static $user = 'alclerom_gsbuser';
    private static $mdp = 'd1sHello';
    private static $monPdo;
    private static $monPdoGsb = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct() {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct() {
        PdoGsb::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe

     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();

     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoGsb() {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }

    /**
     * Retourne les informations d'un visiteur

     * @param $login 
     * @param $mdp
     * @return l'id, le nom, le prénom et la fonction sous la forme d'un tableau associatif 
     */
    public function getInfosVisiteur($login, $mdp) {
        $req = "select employe.id as id, employe.nom as nom, employe.prenom as prenom, employe.fonction as fonction from employe 
		where employe.login=:login and employe.mdp=:mdp";

        $rs = PdoGsb::$monPdo->prepare($req);
        $rs->bindParam(':login', $login);
        $rs->bindParam(':mdp', $mdp);
        $rs->execute();
        $ligne = $rs->fetch();
        return $ligne;
    }

//    /**
//     * fonction qui verifie l'etat des fiches de frais et met a jour l'etat a cloturé les fiches des mois antérieurs
//     */
//    public function verifEtatFicheDeFrais() {
//        $req = "update fichefrais set idetat = 'CL' where idetat = 'CR' and ";
//
//        $rs = PdoGsb::$monPdo->prepare($req);
//        $rs->execute();
//    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais hors forfait
     * concernées par les deux arguments

     * La boucle foreach ne peut être utilisée ici car on procède
     * à une modification de la structure itérée - transformation du champ date-

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @return tous les champs des lignes de frais hors forfait sous la forme d'un tableau associatif 
     */
    public function getLesFraisHorsForfait($idVisiteur, $mois) {
        $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur =:idVisiteur 
		and lignefraishorsforfait.mois = :mois and lignefraishorsforfait.libelle not like 'REFUSE %'";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $lesLignes = $res->fetchAll();
        $nbLignes = count($lesLignes);
        for ($i = 0; $i < $nbLignes; $i++) {
            $date = $lesLignes[$i]['date'];
            $lesLignes[$i]['date'] = dateAnglaisVersFrancais($date);
        }
        return $lesLignes;
    }

    /**
     * Retourne le nombre de justificatif d'un visiteur pour un mois donné

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @return le nombre entier de justificatifs 
     */
    public function getNbjustificatifs($idVisiteur, $mois) {
        $req = "select fichefrais.nbjustificatifs as nb from  fichefrais where fichefrais.idvisiteur =:idVisiteur and fichefrais.mois = :mois";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $laLigne = $res->fetch();
        return $laLigne['nb'];
    }

    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
     * concernées par les deux arguments

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif 
     */
    public function getLesFraisForfait($idVisiteur, $mois) {
        $req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur =:idVisiteur and lignefraisforfait.mois=:mois 
		order by lignefraisforfait.idfraisforfait";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne tous les id de la table FraisForfait

     * @return un tableau associatif 
     */
    public function getLesIdFrais() {
        $req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
        $res = PdoGsb::$monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Met à jour la table ligneFraisForfait

     * Met à jour la table ligneFraisForfait pour un visiteur et
     * un mois donné en enregistrant les nouveaux montants

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
     * @return un tableau associatif 
     */
    public function majFraisForfait($idVisiteur, $mois, $lesFrais) {
        $lesCles = array_keys($lesFrais);
        foreach ($lesCles as $unIdFrais) {
            $qte = $lesFrais[$unIdFrais];
            $req = "update lignefraisforfait set lignefraisforfait.quantite = :qte
			where lignefraisforfait.idvisiteur = :idVisiteur and lignefraisforfait.mois = :mois
			and lignefraisforfait.idfraisforfait = :unIdFrais";
            $res = PdoGsb::$monPdo->prepare($req);
            $res->bindParam(':idVisiteur', $idVisiteur);
            $res->bindParam(':mois', $mois);
            $res->bindParam(':qte', $qte);
            $res->bindParam(':unIdFrais', $unIdFrais);
            $res->execute();
        }
    }

    /**
     * met à jour le nombre de justificatifs de la table ficheFrais
     * pour le mois et le visiteur concerné

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     */
    public function majNbJustificatifs($idVisiteur, $mois, $nbJustificatifs) {
        $req = "update fichefrais set nbjustificatifs = :nbJustificatifs 
		where fichefrais.idvisiteur = :idVisiteur and fichefrais.mois = :mois";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':nbJustificatifs', $nbJustificatifs);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
    }

    /**
     * Teste si un visiteur possède une fiche de frais pour le mois passé en argument

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @return vrai ou faux 
     */
    public function estPremierFraisMois($idVisiteur, $mois) {
        $ok = false;
        $req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = :mois and fichefrais.idvisiteur = :idVisiteur";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $laLigne = $res->fetch();
        if ($laLigne['nblignesfrais'] == 0) {
            $ok = true;
        }
        return $ok;
    }

    /**
     * Retourne le dernier mois en cours d'un visiteur

     * @param $idVisiteur 
     * @return le mois sous la forme aaaamm
     */
    public function dernierMoisSaisi($idVisiteur) {
        $req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = :idVisiteur";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->execute();
        $laLigne = $res->fetch();
        $dernierMois = $laLigne['dernierMois'];
        return $dernierMois;
    }

    /**
     * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés

     * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
     * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles 
     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     */
    public function creeNouvellesLignesFrais($idVisiteur, $mois) {
        $dernierMois = $this->dernierMoisSaisi($idVisiteur);
        $laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
        if ($laDerniereFiche['idEtat'] == 'CR') {
            $this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL');
        }
        $req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat) 
		values(:idVisiteur,:mois,0,0,now(),'CR')";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $lesIdFrais = $this->getLesIdFrais();
        $res->closeCursor();
        foreach ($lesIdFrais as $uneLigneIdFrais) {
            $unIdFrais = $uneLigneIdFrais['idfrais'];
            $req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite) 
			values(:idVisiteur,:mois,:unIdFrais,0)";
            $res->prepare($req);
            $res->bindParam(':idVisiteur', $idVisiteur);
            $res->bindParam(':mois', $mois);
            $res->bindParam(':unIdFrais', $unIdFrais);
            $res->execute();
            $res->closeCursor();
        }
        
    }

    /**
     * Crée un nouveau frais hors forfait pour un visiteur un mois donné
     * à partir des informations fournies en paramètre

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @param $libelle : le libelle du frais
     * @param $date : la date du frais au format français jj//mm/aaaa
     * @param $montant : le montant
     */
    public function creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant) {
        $dateFr = dateFrancaisVersAnglais($date);
        $req = "insert into lignefraishorsforfait 
		values('',:idVisiteur,:mois,:libelle,:dateFr,:montant)";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->bindParam(':libelle', $libelle);
        $res->bindParam(':dateFr', $dateFr);
        $res->bindParam(':montant', $montant);
        $res->execute();
    }

    public function majFraisHorsForfait($idFrais, $libelle, $montant) {
        $req = "update LigneFraisHorsForfait set montant = :montant, libelle = :libelle 
		where LigneFraisHorsForfait.id = :idFrais";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':montant', $montant);
        $res->bindParam(':libelle', $libelle);
        $res->bindParam(':idFrais', $idFrais);
        $res->execute();
    }

    /**
     * Supprime le frais hors forfait dont l'id est passé en argument

     * @param $idFrais 
     */
    public function supprimerFraisHorsForfait($idFrais) {
        $req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =:idFrais ";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idFrais', $idFrais);
        $res->execute();
    }
    
    /**
     * Fonction permettant d'archiver un frais hors forfait refusé afin d'en garder une trace
     * 
     * @param type $idFrais
     */
    public function archiverFraisHorsForfait($idFrais) {
        $req = "update lignefraishorsforfait set libelle = CONCAT('REFUSE ',libelle) where lignefraishorsforfait.id = :idFrais ";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idFrais', $idFrais);
        $res->execute();
    }

    /**
     * Retourne les mois pour lesquel un visiteur a une fiche de frais

     * @param $idVisiteur 
     * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant 
     */
    public function getLesMoisDisponibles($idVisiteur) {
        $req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur =:idVisiteur 
		order by fichefrais.mois desc ";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->execute();
        $lesMois = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois["$mois"] = array(
                "mois" => "$mois",
                "numAnnee" => "$numAnnee",
                "numMois" => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné

     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état 
     */
    public function getLesInfosFicheFrais($idVisiteur, $mois) {
        $req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur =:idVisiteur and fichefrais.mois = :mois";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
        $laLigne = $res->fetch();
        return $laLigne;
    }

    /**
     * Modifie l'état et la date de modification d'une fiche de frais

     * Modifie le champ idEtat et met la date de modif à aujourd'hui
     * @param $idVisiteur 
     * @param $mois sous la forme aaaamm
     */
    public function majEtatFicheFrais($idVisiteurFicheFrais, $moisFicheFrais, $etatFicheFrais) {
        $req = "update fichefrais set fichefrais.idEtat = :etat, fichefrais.dateModif = now() where fichefrais.idVisiteur = :idVisiteur and fichefrais.mois = :mois";
        $res = PdoGsb::$monPdo->prepare($req);
//        $res->bindParam(':idVisiteur', $idVisiteurFicheFrais, PDO::PARAM_STR);
//        $res->bindParam(':mois', $moisFicheFrais, PDO::PARAM_STR);
//        $res->bindParam(':etat', $etatFicheFrais, PDO::PARAM_STR);
        $res->execute(array('idVisiteur' => $idVisiteurFicheFrais, 'mois' => $moisFicheFrais, 'etat' => $etatFicheFrais));
    }

    /**
     * Fonction récupérant tous les employés présents dans la base de donnée
     * donc la fonction est 'visiteur'
     * @return Array de Visiteurs
     */
    public function getLesVisiteurs() {
        $sql = "select id, prenom, nom from Employe where fonction = 'visiteur'";
        $resultat = PdoGsb::$monPdo->prepare($sql);
        $resultat->execute();
        if ($resultat->rowCount()) {
            $LesVisiteurs = $resultat->fetchAll(PDO::FETCH_OBJ);
            return $LesVisiteurs;
        } else {
            return -1;
        }
    }

    /**
     * Fonction initialisant des frais forfait à zéro pour un visiteur n'en ayant pas
     * pour le mois spécifié en paramètre de la fonction
     * @param type $idVisiteur
     * @param type $mois
     */
    public function genFraisForfait($idVisiteur, $mois) {
        $sql = "insert into lignefraisforfait values (:idVisiteur, :mois, 'ETP', 0), (:idVisiteur, :mois, 'KM', 0), (:idVisiteur, :mois, 'NUI', 0), (:idVisiteur, :mois, 'REP', 0)";
        $res = PdoGsb::$monPdo->prepare($sql);
        $res->bindParam(':idVisiteur', $idVisiteur);
        $res->bindParam(':mois', $mois);
        $res->execute();
    }

    /**
     * Fonction r�cup�rant tous les mois pr�sents dans la base de donn�e
     * 
     * @return type = Array
     */
    public function getTousLesMois() {
        $req = "select fichefrais.mois as mois from  fichefrais  
		order by fichefrais.mois desc ";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->execute();
        $lesMois = array();
        $laLigne = $res->fetch();
        while ($laLigne != null) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);
            $lesMois["$mois"] = array(
                "mois" => "$mois",
                "numAnnee" => "$numAnnee",
                "numMois" => "$numMois"
            );
            $laLigne = $res->fetch();
        }
        return $lesMois;
    }

    /**
     * Fonction qui retourne les fiches de frais en fonction de l'etat de celles-ci
     * @param type $etat
     * @return array contenant les fiches de frais 
     */
    public function getFicheFraisEtat($etat) {
        $req = "select nom, prenom, idvisiteur, mois, idetat from fichefrais inner join employe on fichefrais.idvisiteur = employe.id "
                . "where idetat= :etat and employe.fonction='visiteur'";
        $res = PdoGsb::$monPdo->prepare($req);
        $res->bindParam(':etat', $etat);
        $res->execute();
        $lesFicheFrais = $res->fetchAll(PDO::FETCH_ASSOC);
        return $lesFicheFrais;
    }

}
?>
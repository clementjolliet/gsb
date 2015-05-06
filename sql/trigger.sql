DELIMITER //

CREATE TRIGGER ficheFraisEtat_trigger
AFTER INSERT
   ON fichefrais FOR EACH ROW
   
BEGIN

   update fichefrais set idetat = 'CL' where idetat = 'CR' AND idvisiteur = new.idvisiteur AND mois != new.mois;
   
END; //

DELIMITER ;

CREATE TRIGGER ficheFraisEtat_trigger
BEFORE INSERT ON fichefrais
BEGIN
    update fichefrais set idetat = 'CL' where idetat = 'CR';
    
END//
<div class="container-fluid">
<!--    <div id="contenu">-->
        <div class="col-lg-12 col-xs-6">
            <h2 class="well">Identification utilisateur</h2>
        </div>
        <form method="POST" action="index.php?uc=connexion&action=valideConnexion">
            <div class="col-lg-offset-3 col-lg-9">
                <div class="col-lg-8 col-md-8 col-xs-8">
                
                    <div class="form-group">
                        <label for="nom">Login*</label>
                        <input id="login" class="form-control" type="text" name="login"  size="30" maxlength="45" value="lvillachane" required autofocus>
                    </div>
                
            </div>
            <div class="col-lg-8 col-md-8 col-xs-8">
                
                    <div class="form-group">
                        <label for="mdp">Mot de passe*</label>
                        <input id="mdp" class="form-control" type="password"  name="mdp" size="30" maxlength="45" value="jux7g" required>
                    </div>
                
            </div>
            <div class="col-lg-offset-1 col-lg-6 col-md-6 col-xs-6">     
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Valider" style="width:100%" name="valider"> 
                    </div>            
                
            </div>
            </div>
            
        </form>

<!--    </div>-->
</div>
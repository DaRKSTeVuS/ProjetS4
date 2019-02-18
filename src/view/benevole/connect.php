<div class="connect">
	<form method="get"  action='index.php'> <!-- formulaire de type get charge creerVoiture-->
		<fieldset>
            <legend>Connexion :</legend>
            
            <input type='hidden' name='action' value='connected'>
            <input type='hidden' name='controller' value='benevole'>
            
            <p>
                <label for="nom_id">Identifiant : </label>
                <input type="text" placeholder="Ex : Blaireau" name="login" id="login_id" required/>
            
                <label for="prenom_id">Mot de passe : </label>
                <input type="password" placeholder="*******" name="password" id="password_id" required/>
            </p>
            <p>
                <input type="submit" value="Valider" />
            </p>
        </fieldset>             
    </form>
   <div class="item">
        
            <a href="index.php?controller=benevole&action=create">Pas encore inscrit ?</a>
        
    </div>

</div>
 
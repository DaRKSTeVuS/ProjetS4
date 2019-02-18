
<div class="formulaire">
	<form method="get"  action='index.php'> <!-- formulaire de type get charge creerVoiture-->
		<fieldset>
			<?php 
				if($send == 'updated'){
					echo '<legend>Modifier votre compte :</legend>';
				}else{
					echo '<legend>Créer votre compte :</legend>';
				}
			?>
			<input type='hidden' name='action' value=<?php if($send == 'updated'){echo 'updated';}else{echo 'created';} ?>>
			<input type='hidden' name='controller' value='benevole'>
		
			<div class="input">
				<label for="nom_nom">Login : </label>
				<input type="text" placeholder="Ex : Blaireau" name="login" id="nom_nom" <?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('login')); else echo 'required' ?>>

				<label for="nom_nom">Nom : </label>
				<input type="text" placeholder="Ex : Blaireau" name="nom" id="nom_nom" <?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('nom')); else echo 'required' ?>>

				<label for="nom-prenom">Prénom : </label>
				<input type="text" placeholder="Ex : Bertrand" name="prenom" id="nom_prenom" <?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('prenom')); else echo 'required' ?>>

				<label for="nom_naiss">Date de naissance : </label>
				<input type="date" name="dateNaiss" id="nom_naiss" <?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('dateNaiss')); else echo 'required' ?>>

				<label for="nom_tel">Numéro de téléphone : </label>
				<input type="text" placeholder="Ex : 060000000*" name="numTelephone" id="tel_id" <?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('numTelephone')); else echo 'required' ?>>

				<label for="email_id">Adresse email : </label>
				<input type="email" placeholder="Ex : michel.blaireau@gmail.com" name="email" id="email_id"<?php if ($send == 'updated') echo 'value=' . htmlspecialchars($v->__get('email')); else echo 'required' ?>>

				<label for="pwd_id">Mot de passe : </label>
				<input type="password" placeholder="Ex : monMotDePasse" name="password1" id="pwd_id" required/>

				<label for="pwd_id">Confirmer le mot de passe : </label>
				<input type="password" placeholder="Ex : monMotDePasse" name="password2" id="pwd_id" required/>
			
				<?php if($send == 'updated'){ 
					echo'<input type="hidden" name="IDBenevole" value='.htmlspecialchars($v->__get('IDBenevole')).'>';
				}?>
			</div>

			<div>
				<input class="update" type="submit" value="Envoyer" />
			</div>
      
		</fieldset> 
	</form>
</div>
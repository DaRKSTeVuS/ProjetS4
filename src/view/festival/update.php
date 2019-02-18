
<div>
	<form method="get"  action='index.php'> <!-- formulaire de type get charge creerVoiture-->
		<fieldset>
			<!--<?php 
				//if($send == 'updated'){
				//	echo '<legend>Modifier le festival :</legend>';
				//}else{
				//	echo '<legend>Créer un festival :</legend>';
				//}
			?> -->

			<input type='hidden' name='action' value=<?php if($send == 'updated'){echo 'updated';}else{echo 'created';} ?> >
      
			<?php 
				if($send == 'updated'){ 
					echo'<input type="hidden" name="IDFestival" value='.htmlspecialchars($festival->__get('IDFestival')).'>';
				}
			?>

			<p>
				<label for="nom_festival">Nom :</label>
				<input type="text" placeholder="Ex : Mon festival" name="nomFestival" id="id_festival" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($festival->__get('nomFestival'));} ?> required/> 

				<label for="nom_lieu">Lieu :</label> 
				<input type="text" placeholder="Ex : Ma ville" name="lieuFestival" id="id_lieu" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($festival->__get('lieuFestival'));} ?> required/>
          
				<label for="nom_dateD">Date début :</label> 
				<input type="date" name="dateDebutF" id="id_dateD" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($festival->__get('dateDebutF'));} ?> required/>

				<label for="nom_dateF">Date fin :</label> 
				<input type="date" name="dateFinF" id="id_dateF" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($festival->__get('dateFinF'));} ?> required/>

				<label for="nom_description">Description :</label> 
				<textarea placeholder="La description de mon festival" name="description" id="id_description" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($festival->__get('description'));} ?> /></textarea>
	        </p>
	        <p>
	         	<input type="submit" value="Envoyer" />
	        </p>
      </fieldset> 
    </form>
</div> 
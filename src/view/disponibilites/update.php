<div>
	<form method="get"  action='index.php'> <!-- formulaire de type get-->
		<fieldset>
			<?php 
				if($send == 'updated'){
					echo '<legend>Modifier votre disponibilité :</legend>';
					echo '<input type="hidden" name="IDDisponibilites" value=' . htmlspecialchars($dispo->__get('IDDisponibilites')) . '>';
				}else{
					echo '<legend>Créer une disponibilité :</legend>';
				}
			?>
			<input type="hidden" name="controller" value="disponibilites">
			<input type='hidden' name='action' value=<?php if($send == 'updated'){echo 'updated';}else{echo 'created';} ?> >
			<input type="hidden" name="idBenevole" <?php echo 'value=' . rawurlencode($_GET['IDBenevole']) ?> >

			<div>
				<label for="nom_debutDispo">Date de votre disponibilité :</label>
				<input type="date" name="debutDispo" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($dispo->__get('debutDispo'));} ?> >
				
				<label for="nom_heureDebutDispo">Heure de début du créneau :</label>
				<input type="time" name="heureDebutDispo" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($dispo->__get('heureDebutDispo'));} ?> >

				<label for="nom_heureFinDispo">Heure de fin du créneau :</label>
				<input type="time" name="heureFinDispo" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($dispo->__get('heureFinDispo'));} ?> >

			</div>

			<div>
				<input type="submit" value="Envoyer" />
			</div>
		</fieldset> 
	</form>
</div>
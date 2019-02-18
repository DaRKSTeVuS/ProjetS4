<div>
	<form method="get"  action='index.php'> <!-- formulaire de type get-->
		<fieldset>
			<?php 
				if($send == 'updated'){
					echo '<legend>Modifier le créneau :</legend>';
					echo '<input type="hidden" name="IDCreneau" value=' . htmlspecialchars($creneau->__get('IDCreneau')) . '>';
				}else{
					echo '<legend>Créer un créneau :</legend>';
			}?>
			<input type="hidden" name="controller" value="creneaux">
			<input type='hidden' name='action' value=<?php if($send == 'updated'){echo 'updated';}else{echo 'created';} ?> >
			<input type="hidden" name="IDFestival" <?php echo 'value=' . rawurlencode($_GET['IDFestival']); ?> >
			<input type="hidden" name="IDPoste" <?php echo 'value=' . rawurlencode($_GET['IDPoste']); ?> > 

			<div>
				<label for="nom_debutCreneau"> Date du créneau : </label>
				<input type="date" name="debutCreneau" <?php if($send == 'updated'){echo 'value='.htmlspecialchars($creneau->__get('debutCreneau'));} ?> >

				<label for="nom_heureDebutCreneau"> Heure de début du créneau : </label>
				<input type="time" name="heureDebutCreneau" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($creneau->__get('heureDebutCreneau'));} ?> >

				<label for="nom_heureFinCreneau"> Heure de fin du créneau : </label>
				<input type="time" name="heureFinCreneau" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($creneau->__get('heureFinCreneau'));}?> >

				<label for="nom_nbBenevoles"> Nombre de bénévoles nécessaires : </label>
				<input type="text" name="nbBenevoles" id="nbBenevoles" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($creneau->__get('nbBenevoles'));}?> >
			</div>
			<div>
				<input type="submit" value="Envoyer" />
			</div>
		</fieldset> 
	</form>
</div>
<div class="formulaire">
	<form method="get"  action='index.php'> <!-- formulaire de type get-->
		<fieldset>
		
			<?php 
				if($send == 'updated'){
					echo '<legend>Modifier le poste :</legend>';
			}
			?>
			<input type='hidden' name='action' value=<?php if($send == 'updated'){echo 'updated';}else{echo 'created';} ?> >
			
			<?php 
				if($send == 'updated'){ 
					echo'<input type="hidden" name="IDPoste" value='.htmlspecialchars($poste->__get('IDPoste')).'>';
				}
			?>
			
			<input type="hidden" name="controller" value="poste">
			<?php echo'<input type="hidden" name="IDFestival" value=' . rawurldecode($_GET['IDFestival']) . '>' ?>
			
					
			<div class="input">
				<div> 
					<label for="nom_id">Nom du poste</label> :
					<input type="text" placeholder="Ex : Barman" name="nomPoste" id="nom_id" <?php if($send == 'updated'){echo 'value=' . htmlspecialchars($poste->__get('nomPoste'));} ?> required/>
				</div>
			</div>
				
			<div>
				<input type="submit" value="Envoyer" />
			</div>
			
		</fieldset> 
	</form>
</div>
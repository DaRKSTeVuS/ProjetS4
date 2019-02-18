<div class="boite">
	<p>
		<?php
			if(isset($send)){
				echo 'Le bénévole à bien été supprimé du créneau.';
			}else{
				echo 'Le bénévole à bien été ajouté au créneau.';
			}
		?>
	</p>
	<p>	
		<?php
			echo '<a href="./index.php?controller=creneaux&action=readAll&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDPoste=' . htmlspecialchars($poste->__get('IDPoste')) . '">Retour à l\'ensemble des créneaux </a>';
		?>
	</p>
</div>
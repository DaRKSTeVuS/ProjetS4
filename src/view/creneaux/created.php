<div class="boite">
	<p>
		Votre créneau a bien été créé!
	</p>
	<p>
		<?php
			echo '<a href="index.php?controller=poste&action=readPostesFestival&IDFestival='. rawurlencode($_GET['IDFestival']) .'">Retour à la liste des postes du festival</a>'
		?>
	</p>
</div>
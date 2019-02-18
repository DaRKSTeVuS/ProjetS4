<div class="boite">
	<p>
		Votre créneau a bien été supprimmé!
	</p>
	<p>
		<?php
			echo '<a href="./index.php?controller=creneaux&action=readAll&IDFestival='.rawurlencode($_GET['IDFestival']).'&IDPoste=' . htmlspecialchars($poste->__get('IDPoste')) . '">Retour au creneaux du poste ' . htmlspecialchars($poste->__get('nomPoste')) . '</a></p>';
		?>
	</p>
</div>
<div class="boite">
	<p>
		Le poste sélectionné a bien été supprimmé!
	</p>
	<p>
		<?php echo'<a href="index.php?controlleur=festival&action=read&IDFestival='.rawurldecode($_GET['IDFestival']).'"> Retour au Festival'.htmlspecialchars($recupNom->__get('nomFestival')).'</a>' ?>
	</p>
</div>
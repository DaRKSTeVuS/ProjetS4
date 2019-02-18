<div class="boite">
	<p>
		Votre poste a bien été créé!
	</p>
	<p>
		<?php echo'<a href="index.php?controlleur=festival&action=read&IDFestival='.rawurldecode($_GET['IDFestival']).'"> Retour au festival ' . htmlspecialchars($recupNom->__get('nomFestival')) . '</a>' ?>
	</p>
</div>
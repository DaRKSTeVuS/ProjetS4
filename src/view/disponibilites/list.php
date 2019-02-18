
	<?php
		if(empty($tab_dispo)){
			echo 'Vous n\'avez aucune disponibilités';
		}else{
			echo '<div class="item"><p>Mes disponibilités : </p></div>';
			foreach ($tab_dispo as $dispo){
				echo'<div class="boite"><p>';
					echo 'Disponibilités numéro : ' . htmlspecialchars($dispo->__get('IDDisponibilites'));
					echo 'La date de la disponibilités est le: ' . htmlspecialchars($dispo->__get('debutDispo'));
					echo "L' heure de la disponibilités est de: " . htmlspecialchars($dispo->__get('heureDebutDispo')) . "h à " . htmlspecialchars($dispo->__get('heureFinDispo')) . "h ";
				echo'</p>';

				echo'<p>';
	    			echo '<div class="item"><a href="./index.php?controller=disponibilites&action=update&IDDisponibilites=' . htmlspecialchars($dispo->__get('IDDisponibilites')) . '&IDBenevole=' . rawurlencode($_GET['IDBenevole']) . '">Modifier la disponibilité</a></div>';
	    			echo '<div class="item"><a href="./index.php?controller=disponibilites&action=deleted&IDDisponibilites=' . htmlspecialchars($dispo->__get('IDDisponibilites')) . '&IDBenevole=' . rawurlencode($_GET['IDBenevole']) . '">Supprimer la disponibilité</a></div>';
	    		echo'</p></div>';
			}
		}
	?>
</div>

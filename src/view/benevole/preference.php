<?php
	if($send = 'liste' && isset($tab_pref)){
		if(empty($tab_pref)){
		echo '<p>Vous n\'avez pas de préférences</p>';
		}else{
			
    		foreach ($tab_pref as $pref) {
        		echo"<div class='boite'>";

        			echo'<p>Poste de : '.$pref->__get('nomPoste').'</p>';
        			echo '<div class="item"><a href="./index.php?controller=benevole&action=supprimerPref&IDPoste=' . htmlspecialchars($pref->__get('IDPoste')) .'">Supprimer ce poste des postes préférés </a></p></div>';
				echo'</div>';
			}

		}
	}else if($send = 'ajout'){
		echo'<div class="boite">';
			echo 'Le poste à bien été ajouté aux préférences.';
		echo'</div>';
	}
?>
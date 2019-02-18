<div class="boite">
	<?php
		if(empty($tab_b)){
			echo '<p>La liste est vide</p>';
		}else{
			foreach ($tab_b as $b){
				if(isset($poste)){
					if(ModelBenevole::isPref($b->__get('IDBenevole'), $poste->__get('IDPoste')) == 1){
						echo '<div class="item2">';
					}
				}else{
					echo '<div class="item">';	
				}	
				echo '<p>Bénévole<a href="./index.php?controller=benevole&action=read&IDBenevole=' . htmlspecialchars($b->__get('IDBenevole')) . '">' . htmlspecialchars($b->__get('login')) . '</a>';
				if(isset($dispo)){ 
					if($dispo == 'yes'){
						
						echo'<a href="index.php?controller=benevole&action=affecter&IDBenevole='. htmlspecialchars($b->__get('IDBenevole')) . '&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDCreneau=' . htmlspecialchars($creneau->__get('IDCreneau')).'&IDPoste='.htmlspecialchars($poste->__get('IDPoste')).'">Ajouter au creneau</a>';
						
					}else{
						echo'<a href="index.php?controller=benevole&action=supprimerDuCreneau&IDBenevole='. htmlspecialchars($b->__get('IDBenevole')) .'&IDFestival='. rawurlencode($_GET['IDFestival']) .'&IDCreneau='.htmlspecialchars($creneau->__get('IDCreneau')).'&IDPoste='.htmlspecialchars($poste->__get('IDPoste')).'">supprimer du creneau</a>';	
					}
				}else{
					if(ModelBenevole::isOrga($b->__get('login'), $_GET['IDFestival'])){
						echo ' (est organisateur)';
						if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){ echo'<a href="index.php?controller=benevole&action=demote&IDBenevole='. htmlspecialchars($b->__get('IDBenevole')) .'&IDFestival='. rawurlencode($_GET['IDFestival']) .'">Révoquer les droits</a>';}
					}else{
						if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){ echo'<a href="index.php?controller=benevole&action=promote&IDBenevole='. htmlspecialchars($b->__get('IDBenevole')) .'&IDFestival='. rawurlencode($_GET['IDFestival']) .'">Promouvoir organisateur</a>';}
					}
					if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){ echo'<a href="index.php?controller=benevole&action=kick&IDBenevole='. htmlspecialchars($b->__get('IDBenevole')) .'&IDFestival='. rawurlencode($_GET['IDFestival']) .'">Supprimer du festival</a>';}
               
					echo '</p>';
				}
				echo '</div>';
			}
		}
		echo '<p><a href="./index.php?action=read&IDFestival=' . rawurlencode($_GET['IDFestival']). '">Retour au portail du festival</a></p>'; 
	?>
        
</div>

<div class="boite">
	<?php
		if(empty($tab_p)){
			echo '<p>la liste est vide</p>';
		}else{
			foreach ($tab_p as $p){
				echo '<div class="item"><p> Poste : <a href="./index.php?controller=poste&action=read&IDFestival='.rawurlencode($_GET['IDFestival']).'&IDPoste=' . htmlspecialchars($p->__get('IDPoste')) . '">'. htmlspecialchars($p->__get('nomPoste')) . '</a></p></div>';
			}
		}
		if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
		echo '<p><div class="item"><a href="./index.php?controller=poste&action=create&IDFestival=' . rawurlencode($_GET['IDFestival']) . '">Creer un Poste </a></p></div>';
		}
		echo '<p><div class="item"><a href="./index.php?action=read&IDFestival=' . $_GET['IDFestival']. '">Retour au portail du festival </a></p></div>'; 
	?>

</div>


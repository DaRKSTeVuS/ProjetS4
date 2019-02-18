<div class="boite">
    <?php
	    if(empty($tab_b)){
	    	echo '<p>la liste est vide</p>';
	    }else{
	        foreach ($tab_b as $b){
				echo '<p>Bénévole ' . $b->__get('login') .'</p>';
				echo '<p>Nom: ' . $b->__get('nom') .' </p>';
				echo '<p>Prénom: ' . $b->__get('prenom') .' </p>';
				
				echo '<p><a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=read&IDBenevole=' . rawurlencode($b->__get('IDBenevole')) . '">Voir en détail</a></p>';
				echo '<a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=accept&IDFestival='.$_GET['IDFestival'] .'&IDBenevole=' . $b->__get('IDBenevole') . '">Accepter</a>';
				echo '<a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=kick&IDFestival='.$_GET['IDFestival'] .'&IDBenevole=' . $b->__get('IDBenevole') . '">Refuser</a>';
	        	
	        }
	    }
	     echo '<p><a href="./index.php?action=read&IDFestival=' . $_GET['IDFestival']. '"> Retour au portail du festival </a></p>'; 
    ?>
    
</div>
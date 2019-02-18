
<div>
    <?php
        if(isset($_SESSION['login'])){
        	$id = ModelBenevole::getIDbyLogin($_SESSION['login']);
		    foreach ($tab_f as $f){
		    	echo '<div class="festival">';
	        	if(ModelBenevole::isParticipant($id, $f->__get('IDFestival'))){
	        		if(ModelBenevole::isValide($_SESSION['login'], $f->__get('IDFestival'))){
	        			if(ModelBenevole::isOrga($_SESSION['login'], $f->__get('IDFestival'))){
	        				echo '<p><a href="./index.php?action=read&IDFestival=' . rawurlencode($f->__get('IDFestival')) . '">' . htmlspecialchars($f->__get('nomFestival')). '</a></p><p>(vous êtes organisateur)</p>';         	
	        			}else{
	        				echo '<p><a href="./index.php?action=read&IDFestival=' . rawurlencode($f->__get('IDFestival')) . '">' . htmlspecialchars($f->__get('nomFestival')). '</a></p><p>(vous êtes bénévole)</p>'; 
	        			}

	        		
	        		}else  {
	        		echo '<p><a href="./index.php?action=read&IDFestival=' . rawurlencode($f->__get('IDFestival')) . '">' . htmlspecialchars($f->__get('nomFestival')). '</a></p><p>(votre demande est envoyée)</p>';          	
	        		}
	        	}else{
	        		echo '<div><p></p>
	        		<p><a href="./index.php?action=read&IDFestival=' . rawurlencode($f->__get('IDFestival')) . '">' . htmlspecialchars($f->__get('nomFestival')). '</a></p></div>';         
	        	}
	        	echo '<p>' . $f->__get('description') . '';
				echo '</div>';	
	        }
	        echo'<a href="index.php?controller=festival&action=create"><div class="festival">Créer un festival</a>';
	    }else{
	    	foreach ($tab_f as $f){
	    		echo '<div class="festival"><p><a href="./index.php?action=read&IDFestival=' . rawurlencode($f->__get('IDFestival')) . '">' . htmlspecialchars($f->__get('nomFestival')). '</a></p>';         
	    		echo '<p>' . $f->__get('description') . '</div>';
	    	}
	    }

	    
	    echo '</div>';
    ?>  
    <br>
</div>

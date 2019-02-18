
    <?php
    	echo '<div><p>Créneau du poste: ' . htmlspecialchars($poste->__get('nomPoste')).'</p></div>';
        if(empty($tab_creneau)){
            echo '<p>La liste est vide</p>';
        }else{
            foreach ($tab_creneau as $creneau){
            echo'<div class="boite"><p>';
    	    	
    			echo '<p>La date du créneau est le: ' . htmlspecialchars($creneau->__get('debutCreneau')).'</p>';
    			echo '<p>L\' heure du creneau est de: ' . htmlspecialchars($creneau->__get('heureDebutCreneau')).'h à '. htmlspecialchars($creneau->__get('heureFinCreneau')) . 'h </p>';
    			
    			echo '<p>Le nombre de bénévoles nécessaire à ce créneau est de : ' . htmlspecialchars($creneau->__get('nbBenevoles')).'</p>';
    		echo'</p>';

    		echo'<p>';
    			echo '<div class="item"><a href="./index.php?controller=creneaux&action=update&IDFestival=' .rawurlencode($_GET['IDFestival']).'&IDPoste=' . rawurlencode($_GET['IDPoste']) . '&IDCreneau=' . htmlspecialchars($creneau->__get('IDCreneau')) . '">Modifier le créneau</a></div>';
    			echo '<div class="item"><a href="./index.php?controller=creneaux&action=deleted&IDFestival='.rawurlencode($_GET['IDFestival']).'&IDPoste=' . rawurlencode($_GET['IDPoste']) . '&IDCreneau=' . htmlspecialchars($creneau->__get('IDCreneau')) . '">Supprimer le créneau</a></div>';
				echo '<div class="item"><a href="./index.php?controller=benevole&action=benevoleDispo&IDFestival='.rawurlencode($_GET['IDFestival']).'&IDPoste=' . rawurlencode($_GET['IDPoste']) . '&IDCreneau=' . htmlspecialchars($creneau->__get('IDCreneau')) . '">Ajouter un bénévole au créneau</a></div>';
				echo '<div class="item"><a href="./index.php?controller=benevole&action=benevoleAffecter&IDFestival='.rawurlencode($_GET['IDFestival']).'&IDPoste=' . rawurlencode($_GET['IDPoste']) . '&IDCreneau=' . htmlspecialchars($creneau->__get('IDCreneau')) . '">Supprimer un bénévole au créneau</a></div>';
            echo'</p></div>';
    	   }
        }
    ?>


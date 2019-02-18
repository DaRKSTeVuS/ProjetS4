<div class="boite">
    <?php
    	echo '<p>Erreur : ' . htmlspecialchars($pagetitle) . '</p>';

    	if(htmlspecialchars($pagetitle) == 'Erreur du détail du créneau'){
        	echo  'Les détails du créneau que vous cherchez n\'existe pas'  ;
            $controller = 'creneaux';
            $view = 'detail';
            $pagetitle = 'Informations du créneau';
            require_once (File::build_path(array('view','view.php')));
        }else{
        	echo '<p>Action incorrecte</p>';
        }
    ?>
</div>

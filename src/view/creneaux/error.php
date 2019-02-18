<div class="boite">
    <?php
    	echo '<p>Erreur : ' . htmlspecialchars($pagetitle) . '</p>';

    	if(htmlspecialchars($pagetitle) == 'Erreur du détail du créneau'){
        	echo  'Les détails du créneau que vous cherchez n\'existe pas'  ;
            $controller = 'creneaux';
            $view = 'detail';
            $pagetitle = 'Informations du créneau';
            require_once (File::build_path(array('view','view.php')));
    	}

		if(htmlspecialchars($pagetitle) == 'Valeur incohérente ou déjà rentrée'){
        	echo  'Les valeurs du créneau que vous avez entrées sont soit incohérentes, soit déjà rentrées.'  ;
            $controller = 'creneaux';
            $view = 'create';
            $pagetitle = 'Créer un creneau';
            require_once (File::build_path(array('view','view.php')));
    	}

    ?>
</div>

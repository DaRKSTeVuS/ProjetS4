<div class="boite">
    <?php
        echo '<p>Erreur : ' . htmlspecialchars($pagetitle) . '</p>';

    	if(htmlspecialchars($pagetitle) == 'Erreur sur les détails du poste'){
        	echo 'Les détails du poste que vous cherchez n\'existe pas'  ;
            $controller = 'poste';
            $view = 'detail';
            $pagetitle = 'Détail d\'un poste';
            require_once (File::build_path(array('view','view.php')));
    	}
    ?>
</div>
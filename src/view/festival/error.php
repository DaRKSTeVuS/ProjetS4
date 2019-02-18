<div class="boite">
    <?php
        echo '<p>Erreur : ' . htmlspecialchars($pagetitle) . '</p>';

    	if(htmlspecialchars($pagetitle) == 'Erreur du détail du festival'){
        	echo  'Les détails du festival que vous cherchez n\'existe pas'  ;
            $controller = 'festival';
            $view = 'detail';
            $pagetitle = 'Détail d\'un festival';
            require_once (File::build_path(array('view','view.php')));
    	}

    	if(htmlspecialchars($pagetitle) == 'Problème d\'accès à un festival'){
    		echo '<p>Problème d\' accès avec ce festival</p>';
    		echo '<p>Veuillez vous connecter si vous ne l\'êtes pas</p>';
            $pagetitle = 'Portail de fonctionnalités';
            $controller = 'festival';
            $view = 'home';
            require_once (File::build_path(array('view','view.php')));
    	}
        if(htmlspecialchars($pagetitle) == 'Veuillez vous connecter'){
           echo '<p>Problème d\' accès avec ce festival</p>';
            echo '<p>Veuillez vous connecter si vous ne l\'êtes pas</p>';
            $pagetitle = 'Portail de fonctionnalités';
            $controller = 'festival';
            $view = 'home';
            require_once (File::build_path(array('view','view.php'))); 
        }
    ?>
</div>
<div class="boite">
    <?php
        echo '<p>Erreur : ' . htmlspecialchars($pagetitle) . '</p>';

    	if(htmlspecialchars($pagetitle) == 'Erreur du détail bénévole'){
        	echo 'Les détails du bénévole que vous cherchez n\'existe pas'  ;
            $controller = 'benevole';
            $view = 'detail';
            $pagetitle = 'Informations du bénévole';
            require_once (File::build_path(array('view','view.php')));
    	}

    	if(htmlspecialchars($pagetitle) == 'Mots de passe incorrects'){
    		echo '<p> Les mots de passe ne correspondent pas, veuillez taper 2 fois le même mot de passe</p>';
            $pagetitle = 'Compte créé';
            $controller = 'benevole';
            $view = 'created';
            require_once (File::build_path(array('view','view.php')));
    	}

		if (htmlspecialchars($pagetitle) == 'Adresse email invalide'){
			echo '<p>L\'adresse email que vous avez entrée n\'est pas valide</p>';  
            $pagetitle = 'Compte créé';
            $controller = 'benevole';
            $view = 'created';
            require_once (File::build_path(array('view','view.php')));
		}

		if (htmlspecialchars($pagetitle) == 'Compte non validé'){
			echo '<p>Compte non validé</p>'; 
			echo '<p>Veuillez valider votre compte via le lien qui vous a été envoyé par email</p>'; 
            $pagetitle = 'Vous êtes connecté';
            $controller = 'benevole';
            $view = 'connected';
            require_once (File::build_path(array('view','view.php')));
		}

		if (htmlspecialchars($pagetitle) == 'Mauvais identifiants et/ou mot de passe'){
			echo '<p>Mauvais identifiants et/ou mot de passe</p>'; 
            $pagetitle = 'Vous êtes connecté';
            $controller = 'benevole';
            $view = 'detail';
            require_once (File::build_path(array('view','view.php')));
		}

        if (htmlspecialchars($pagetitle) == 'Votre compte n\'est pas validé'){
            echo '<p>Veuillez cliquer sur le lien qui vous a été envoyé par courrriel.</p>'; 
            $pagetitle = 'Votre compte a été validé';
            $controller = 'benevole';
            $view = 'validated';
            require_once (File::build_path(array('view','view.php')));
        } 
    ?>
</div>

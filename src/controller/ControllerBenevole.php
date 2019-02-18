<?php

//essai
/*
contient le code source des actions. 
C’est donc ici qu’est présente la logique du site Web : 
on y appelle le modèle pour récupérer/enregistrer des données,
 on traite ces données, 
 on appelle les vues pour écrire la page Web…
 
*/


require_once (File::build_path(array('model','ModelBenevole.php')));

class ControllerBenevole {
    protected static $object = "benevole";

    public static function readAll() {
        //Affiche tous les bénévoles d'un festival
        $tab_b = ModelBenevole::getAll($_GET['personne'],$_GET['IDFestival']);     //appel au modèle pour gerer la BD
        $controller = 'benevole';
        $view = 'list';
        $pagetitle = 'Liste des bénévoles';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }

    public static function readOrga(){
        //affiche tous les organisteurs *
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
            $tab_b = ModelBenevole::readAllOrga($_GET['IDFestival']);     //appel au modèle pour gerer la BD
            $controller = 'benevole';
            $view = 'list';
            $pagetitle = 'Liste des organisateurs';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function readDemandesOrga(){
        //affiche tous les organisteurs ** isorga
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $tab_b = ModelBenevole::readAllDemandesOrga($_GET['IDFestival']);     //appel au modèle pour gerer la BD
            $controller = 'benevole';
            $view = 'demandesorga';
            $pagetitle = 'Liste des demandes organisateur';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function reject(){
        //affiche tous les organisteurs **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            ModelBenevole::reject($_GET['IDBenevole'], $_GET['IDFestival']);     //appel au modèle pour gerer la BD
            $controller = 'benevole';
            $view = 'demandesorga';
            $pagetitle = 'Liste des demandes Organisateur';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
         }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function readBene(){
        //affiche tous les bénévoles de tous les festivals *
            $tab_b = ModelBenevole::readAllBene($_GET['IDFestival']);     //appel au modèle pour gerer la BD
            $controller = 'benevole';
            $view = 'list';
            $pagetitle = 'Liste des bénévoles';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue


    }

    public static function readDemandes(){
        //affiche toutes les demandes de chaque bénévole **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $tab_b = ModelBenevole::readAllDemandes($_GET['IDFestival']);     //appel au modèle pour gerer la BD
            $controller = 'benevole';
            $view = 'demandes';
            $pagetitle = 'Liste des demandes bénévoles';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function accept(){
        //**
        $f = ModelFestival::select($_GET['IDFestival']); 
        $b = ModelBenevole::select($_GET['IDBenevole']); 
        $mail = 'Bonjour '. htmlspecialchars($b->__get('prenom')) .'. Votre compte pour le festival '. htmlspecialchars($f->__get('nomFestival')) .' a été accépté en tant que bénévole.';
               mail($b->__get('email'), 'Acceptation en tant que bénévole', $mail);
        //permet d'accepter un bénévole sur un festival 
        ModelBenevole::accept($_GET['IDBenevole'], $_GET['IDFestival']);
        $controller = 'benevole';
        $view = 'demandes';
        $pagetitle = 'Liste des demandes';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue  
    }

    public static function promote(){
        //**
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $f = ModelFestival::select($_GET['IDFestival']); 
            $b = ModelBenevole::select($_GET['IDBenevole']); 
            $mail = 'Bonjour '. htmlspecialchars($b->__get('prenom')) .'. Vous avez été promu organisateur pour le festival '. htmlspecialchars($f->__get('nomFestival')) .'.';
                   mail($b->__get('email'), 'Vous êtes désormais organisateur', $mail);
            //permet d'accepter un bénévole sur un festival 
            ModelBenevole::promote($_GET['IDBenevole'], $_GET['IDFestival']);
            $controller = 'benevole';
            $view = 'promote';
            $pagetitle = 'Le bénévole est organisateur';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }

    }

    public static function demote(){
        //permet d'accepter un bénévole sur un festival **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            ModelBenevole::demote($_GET['IDBenevole'], $_GET['IDFestival']);
            $controller = 'benevole';
            $view = 'promote';
            $pagetitle = 'Le bénévole n\'est plus organisateur';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }


    public static function read(){
        //Affiche les détails d'un bénévole *
        	$b = ModelBenevole::select($_GET['IDBenevole']); 
        	if ($b == false){
                $pagetitle = 'Erreur du détail bénévole';
                $controller = 'benevole';
                $view = 'error';
        		require_once (File::build_path(array('view','view.php')));
        	}else{ 
                $pagetitle = 'Informations du bénévole';
                $controller = 'benevole';
                $view = 'detail';
                require_once (File::build_path(array('view','view.php')));
        	}
    }

    public static function create(){
        //Crée un bénévole 

        $pagetitle = 'Création d\'un compte';
        $controller = 'benevole';
        $view = 'update';
        $champid = 'required';
        $send = 'created';
        require_once (File::build_path(array('view','view.php')));  
    }

    public static function created(){
        //Crée un bénévole 
		if($_GET['password1'] != $_GET['password2']){
			$pagetitle = 'Mots de passe incorrects';
			$controller = 'benevole';
			$view = 'error';
			require_once (File::build_path(array('view','view.php')));

		}else{
			if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
				$v = new ModelBenevole(null, ":login");
				require_once (File::build_path(array('lib','Security.php')));

				$mdp_chiffrer = Security::chiffrer($_GET['password1']);
				$nonce = Security::generateRandomHex();
				$values = array(
				//On stocke les valeurs transmises par un futur client dans un tableau
					"IDBenevole" => null,
					"login" => $_GET['login'],
					"password" => $mdp_chiffrer,
					"nom" => $_GET['nom'],
					"prenom" => $_GET['prenom'],
					"dateNaiss" => $_GET['dateNaiss'],
					"email" => $_GET['email'],
					"numTelephone" => $_GET['numTelephone'],
					"nonce" => $nonce,
				);
				$v->save($values);
				//On sauvegarde le nouveau client dans la base de données
				$b = ModelBenevole::getLastSaved();
				$mail = 'Bonjour ! Veuillez valider votre compte Festivalio en cliquant sur le lien suivant :
                    
				http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=validate&IDBenevole=' . htmlspecialchars($b->__get('IDBenevole')) . '&nonce='. htmlspecialchars($nonce) .'';
				mail($_GET['email'], 'validation de votre compte', $mail);
				$controller = 'benevole';
				$view = 'created';
				$pagetitle = 'Compte créé, un mail vous a été envoyé !';
				require_once (File::build_path(array('view','view.php')));
			}else{
				$pagetitle = 'Adresse email invalide';
				$controller = 'benevole';
				$view = 'error';
				require_once (File::build_path(array('view','view.php')));
			}
		} 
	}

    public static function deleted(){
        //Supprime un bénévole verifier
        if(getIDbyLogin($_SESSION['login']) == $_GET['IDBenevole']){
        ModelBenevole::delete($_GET['IDBenevole']);
        $pagetitle = 'Bénévole supprimé';
        $controller = 'benevole';
        $view = 'deleted';
        require_once (File::build_path(array('view','view.php'))); 
        }else{
            //error vous navez pas les droits
        } 
    }

    public static function update(){
        //Met à jour les informations d'un bénévole 
         if(getIDbyLogin($_SESSION['login']) == $_GET['IDBenevole']){
        $v = ModelBenevole::select($_GET['id']);
        $pagetitle = 'Modifier le benevole';
        $controller = 'benevole';
        $view = 'update';
        $champid = 'readonly';
        $send = 'updated';
        require_once (File::build_path(array('view','view.php')));  
        }else{
            //error
        }
    }


	public static function updated(){
		//Met à jour les informations d'un bénévole
        if(getIDbyLogin($_SESSION['login']) == $_GET['IDBenevole']){
    		if($_GET['password1'] != $_GET['password2']){
    			$pagetitle = 'Mots de passe incorrects';
    			$controller = 'benevole';
    			$view = 'error';
    			require_once (File::build_path(array('view','view.php')));

    		}else{
    			$values = array(
    				"login" => $_GET['login'],
    				"nom" => $_GET['nom'],
    				"prenom" => $_GET['prenom'],
    				"dateNaiss" => $_GET['dateNaiss'],
    				"email" => $_GET['email'],
    				"numTelephone" => $_GET['numTelephone'],
    			);

    			ModelBenevole::update($_GET['IDBenevole'], $values);
    			$pagetitle = 'Compte modifié';
    			$controller = 'benevole';
    			$view = 'updated';
    			require_once (File::build_path(array('view','view.php')));  
    		}
        }else{
                $pagetitle = 'Vous n\'avez pas les droits';
                $controller = 'benevole';
                $view = 'error';
                require_once (File::build_path(array('view','view.php')));  
        }
	}

    public static function connect(){
        // Permet de se connecter 
        $pagetitle = 'Entrez vos informations';
        $controller = 'benevole';
        $view = 'connect';
        require_once (File::build_path(array('view','view.php')));  
    }


    public static function connected(){
		// Permet de se connecter 
		require_once (File::build_path(array('lib','Security.php')));  
		$pwd= Security::chiffrer($_GET['password']);

		if(ModelBenevole::checkPassword($_GET['login'], $pwd)){
			$id = ModelBenevole::getIDbyLogin($_GET['login']);
			$bene = ModelBenevole::select($id);

			if($bene->__get('nonce') == null){   
				$id = ModelBenevole::getIDbyLogin($_GET['login']);
				$b = ModelBenevole::select($id);     
				$pagetitle = 'Vous êtes connecté';
				$controller = 'benevole';
				$view = 'detail'; //renvoie sur le détail 
				$_SESSION['login'] = $_GET['login'];
			}else{
				$pagetitle = 'Compte non validé';
				$controller = 'benevole';
				$view = 'error'; //renvoie sur l'erreur
			}
			require_once (File::build_path(array('view','view.php')));  
		}else{
			$pagetitle = 'Mauvais identifiants et/ou mot de passe';
			$controller = 'benevole';
			$view = 'error';
			require_once (File::build_path(array('view','view.php')));  
		}
	}

    public static function deconnect(){
        // permet la déconnection 
        session_unset($_SESSION['login']);
        session_destroy ();
		$pagetitle = 'Accueil';
		$controller = 'benevole';
		$view = 'deconnect';
        require_once (File::build_path(array('view','view.php')));  
    }


	public static function validate(){

		$b = ModelBenevole::select($_GET['IDBenevole']); 
		if($_GET['nonce'] == $b->__get('nonce')){
	
			ModelBenevole::nonce($_GET['IDBenevole']);//utilisation de l'update générique

			$pagetitle = 'Votre compte est validé';
			$controller = 'benevole';
			$view = 'detail'; //renvoie sur le détail 
			require_once (File::build_path(array('view','view.php'))); 
		}else{
			$pagetitle = 'Votre compte n\'est pas validé';
			$controller = 'benevole';
			$view = 'error';
			require_once (File::build_path(array('view','view.php')));    
		}      
	}
		
	public static function benevoleDispo(){
		//Affiche les bénévoles disponible aux créneau voulue *   

    		$creneau = ModelCreneaux::select($_GET['IDCreneau']);
    		$poste = ModelPoste::select($_GET['IDPoste']);
    		$tab_b = ModelDisponibilites::selectAllBenevoleDispo($_GET['IDFestival'], $_GET['IDCreneau']);
    		
    		$dispo = 'yes';
    		$controller = 'benevole';
    		$view = 'list';
            $pagetitle = 'Liste des Bénévoles';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
	}

    public static function benevoleAffecter(){
        //**                                                           
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $creneau = ModelCreneaux::select($_GET['IDCreneau']);
            $poste = ModelPoste::select($_GET['IDPoste']);
            $tab_b = ModelDisponibilites::selectAllBenevoleAffecter($_GET['IDFestival'], $_GET['IDCreneau']);

            $dispo = 'no';
            $controller = 'benevole';
            $view = 'list';
            $pagetitle = 'Liste des Bénévoles';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }

    }
	
	public static function affecter(){
		//affecte un benevole à un poste **
		$creneau = ModelCreneaux::select($_GET['IDCreneau']);
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival']) && $creneau->__get('nbBenevoles') != 0){
            
    		 	$ben = ModelBenevole::select($_GET['IDBenevole']);
            	$poste = ModelPoste::select($_GET['IDPoste']);
    		  	ModelBenevole::affecterBenevole($_GET['IDBenevole'], $_GET['IDCreneau']);
    		
    		  	$controller = 'benevole';
    		  	$view = 'affecter';
                $pagetitle = 'Bénévole ajouté';
                require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue       
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
	}

    public static function supprimerDuCreneau(){
        //**
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $poste = ModelPoste::select($_GET['IDPoste']);
            ModelBenevole::supprimerBenevoleCreneau($_GET['IDBenevole'], $_GET['IDCreneau']);

            $controller = 'benevole';
            $view = 'affecter';
            $pagetitle = 'Bénévole supprimé du creneau';
            $send = 'supprime';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function readPlanning(){
        //*
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
            $tab_plan = ModelBenevole::planning($_GET['IDBenevole'],$_GET['IDFestival']);
            $controller = 'benevole';
            $view = 'planning';
            $pagetitle = 'Votre planning';
            require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function ajouterPref(){
    	ModelBenevole::ajouterPref(ModelBenevole::getIDbyLogin($_SESSION['login']),$_GET['IDPoste']);
    	$controller = 'benevole';
        $view = 'preference';
        $pagetitle = 'Ajout éffectué';
        $send = 'ajout';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }

    public static function supprimerPref(){
    	ModelBenevole::retirerPref(ModelBenevole::getIDbyLogin($_SESSION['login']),$_GET['IDPoste']);
    	$controller = 'benevole';
        $view = 'suppPref';
        $pagetitle = 'Suppression éffectué';
        $send = 'retirer';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }

    public static function readPostesPref(){
        $tab_pref = ModelBenevole::readPostesPref(ModelBenevole::getIDbyLogin($_SESSION['login']));
        $controller = 'benevole';
        $view = 'preference';
        $pagetitle = 'Liste des postes préférés';
        $send = 'liste';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }
}

?>

<?php

require_once (File::build_path(array('model','ModelPoste.php')));

class ControllerPoste {
    protected static $object = "poste";

    public static function readPostesFestival() {
		//Affiche tous les postes *
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
    		$tab_p = ModelPoste::getPostebyFestival($_GET['IDFestival']);     //appel au modèle pour gerer la BD
    		//echo $tab_p ;
    		$controller = 'poste';
    		$view = 'list';
    		$pagetitle = 'Liste des Postes du festival';
    		require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }   
	}

    public static function read(){
        //Détail d'un poste *
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
        	$p = ModelPoste::select($_GET['IDPoste']); 
        	if ($p == false){
                $pagetitle = 'Erreur sur les détails du poste';
                $controller = 'poste';
                $view = 'error';
          		require_once (File::build_path(array('view','view.php')));
        	}else{ 
                $pagetitle = 'Détail d\'un poste';
                $controller = 'poste';
                $view = 'detail';
                require_once (File::build_path(array('view','view.php')));
        	}
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        } 
    }

    public static function create(){
        //Crée un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $pagetitle = 'Créer un poste';
            $controller = 'poste';
            $view = 'update';
    		$send = 'create';
       		require_once (File::build_path(array('view','view.php')));	
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        } 
    }

    public static function created(){
        //Crée un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
        	$values = array(
            "nomPoste" => $_GET['nomPoste'],
        	);

    		$p = new ModelPoste(null, $_GET['nomPoste']);
    		$p->save($values);
    		$poste = ModelPoste::dernierPosteSave();
    		ModelPoste::savePoste($_GET['IDFestival'], $poste->__get('IDPoste')); //enregistre dans la table de jointure
        	$recupNom = ModelFestival::select($_GET['IDFestival']);
    		$controller = 'poste';
            $view = 'created';
            $pagetitle = 'Poste créé';
            require_once (File::build_path(array('view','view.php')));
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function deleted(){
        //Supprime un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            ModelPoste::delete($_GET['IDPoste']);
    		$recupNom = ModelFestival::select($_GET['IDFestival']);
            $pagetitle = 'Poste supprimé';
            $controller = 'poste';
            $view = 'deleted';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function update(){
        //Met à jour un poste  **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
    		$poste = ModelPoste::select($_GET['IDPoste']);
            $pagetitle = 'Modifier un poste';
            $controller = 'poste';
            $view = 'update';
    		$send = 'updated';
            require_once (File::build_path(array('view','view.php'))); 
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        } 
    }


    public static function updated(){
        //Met à jour un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $values = array(
                "nomPoste" => $_GET['nomPoste'],
            );
            ModelPoste::update($_GET['IDPoste'],$values);
            $pagetitle = 'Poste modifié';
            $controller = 'poste';
            $view = 'updated';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        } 
    }
}
?>

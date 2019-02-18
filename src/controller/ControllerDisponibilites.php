<?php

require_once (File::build_path(array('model','ModelDisponibilites.php')));

class ControllerDisponibilites {
	protected static $object = "disponibilites";

	public static function readAll() {
		//Affiche tous les postes 

		$tab_dispo = ModelDisponibilites::selectAllDispo(ModelBenevole::getIDbyLogin($_SESSION['login']));     //appel au modèle pour gerer la BD
		//echo $tab_p ;
		$controller = 'disponibilites';
		$view = 'list';
		$pagetitle = 'Liste des Disponibilites';
		require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue   	
	}

    public static function read(){
       //*
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
        	$dispo = ModelDisponibilites::getBy($_GET['IDDisponibilites']); 
        	if ($p == false){
                $pagetitle = 'Poste erreur';
                $controller = 'disponibilites';
                $view = 'error';
          		require_once (File::build_path(array('view','view.php')));
        	}else{ 
                $pagetitle = 'Détail de cette disponibilites';
                $controller = 'Disponibilites';
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
            $pagetitle = 'Créer une disponibilite';
            $controller = 'disponibilites';
            $view = 'update';
    		$send = 'created';
   		require_once (File::build_path(array('view','view.php')));
	}
//http://webinfo.iutmontp.univ-montp2.fr/~alarconj/ProjetS3/index.php?controlleur=benevole&action=read&IDBenevole=1
//http://webinfo.iutmontp.univ-montp2.fr/~alarconj/ProjetS3/index.php?controller=benevole&action=read&IDBenevole=1
	public static function created(){
        //Crée un poste

    	$values = array(
        	"idBenevole" => $_GET['idBenevole'],
    		"debutDispo" => $_GET['debutDispo'],
    		"heureDebutDispo" => $_GET['heureDebutDispo'],
    		"heureFinDispo" => $_GET['heureFinDispo'],
    	);

        //$verification = ModelDisponibilites::verificationDispo($_GET['idBenevole'], $_GET['debutDispo'], $_GET['heureDebutDispo'], $_GET['heureFinDispo']);
		
        if($_GET['heureFinDispo'] > $_GET['heureDebutDispo']){
            $dispo = new ModelDisponibilites(null, $_GET['idBenevole'], $_GET['debutDispo'], $_GET['heureDebutDispo'], $_GET['heureFinDispo']);
            $dispo->save($values);
   
            $controller = 'disponibilites';
            $view = 'created';
            $pagetitle = 'Disponibilite créé';
            require_once (File::build_path(array('view','view.php')));
        }else{
            $controller = 'disponibilites';
            $view = 'erreur';
            $pagetitle = 'Valeur incohérente ou déjà rentré';
            require_once (File::build_path(array('view','view.php')));
        }
        
	}

	public static function deleted(){
        //Supprime un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            ModelDisponibilites::delete($_GET['IDDisponibilites']);

            $pagetitle = 'Disponibilite supprimé';
            $controller = 'disponibilites';
            $view = 'deleted';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
	}

    public static function update(){
        //Met à jour un poste **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
    		$dispo = ModelDisponibilites::select($_GET['IDDisponibilites']);
            $pagetitle = 'Modifier une disponibilite';
            $controller = 'disponibilites';
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
                "idBenevole" => $_GET['idBenevole'],
        		"debutDispo" => $_GET['debutDispo'],
        		"heureDebutDispo" => $_GET['heureDebutDispo'],
        		"heureFinDispo" => $_GET['heureFinDispo'],
            );
            ModelDisponibilites::update($_GET['IDDisponibilites'],$values);
            $pagetitle = 'Disponibilite modifié';
            $controller = 'disponibilites';
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

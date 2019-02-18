<?php

require_once (File::build_path(array('model','ModelFestival.php')));

class ControllerFestival {
    protected static $object = "festival";

    public static function readAll() {
        //Affiche la liste des festivals 
        $tab_f = ModelFestival::selectAll();     //appel au modèle pour gerer la BD
        $controller = 'festival';
        $view = 'list';
        $pagetitle = 'Liste des Festivals';
        require_once (File::build_path(array('model','ModelBenevole.php')));
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }

    public static function home() {
        //Retour à la page d'accueil
        
        $controller = 'festival';
        $view = 'home';
        $pagetitle = 'Bienvenue chez festivalio';
        require_once (File::build_path(array('model','ModelBenevole.php')));
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }

    public static function read(){
        //Affiche les détails d'un festival

    	$f = ModelFestival::select($_GET['IDFestival']); 
    	if ($f == false){
            $pagetitle = 'Erreur du détail du festival';
            $controller = 'festival';
            $view = 'error';
    		 require_once (File::build_path(array('view','view.php')));
    	}else{ 
            //$b = ModelBenevole::getIDbyLogin($_SESSION['login']);
            $pagetitle = 'Détail du festival';
            $controller = 'festival';
            $view = 'detail';
            require_once (File::build_path(array('view','view.php')));
    	}
    }

    public static function create(){
        //Crée un festival
        if(isset($_SESSION['login'])){
            $pagetitle = 'Création d\'un festival';
            $controller = 'festival';
            $view = 'create';
       		require_once (File::build_path(array('view','view.php')));
        }else{
            $pagetitle = 'Veuillez vous connecter';
            $controller = 'festival';
            $view = 'error';
            require_once (File::build_path(array('view','view.php')));  

        }	
    }

    public static function created(){
        //Crée un festival

    	$values = array(
            "nomFestival" => $_GET['nomFestival'],
            "lieuFestival" => $_GET['lieuFestival'],
            "dateDebutF" => $_GET['dateDebutF'],
            "dateFinF" => $_GET['dateFinF'],
            "description" => $_GET['description'],
    	);

    	$f = new ModelFestival(null, $_GET['nomFestival'], $_GET['lieuFestival'], $_GET['dateDebutF'], $_GET['dateFinF'], $_GET['description']);
    	$f->save($values);

        $b = ModelBenevole::getIDbyLogin($_SESSION['login']);
        $fest = ModelFestival::getLastSaved();

        ModelFestival::setParticipate($b, $fest);
        ModelBenevole::accept($b, $fest);
        ModelBenevole::promote($b, $fest);

    	$controller = 'festival';
        $view = 'created';
        $pagetitle = 'Festival créé';
        require_once (File::build_path(array('view','view.php')));
    }

    public static function deleted(){
        //Supprime un festival **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            ModelFestival::delete($_GET['IDFestival']);
            ModelFestival::delLink($_GET['IDFestival']);//on pense à supprimer les tables de liaison
            $pagetitle = 'Festival supprimé';
            $controller = 'festival';
            $view = 'deleted';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function update(){
        // Modifie un festival **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $festival = ModelFestival::select($_GET['IDFestival']);
            $pagetitle = 'Modifier le festival';
            $controller = 'festival';
            $view = 'update';
            $champid = 'readonly';
            $send = 'updated';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }


    public static function updated(){
        //Modifie un festival **
        if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
            $values = array(
                "nomFestival" => $_GET['nomFestival'],
                "lieuFestival" => $_GET['lieuFestival'],
                "dateDebutF" => $_GET['dateDebutF'],
                "dateFinF" => $_GET['dateFinF'],
                "description" => $_GET['description'],
            );

            ModelFestival::update($_GET['IDFestival'], $values);
            $pagetitle = 'Festival modifié';
            $controller = 'festival';
            $view = 'updated';
            require_once (File::build_path(array('view','view.php')));  
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        }
    }

    public static function participate(){
        //quand on clique sur participer cela inscrit un bénévole et le met en attente de validation
        $id = ModelBenevole::getIDbyLogin($_SESSION['login']);
        ModelFestival::setParticipate($id, $_GET['IDFestival']);
        $pagetitle = 'Accueil';
        $controller = 'festival';
        $view = 'participate';
        require_once (File::build_path(array('view','view.php'))); 

    }

    public static function postulate(){
        //*
        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
            $id = ModelBenevole::getIDbyLogin($_SESSION['login']);
            ModelFestival::postulate($id, $_GET['IDFestival']);
            $pagetitle = 'Accueil';
            $controller = 'festival';
            $view = 'participate';
            require_once (File::build_path(array('view','view.php'))); 
        }else{
            $controller = 'benevole';
            $view = 'error';
            $pagetitle = 'Vous n\'avez pas les droits ';
        } 
    }



}
?>

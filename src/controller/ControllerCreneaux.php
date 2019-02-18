<?php
/*
contient le code source des actions. 
C’est donc ici qu’est présente la logique du site Web : 
on y appelle le modèle pour récupérer/enregistrer des données,
 on traite ces données, 
 on appelle les vues pour écrire la page Web…
 
*/

require_once (File::build_path(array('model','ModelCreneaux.php')));

class ControllerCreneaux {
    protected static $object = "creneaux";

    public static function readAll() {
        //Affiche tous les bénévoles 
        $tab_creneau = ModelCreneaux::selectAllCren($_GET['IDPoste'],$_GET['IDFestival']);     //appel au modèle pour gerer la BD
        $poste = ModelPoste::select($_GET['IDPoste']);
        $controller = 'creneaux';
        $view = 'list';
        $pagetitle = 'Liste des Créneaux';
        require_once (File::build_path(array('view','view.php')));  //"redirige" vers la vue
    }


    public static function read(){
        //Affiche les détails d'un bénévole

    	$creneau = ModelCreneaux::select($_GET['IDCreneau']); 
    	if ($c == false){
            $pagetitle = 'Erreur du détail du créneau';
            $controller = 'creneaux';
            $view = 'error';
    		require_once (File::build_path(array('view','view.php')));
    	}else{ 
            $pagetitle = 'Informations du créneau';
            $controller = 'creneaux';
            $view = 'detail';
            require_once (File::build_path(array('view','view.php')));
    	}
    }

    public static function create(){
        //Crée un bénévole

        $pagetitle = 'Créer un creneau';
        $controller = 'creneaux';
        $view = 'update';
        $send = 'created';
   		require_once (File::build_path(array('view','view.php')));	
    }

    public static function created(){
        //Crée un bénévole

    	$values = array(
            "idPoste" => $_GET['IDPoste'],
            "debutCreneau" => $_GET['debutCreneau'],
            "heureDebutCreneau" => $_GET['heureDebutCreneau'],
            "heureFinCreneau" => $_GET['heureFinCreneau'],
            "nbBenevoles" => $_GET['nbBenevoles'],
    	);
        //$verification = ModelCreneaux::verificationCreneau($_GET['IDFestival'], $_GET['debutCreneau']);
    	
        if(($_GET['heureFinCreneau'] > $_GET['heureDebutCreneau'])){
            $creneau = new ModelCreneaux(NULL, $_GET['IDPoste'], $_GET['debutCreneau'], $_GET['heureDebutCreneau'], $_GET['heureFinCreneau'], $_GET['nbBenevoles']);
            $creneau->save($values);

            $controller = 'creneaux';
            $view = 'created';
            $pagetitle = 'Succès de la création du créneau';
			require_once (File::build_path(array('view','view.php')));
        }else{
        	$controller = 'creneaux';
            $view = 'error';
            $pagetitle = 'Valeur incohérente ou déjà rentrée';
			require_once (File::build_path(array('view','view.php')));
        }
    }

    public static function deleted(){
        //Supprime un bénévole
        $poste = ModelPoste::select($_GET['IDPoste']);
        ModelCreneaux::delete($_GET['IDCreneau']);
        $pagetitle = 'Créneau supprimé';
        $controller = 'creneaux';
        $view = 'deleted';
        require_once (File::build_path(array('view','view.php')));  
    }

    public static function update(){
        //Met à jour les informations d'un bénévole
    	$creneau = ModelCreneaux::select($_GET['IDCreneau']);
        $pagetitle = 'Modifier le creneau';
        $controller = 'creneaux';
        $view = 'update';
        $send = 'updated';
        require_once (File::build_path(array('view','view.php')));  
    }

    public static function updated(){
        //Met à jour les informations d'un bénévole
        $poste = ModelPoste::select($_GET['IDPoste']);
        $values = array(
            "debutCreneau" => $_GET['debutCreneau'],
            "heureDebutCreneau" => $_GET['heureDebutCreneau'],
            "heureFinCreneau" => $_GET['heureFinCreneau'],
            "nbBenevoles" => $_GET['nbBenevoles'],
        );

        ModelCreneaux::update($_GET['IDCreneau'],$values);

        $pagetitle = 'Informations du créneau modifiées';
        $controller = 'creneaux';
        $view = 'updated';
        require_once (File::build_path(array('view','view.php')));  
    }
}
?>

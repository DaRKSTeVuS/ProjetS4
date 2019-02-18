<?php

/*
e routeur (e.g. est la page que l’utilisateur 
demande pour se connecter au site. 
C’est donc le script PHP de cette page qui est exécuté. 
Cette page est chargée de RECUPERER LACTION ENVOYEE
AVEC LA DEMANDE DE LA PAGE et 
d’appeler le bon code du contrôleur correspondant.
*/
$DS = DIRECTORY_SEPARATOR;

require_once "./lib/File.php";
require_once (File::build_path(array('controller','ControllerFestival.php')));
require_once (File::build_path(array('controller','ControllerBenevole.php')));
require_once (File::build_path(array('controller','ControllerPoste.php')));
require_once (File::build_path(array('controller','ControllerCreneaux.php')));
require_once (File::build_path(array('controller','ControllerDisponibilites.php')));

if (isset($_GET['controller'])){
	$controller = $_GET['controller'];
}else{
		$controller = 'festival';
}

$controller_class = "Controller";
$controller_class .= ucfirst($controller); //on concatene avec le nom du controlleur desiré
	if(isset($_GET['action'])){ //si l'action est donnée
		$action = $_GET['action'];
		if (class_exists($controller_class)){ //si le controlleur mentionné existe
			if(in_array($_GET['action'], get_class_methods($controller_class))){
				
				$controller_class::$action(); 
			}else{
				
				if($controller = 'festival'){
					ControllerFestival::home(); 
				}else{
					$controller_class::readAll(); 
				}
			}
		}else{ //sinon on fait un read all de festival (page par defaut)
			$controller_class::readAll(); 
		}
	}else{
		$controller_class::readAll(); 
	}
?>
	
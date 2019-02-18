<?php
    echo '<div class="boite">';
		echo '<p>Portail du festival ' . $f->__get('nomFestival') . '</p>';
		echo '<p>Lieu: ' . $f->__get('lieuFestival') .'</p>';
		echo '<p>Date de début: ' . $f->__get('dateDebutF') .' </p>';
		echo '<p>Date de fin: ' . $f->__get('dateFinF') .' </p>';
		echo '<p>Description du festival : ' . $f->__get('description');
	echo '</div>';

	
	if(isset($_SESSION['login'])){
	echo'<div class="boite">';
	    //on vérifie que l'utilisateur est connécté
	    $id = ModelBenevole::getIDbyLogin($_SESSION['login']);//l'id sert pour les paramètres des fonctions suivantes

	    if(ModelBenevole::isParticipant($id , $_GET['IDFestival'])){
	        //on regarde si l'utilisateur est enregistré pour ce festival
	        if(ModelBenevole::isValide($_SESSION['login'], $_GET['IDFestival'])){
	            //statut benevole
	            if(ModelBenevole::isOrga($_SESSION['login'], $_GET['IDFestival'])){
	                echo '<p>Vous êtes organisateur de ce festival</p>';
	                //fonctionnalités en plus pour l'organisateur
	                
	                echo '<p><div class="item"><a href="index.php?controller=benevole&action=readDemandes&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '">Liste des bénévoles à accepter</a></p></div>';
	                echo '<p><div class="item"><a href="index.php?controller=benevole&action=readDemandesOrga&IDFestival='. htmlspecialchars($f->__get('IDFestival')) . '">Liste des organisateurs à accepter</a></p></div>';
	                echo '<p><div class="item"><a href="index.php?action=deleted&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '"> Supprimer le festival </a></p></div>';
	                echo '<p><div class="item"><a href="index.php?action=update&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '"> Modifier le festival </a></p></div>';
	                
	            }else{
	                //fonctionalités uniquement pour les bénévoles
	                echo '<p>Vous êtes bénévole de ce festival</p>';
	                echo '<div class="item"><p> <a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=festival&action=postulate&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '"> Postuler en tant qu\'organisateur </a></p></div>';
	            }
	            //fonctionnalités communes à tout le monde validé
	            echo '<p><div class="item"><a href="index.php?controller=benevole&action=readOrga&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) .'">Liste des organisateurs</a></p></div>';
	            echo '<p><div class="item"><a href="index.php?controller=benevole&action=readBene&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) .'">Liste des benevoles</a></p></div>';
	            echo '<p><div class="item"><a href="index.php?controller=poste&action=readPostesFestival&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) .'">Liste des postes</a></p></div>';
	            echo '<p><div class="item"><a href="index.php?controller=benevole&action=readPostesPref&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) .'">Liste des postes préférés</a></p></div>';
	            echo '<p><div class="item"><a href="index.php?controller=benevole&action=readPlanning&IDBenevole=' . htmlspecialchars($id) . '&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '">Afficher votre planning</a></div>';
	        }else{
	            //l'utilisateur est enregistré mais pas validé par un organisateur
	            echo '<p>Vous êtes en attente de validation pour ce festival</p>';
	        }
	    }else{
	        //on ne dispose d'aucun statut pour le festival
	        echo '<div class="item"><p>Vous pouvez postuler pour ce festival en cliquant ici: <a href="index.php?action=participate&IDFestival=' . htmlspecialchars($f->__get('IDFestival')) . '"> Participer  </a></p></div>';
	    }
	    echo'</div>';
	}else{
		echo'<div class="boite">';
		echo'<p>Connectez vous pour accéder à plus de fonctionnalités.</p>';
		echo'</div>';
	}

?>

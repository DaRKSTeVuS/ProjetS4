<?php

require_once (File::build_path(array('model','Model.php')));
/*
est une bibliothèque des fonctions 
permettant de gérer les données, 
i.e. l’interaction avec la BDD dans notre cas. 
Cette bibliothèque sera utilisée par le contrôleur.
*/
Class ModelBenevole extends Model{

    protected static $object = 'Benevole';
    protected static $primary = 'IDBenevole';

    private $IDBenevole;
    private $login;
    private $password;
    private $nom;
    private $prenom;
    private $dateNaiss;
    private $email;
    private $numTelephone;


/////////////////////////FONCTIONS GENERIQUE///////////////////////////////////

     public function __construct($data = NULL){
        if (!is_null($data)){
            foreach ($data as $cle => $valeur) {
                $this->set($cle,$valeur);
            }
        }
    }

    public function __get($key){
        return $this->$key;
    }

    public function __set($key, $value){
		$this->$key = $value;
	}

    /*

    public static function getAllBenevoles(){
        $rep = Model::$pdo->query("SELECT * FROM Benevole WHERE isOrganisateur = 1 ");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_b = $rep->fetchAll();
        return $tab_b;
    }

    public static function getAllOrganisateur(){
        $rep = Model::$pdo->query("SELECT * FROM Benevole WHERE isOrganisateur = 0");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_b = $rep->fetchAll();
        return $tab_b;
    }*/



    public static function readAllOrga($IDFestival){
          $sql = "SELECT * FROM Benevole p
                                    JOIN link_BenevoleParticipeFestival l ON p.IDBenevole = l.IDBenevole
                                    WHERE l.IDFestival = :nom_tag AND l.isOrganisateur = 1";
                $req_prep = Model::$pdo->prepare($sql);
                $values = array(
                    "nom_tag" => $IDFestival,
                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
                $tab_b = $req_prep->fetchAll();
                if (empty($tab_b)){
                    return false;
                  }
                return $tab_b;
    }

    public static function readAllBene($IDFestival){
      //trouve tous les benevoles d'un festival donné (organisateurs compris)
		$sql = "SELECT p.IDBenevole, p.login, p.password, p.nom, p.prenom, p.dateNaiss, p. email, p.numTelephone, p.nonce FROM Benevole p
											JOIN link_BenevoleParticipeFestival lbpf ON p.IDBenevole = lbpf.IDBenevole
											WHERE lbpf.IDFestival = :nom_tag AND lbpf.valide=1";
		$req_prep = Model::$pdo->prepare($sql);
        $values = array(
			"nom_tag" => $IDFestival,
        );
        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_b = $req_prep->fetchAll();
        if (empty($tab_b)){
			return false;
        }
        return $tab_b;
    }

    public static function readAllDemandes($IDFestival){
		//trouve tous les demandes à accepter d'un festival donné (organisateurs compris)
		$sql = "SELECT p.IDBenevole, p.login, p.password, p.nom, p.prenom, p.dateNaiss, p. email, p.numTelephone, p.nonce FROM Benevole p
				JOIN link_BenevoleParticipeFestival lbpf ON p.IDBenevole = lbpf.IDBenevole
				WHERE lbpf.IDFestival = :nom_tag AND lbpf.valide=0";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array(
			"nom_tag" => $IDFestival,
		);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
		$tab_b = $req_prep->fetchAll();
		if (empty($tab_b)){
			return false;
		}
		return $tab_b;
    }

    public static function isPref($benevole, $poste){
    	$sql = "SELECT * FROM link_PreferenceBenevolePostes
    			WHERE IDBenevole = $benevole AND IDPoste = $poste";
    	$req_prep = Model::$pdo->prepare($sql);
    	$req_prep->execute();
    	$req_prep->setFetchMode(PDO::FETCH_NUM);
    	$tab_b = $req_prep->fetchAll();

    	if (empty($tab_b)){
      		return 0;
    	}
    	return 1;
    }

    public static function readAllDemandesOrga($IDFestival){
    //trouve tous les demandes à accepter d'un festival donné (organisateurs compris)
    $sql = "SELECT p.IDBenevole, p.login, p.password, p.nom, p.prenom, p.dateNaiss, p. email, p.numTelephone, p.nonce FROM Benevole p
        JOIN link_BenevoleParticipeFestival lbpf ON p.IDBenevole = lbpf.IDBenevole
        WHERE lbpf.IDFestival = :nom_tag AND lbpf.candidat=1";
    $req_prep = Model::$pdo->prepare($sql);
    $values = array(
      "nom_tag" => $IDFestival,
    );
    $req_prep->execute($values);
    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
    $tab_b = $req_prep->fetchAll();
    if (empty($tab_b)){
      return false;
    }
    return $tab_b;
    }

    public static function checkPassword($login,$mot_de_passe_chiffre) {
		$sql = "SELECT * from Benevole WHERE login=:nom_login AND password=:nom_mdp";
		// Préparation de la requête
		$req_prep = Model::$pdo->prepare($sql);

		$values = array(
			"nom_login" => $login,
			"nom_mdp" => $mot_de_passe_chiffre,
		);
		// On donne les valeurs et on exécute la requête   
		$req_prep->execute($values);

		// On récupère les résultats comme précédemment
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
		$tab_client = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_client)){
			return false;
		}
		return true;
		echo '  <div class="list">';
		echo ' Bonjour ' . $_SESSION['login'] . ', bienvenue';
		echo '</div>';
    }

    public static function accept($IDBenevole, $IDFestival){

      
      $sql = "UPDATE link_BenevoleParticipeFestival SET valide = 1
      WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }


    public static function promote($IDBenevole, $IDFestival){
      $f = ModelFestival::select($IDFestival); 
      $b = ModelBenevole::select($IDBenevole); 
      $mail = 'Bonjour '. htmlspecialchars($b->__get('prenom')) .'. Vous avez été promu organisateur sur le festival '. htmlspecialchars($f->__get('nomFestival')) .' ';
               mail($b->__get('email'), 'Acceptation en tant que bénévole', $mail);
      $sql = "UPDATE link_BenevoleParticipeFestival SET isOrganisateur = 1
      WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }

    public static function demote($IDBenevole, $IDFestival){
      $sql = "UPDATE link_BenevoleParticipeFestival SET isOrganisateur = 0
      WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }

    public static function reject($IDBenevole, $IDFestival){
      $sql = "UPDATE link_BenevoleParticipeFestival SET candidat = 0
      WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }


    public static function isParticipant($id, $IDFestival){

      if(isset($_SESSION['login'])){

        $sql = "SELECT * from link_BenevoleParticipeFestival WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);

        $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $id,
        );
        // On donne les valeurs et on exécute la requête   
        $req_prep->execute($values);

        // On récupère les résultats comme précédemment
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_client = $req_prep->fetchAll();
        // Attention, si il n'y a pas de résultats, on renvoie false
        if (empty($tab_client)){
            return false;
        }
        return true;
      }else{
        return false;
      }
    }

    public static function getIDbyLogin($login){
      $sql = "SELECT IDBenevole from Benevole WHERE login=:nom_login ";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_login" => $login,
      );
      // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
      $client = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($client)){
          return false;
      }
      $b = $client[0];  
      return $b->__get('IDBenevole');    
    }

    public static function isOrga($login, $festival){
      $id = ModelBenevole::getIDbyLogin($login);
      $sql = "SELECT isOrganisateur from link_BenevoleParticipeFestival WHERE IDBenevole=:nom_login AND IDFestival=:nom_festival ";
          $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_login" => $id,
          "nom_festival" => $festival,
      );
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_NUM);
      $tab_client = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_client)){
          return false;
      }
      return $tab_client[0][0];  
    }

    public static function isValide($login, $festival){
      $id = ModelBenevole::getIDbyLogin($login);
      $sql = "SELECT valide from link_BenevoleParticipeFestival WHERE IDBenevole=:nom_login AND IDFestival=:nom_festival ";
          $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_login" => $id,
          "nom_festival" => $festival,
      );
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_NUM);
      $tab_client = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_client)){
          return false;
      }
      return $tab_client[0][0]; 
      
    }

    public static function nonce($IDBenevole){

      //supprimme le bénévole d'un festival dans la bd
      $sql = "UPDATE Benevole SET nonce = null
      WHERE IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }

      public static function kick($IDBenevole, $IDFestival){

      //supprimme le bénévole d'un festival dans la bd
      $sql = "DELETE FROM link_BenevoleParticipeFestival 
      WHERE IDFestival=:nom_fest AND IDBenevole=:nom_bene";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
            "nom_bene" => $IDBenevole,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }

	public static function getLastSaved(){
		$sql = "SELECT IDBenevole FROM Benevole WHERE IDBenevole = (SELECT MAX(IDBenevole) FROM Benevole)";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
    
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
		$tab_res = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_res)){
			return false;
		}
		return $tab_res[0];
	}
  
	public static function affecterBenevole($benevole, $creneaux){
		$sql = "INSERT INTO link_AffecterCreneauBenevole(idCreneaux, idBenevole) VALUES ($creneaux, $benevole);";
		
		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();
		if($resultat != NULL){

			$sql2 = "UPDATE Disponibilites SET indisponible = 1 WHERE idBenevole = $benevole";
			$req_prep2 = Model::$pdo->prepare($sql2);
			$req_prep2->execute();

      $sql3 = "UPDATE Creneaux SET nbBenevoles = nbBenevoles-1  WHERE IDCreneau = $creneaux";
      $req_prep3 = Model::$pdo->prepare($sql3);
      $req_prep3->execute();	
		}
		
	}

	public static function supprimerBenevoleCreneau($benevole, $creneaux){
		$sql = "DELETE FROM link_AffecterCreneauBenevole 
				WHERE IDBenevole = $benevole
				AND IDCreneaux = $creneaux";

		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();
		if($resultat != NULL){

			$sql2 = "UPDATE Disponibilites SET indisponible = 0 WHERE idBenevole = $benevole";
			$req_prep2 = Model::$pdo->prepare($sql2);
			$req_prep2->execute();	

      $sql3 = "UPDATE Creneaux SET nbBenevoles = nbBenevoles+1  WHERE IDCreneau = $creneaux";
      $req_prep3 = Model::$pdo->prepare($sql3);
      $req_prep3->execute();
		}
	}

  	public static function planning($benevole, $festival){
  		$sql = "SELECT p.nomPoste, c.debutCreneau, c.heureDebutCreneau, c.heureFinCreneau
          		FROM link_AffecterCreneauBenevole lacb
          		JOIN Creneaux c ON lacb.idCreneaux = c.IDCreneau
          		JOIN Poste p ON c.idPoste = p.IDPoste
          		JOIN link_PostesParFestival lppf ON p.IDPoste = lppf.IDPoste
          		WHERE lacb.idBenevole = $benevole
          		AND lppf.IDFestival = $festival";
		
		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();

		$req_prep->setFetchMode(PDO::FETCH_NUM);
		$tab_res = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_res)){
			return false;
		}
		return $tab_res;
	}


	public static function ajouterPref($benevole,$poste){
		$sql = "INSERT INTO link_PreferenceBenevolePostes(IDBenevole, IDPoste) VALUES ($benevole, $poste);";
		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();
	}

	public static function retirerPref($benevole,$poste){
		$sql = "DELETE FROM link_PreferenceBenevolePostes 
				WHERE IDBenevole = $benevole
				AND IDPoste = $poste";

		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();
	}

	public static function readPostesPref($benevole){
		$sql = "SELECT p.IDPoste, p.nomPoste
				FROM link_PreferenceBenevolePostes lpbp
				JOIN Poste p ON lpbp.IDPoste = p.IDPoste
				WHERE lpbp.IDBenevole = $benevole";
		$req_prep = Model::$pdo->prepare($sql);
		$resultat = $req_prep->execute();

		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
		$tab_res = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_res)){
			return false;
		}
		return $tab_res;
	}


}
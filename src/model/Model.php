<?php

require_once (File::build_path(array('config','Conf.php')));

class Model {
	
	public static $pdo;
	
	public static function Init(){
		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();
		try{
		 // Connexion à la base de données            
		 // Le dernier argument sert à ce que toutes les chaines de caractères 
		 // en entrée et sortie de MySql soit dans le codage UTF-8
			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

			// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch(PDOException $e) {
			if (Conf::getDebug()) {
				echo $e->getMessage(); // affiche un message d'erreur
			}else{
				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
			}
			die();
		}
	}

///////////////////////////////////////////////Méthodes Génériques//////////////////////////////////////////////

	public static function select($primary){
		$table_name = static::$object;
		$class_name = 'Model';
		$class_name .= ucfirst($table_name);
		$primary_key = static::$primary;

		$sql = "SELECT * from $table_name WHERE $primary_key = :nom_tag";
		// Préparation de la requête
		$req_prep = Model::$pdo->prepare($sql);

		$values = array(
			"nom_tag" => $primary,
		);
		// On donne les valeurs et on exécute la requête   
		$req_prep->execute($values);

		// On récupère les résultats comme précédemment
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab_res = $req_prep->fetchAll();
		// Attention, s'il n'y a pas de résultats, on renvoie false
		if (empty($tab_res))
			return false;
		return $tab_res[0];
	}

	public static function selectAll(){
		$table_name = static::$object;
		$class_name = 'Model';
		$class_name .= ucfirst($table_name);
		$rep = Model::$pdo->query("SELECT * FROM $table_name");
		$rep->setFetchMode(PDO::FETCH_CLASS, $class_name);

		return $rep->fetchAll();
	}

	public static function save($data){
		$table_name = static::$object;
		$class_name = 'Model';
		$class_name .= ucfirst($table_name); 
		$attribut = "";
		$valeurs = "";
		$values = array();
		foreach ($data as $key => $value){ 
			$attribut .= $key . ", ";
			$valeurs .= "'$value'" . ", ";
			$values_etapes = array($key => $value);
			$values = array_merge($values, $values_etapes);
		}
		$attribut = rtrim($attribut," \t,");
		$valeurs = rtrim($valeurs," \t,");

		$sql = "INSERT INTO $table_name($attribut) VALUES ($valeurs);";

		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute($values);
	}

	public static function delete($primary){
		$table_name = static::$object;
		$primary_key = static::$primary;
		$sql = "DELETE FROM $table_name WHERE $primary_key='$primary'";

		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
	}

	public static function update($primary, $data){
		$table_name = static::$object;
		$primary_key = static::$primary;

		echo $primary;

		$valeurs  = "";
		$values = array();
		foreach ($data as $key => $value) {
			$valeurs .= $key . '=' . "'$value'" . ', ';
			$values_etapes = array($key => $value);
			$values = array_merge($values, $values_etapes);
		}
		$valeurs = rtrim($valeurs," \t,");
		
		$sql = "UPDATE $table_name SET $valeurs WHERE $primary_key = '$primary' ;";

		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute($values);
	}
}

Model::Init();

?>
<?php
//TODO modifier attributs
require_once (File::build_path(array('model','Model.php')));
/*
est une bibliothèque des fonctions 
permettant de gérer les données, 
i.e. l’interaction avec la BDD dans notre cas. 
Cette bibliothèque sera utilisée par le contrôleur.
*/

class ModelPoste extends Model{
   
  private $IDPoste;
  private $nomPoste;

  protected static $object = 'Poste';
  protected static $primary ='IDPoste';

  public function __construct($i = NULL, $n = NULL) {
    if (!is_null($i) && !is_null($n)) {
      // Si aucun de $m, $c et $i sont nuls,
      // c'est forcement qu'on les a fournis
      // donc on retombe sur le constructeur à 3 arguments
      $this->IDPoste = $i;
      $this->nomPoste = $n;
    }
  }
      
  public function __get($key){
    return $this->$key;
  }

  public function __set($key, $value){
    $this->$key = $value;
  }

  public static function getPostebyFestival($IDFestival){
    $sql = "SELECT DISTINCT p.IDPoste, p.nomPoste from Poste p JOIN link_PostesParFestival l ON p.IDPoste = l.IDPoste
    WHERE l.IDFestival=:nom_festival ";
          $req_prep = Model::$pdo->prepare($sql);

      $values = array(
          "nom_festival" => $IDFestival,
      );
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
      $tab_p = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_p)){
          return false;
      }
      return $tab_p; 
  }

  public static function savePoste($IDFestival, $IDPoste){
    $sql = "INSERT INTO link_PostesParFestival VALUES (:nom_fest, :nom_poste) ";
          $values = array(
          "nom_fest" => $IDFestival,
          "nom_poste" => $IDPoste,
      );
	$req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute($values);

  }
  
	public static function dernierPosteSave(){
		$sql = "SELECT IDPoste, nomPoste FROM Poste WHERE IDPoste = (SELECT MAX(IDPoste) FROM Poste)";
		$req_prep = Model::$pdo->prepare($sql);
		$req_prep->execute();
		
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
		$tab_res = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_res))
			return false;
		return $tab_res[0];
	}
}
?>


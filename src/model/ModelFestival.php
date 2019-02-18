<?php
//TODO modifier attributs
require_once (File::build_path(array('model','Model.php')));
/*
est une bibliothèque des fonctions 
permettant de gérer les données, 
i.e. l’interaction avec la BDD dans notre cas. 
Cette bibliothèque sera utilisée par le contrôleur.
*/

class ModelFestival extends Model{
   
  private $IDFestival;
  private $nomFestival;
  private $lieuFestival;
  private $dateDebutF;
  private $dateFinF;
  private $description;

  protected static $object = 'Festival';
  protected static $primary= 'IDFestival';

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

  public static function setParticipate($IDBenevole, $IDFestival){
      $sql = "INSERT INTO link_BenevoleParticipeFestival VALUES (:nom_fest, :nom_bene, 0, 0, 0);";
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
          "nom_bene" => $IDBenevole,
          "nom_fest" => $IDFestival,
      );
      $req_prep->execute($values);

    }

    public static function delLink($IDFestival){
      $sql = "DELETE FROM link_BenevoleParticipeFestival 
      WHERE IDFestival=:nom_fest ;
      DELETE FROM link_PostesParFestival
      WHERE IDFestival=:nom_fest ;";
      $req_prep = Model::$pdo->prepare($sql);

      $values = array(
            "nom_fest" => $IDFestival,
        );
        // On donne les valeurs et on exécute la requête   
      $req_prep->execute($values);
    }

    public static function postulate($IDBenevole, $IDFestival){
      $sql = "UPDATE link_BenevoleParticipeFestival SET candidat = 1
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
    $sql = "SELECT IDFestival FROM Festival WHERE IDFestival = (SELECT MAX(IDFestival) FROM Festival)";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    
    $req_prep->setFetchMode(PDO::FETCH_NUM);
    $tab_res = $req_prep->fetchAll();
    // Attention, si il n'y a pas de résultats, on renvoie false
    echo $tab_res[0][0] ;
    if (empty($tab_res))
      return false;
    return $tab_res[0][0];
  }


    public static function readDemandes(){
      if(ModelBenevole::isOrga()){

      }else{
        echo 'Vous n\'avez pas la permission de voir les demandes';
        return false;
      }
    }

    public static function validateDemande(){
      //va mettre le benevole en valide
    }
  }





?>


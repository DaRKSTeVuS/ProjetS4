<?php

class ModelCreneaux extends Model{
    
    private $IDCreneau;
    private $debutCreneau;
    private $heureDebutCreneau;
    private $heureFinCreneau;
    private $nbBenevoles;

    protected static $object = 'Creneaux';
    protected static $primary='IDCreneau';

	//constructeur générique
	public function __construct($data = NULL){
    	if (!is_null($data)){
      		foreach ($data as $cle => $valeur) {
        		$this->set($cle,$valeur);
      		}
    	}
  	}
	
	//getter générique
	public function __get($key){
		return $this->$key;
	}
	
	//setter générique
	public function __set($key, $value){
		$this->$key = $value;
	}

    public static function selectAllCren($poste, $festival){
        //trouve tous les benevoles qui ont une disponibilité qui correspond au creneaux
        
        $sql = "SELECT * FROM Creneaux c JOIN link_PostesParFestival lppf ON c.idPoste = lppf.IDPoste
                WHERE c.idPoste = $poste
                AND lppf.IDFestival = $festival";
                
        $req_prep = Model::$pdo->prepare($sql);
        
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
        $tab_b = $req_prep->fetchAll();
        if (empty($tab_b)){
            return false;
        }
        return $tab_b;
    }

	/*public static function verificationCreneau($IDFestival, $debutCreneau){
		$sql = "SELECT * FROM Creneaux c
                JOIN link_PostesParFestival lppf ON c.idPoste = lppf.IDPoste
                JOIN Festival f ON lppf.IDFestival = f.IDFestival 
                WHERE f.dateDebutF <= $debutCreneau
                AND f.dateFinF >= $debutCreneau
                AND f.IDFestival = $IDFestival";

        echo'<pre>';
        print_r($sql);
        echo'<pre>';
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_NUM);
        $tab_c = $req_prep->fetchAll();
        echo'<pre>';
        print_r($tab_c);
        echo'<pre>';
        if(empty($tab_c)){
            return 0;
        }
        return 1;
	}*/

}

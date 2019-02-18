<?php

class ModelDisponibilites extends Model{

    private $IDDisponibilites;
    private $idBenevole;
    private $debutDispo;
    private $heureDebutDispo;
    private $heureFinDispo;

    protected static $object = 'Disponibilites';
    protected static $primary='IDDisponibilites';

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
	
	public static function selectAllBenevoleDispo($IDFestival, $IDCreneau){
		//trouve tous les benevoles qui ont une disponibilité qui correspond au creneaux
		
		$sql = "SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce FROM Benevole b JOIN Disponibilites d ON b.IDBenevole = d.idBenevole
										 JOIN link_BenevoleParticipeFestival lbpf ON b.IDBenevole = lbpf.IDBenevole
										 JOIN link_PostesParFestival lppf ON  lbpf.IDFestival = lppf.IDFestival
										 JOIN Creneaux c ON lppf.IDPoste = c.idPoste
				WHERE c.debutCreneau = d.debutDispo 
				AND d.heureDebutDispo <= c.heureDebutCreneau 
				AND d.heureFinDispo >= c.heureFinCreneau
				AND lbpf.valide=1
                AND d.indisponible=0
				AND lbpf.IDFestival = :nom_Festival
				AND c.IDCreneau = :nom_Creneau";
				
		$req_prep = Model::$pdo->prepare($sql);
		
		$values = array(
			"nom_Festival" => $IDFestival,
			"nom_Creneau" => $IDCreneau,
        );
		
		$req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_b = $req_prep->fetchAll();
        if (empty($tab_b)){
			return false;
        }
        return $tab_b;
	}

    public static function selectAllBenevoleAffecter($IDFestival, $IDCreneau){
        //
        $sql = "SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce
                FROM link_AffecterCreneauBenevole lacb 
                JOIN Benevole b ON lacb.IDBenevole = b.IDBenevole
                JOIN link_BenevoleParticipeFestival lbpf ON b.IDBenevole = lbpf.IDBenevole
                WHERE lbpf.IDFestival = :nom_Festival
                AND lacb.idCreneaux = :nom_Creneau";

        $req_prep = Model::$pdo->prepare($sql);
        
        $values = array(
            "nom_Festival" => $IDFestival,
            "nom_Creneau" => $IDCreneau,
        );

        $req_prep->execute($values);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab_b = $req_prep->fetchAll();
        if(empty($tab_b)){
            return false;
        }
        return $tab_b;
    }

    public static function verificationDispo($idBenevole, $debutDispo, $heureDebutDispo, $heureFinDispo){

        $sql = "SELECT * FROM Disponibilites WHERE idBenevole = $idBenevole";

        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_NUM);
        $tab_d = $req_prep->fetchAll();
        
        foreach ($tab_d as $d) {
            if($d[2] === $debutDispo && $d[3] === $heureDebutDispo && $d[4] === $heureFinDispo){
                return 1;
            } 
        }
        return 0;
    }

    public static function selectAllDispo($IDBenevole){
        //trouve tous les benevoles qui ont une disponibilité qui correspond au creneaux
        
        $sql = "SELECT * FROM Disponibilites
                WHERE idBenevole = $IDBenevole";
                
        $req_prep = Model::$pdo->prepare($sql);
        
        $req_prep->execute();
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
        $tab_b = $req_prep->fetchAll();
        if (empty($tab_b)){
            return false;
        }
        return $tab_b;
    }

}

<?php
use PHPUnit\Framework\TestCase;

include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/Model.php';
include '../src/model/ModelDisponibilites.php';

/**
 * ModelDisponibilites test case.
 */
class ModelDisponibilitesTest extends TestCase
{

    /**
     *
     * @var ModelDisponibilites
     */
    private $modelDisponibilites;

    /**
     * Tests ModelDisponibilites->__get()
     */
    public function test__get()
    {
        $data = array(
            "IDDisponibilites" => null,
            "idBenevole" => 50,
            "debutDispo" => "2019-01-16",
            "heureDebutDispo" => "08:00:00",
            "heureFinDispo" => "09:00:00",
        );
        
        // on cr�e un b�n�vole
        $dispo = new ModelDisponibilites($data);
        
        // on r�cup�re la valeur du login avec la fonction
        $log = $dispo->__get("idBenevole");
        
        // on v�rifie qu'il est bien �gal au login donn�
        self::assertEquals(50, $log);
    }

    /**
     * Tests ModelDisponibilites->__set()
     */
    public function test__set()
    {
        // on cr�e les valeurs � donner au b�n�vole
        $data = array(
            "IDDisponibilites" => null,
            "idBenevole" => 50,
            "debutDispo" => "2019-01-16",
            "heureDebutDispo" => "08:00:00",
            "heureFinDispo" => "09:00:00",
        );
        
        // on cr�e un b�n�vole
        $dispo = new ModelDisponibilites($data);
        
        // on modifie la valeur du login avec la fonction
        $dispo->__set("idBenevole", 51);
        
        // on r�cup�re la valeur du login
        $log = $dispo->__get("idBenevole");
        
        // on v�rifie que cette valeur correspond � la nouvelle valeur donn�e
        self::assertEquals(51, $log);
    }

    /**
     * Tests ModelDisponibilites::selectAllBenevoleDispo()
     */
    public function testSelectAllBenevoleDispo()
    {
        $allBeneDispo = ModelDisponibilites::selectAllBenevoleDispo(39, 22);
        
        $rep = Model::$pdo->query("SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce FROM Benevole b JOIN Disponibilites d ON b.IDBenevole = d.idBenevole
										 JOIN link_BenevoleParticipeFestival lbpf ON b.IDBenevole = lbpf.IDBenevole
										 JOIN link_PostesParFestival lppf ON  lbpf.IDFestival = lppf.IDFestival
										 JOIN Creneaux c ON lppf.IDPoste = c.idPoste
				WHERE c.debutCreneau = d.debutDispo
				AND d.heureDebutDispo <= c.heureDebutCreneau
				AND d.heureFinDispo >= c.heureFinCreneau
				AND lbpf.valide=1
                AND d.indisponible=0
				AND lbpf.IDFestival = 39
				AND c.IDCreneau = 22");
        
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        if(empty($tab)){
            $tab = false;
        } 
        
        self::assertEquals($tab, $allBeneDispo);
    }

    /**
     * Tests ModelDisponibilites::selectAllBenevoleAffecter()
     */
    public function testSelectAllBenevoleAffecter()
    {
        $allBeneAff = ModelDisponibilites::selectAllBenevoleAffecter(39, 22);
   
        $rep = Model::$pdo->query("SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce
                FROM link_AffecterCreneauBenevole lacb
                JOIN Benevole b ON lacb.IDBenevole = b.IDBenevole
                JOIN link_BenevoleParticipeFestival lbpf ON b.IDBenevole = lbpf.IDBenevole
                WHERE lbpf.IDFestival = 39
                AND lacb.idCreneaux = 22");
        
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        if(empty($tab)){
            $tab = false;
        }
        
        self::assertEquals($tab, $allBeneAff);
    }

    /**
     * Tests ModelDisponibilites::verificationDispo()
     */
    public function testVerificationDispo()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();
            
            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testVerifDispo', 'testVerifDispo', 'testVerifDispo', 'testVerifDispo', '01/06/1999', 'testVerifDispo', 'testVerifDispo', '" . $nonce . "');");
            
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testVerifDispo'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            
            
            Model::$pdo->query("INSERT INTO Disponibilites(idBenevole, debutDispo, heureDebutDispo, heureFinDispo) VALUES (". $idBene .", '2019-01-16', '20:00:00', '22:00:00')");
      
            $verif = ModelDisponibilites::verificationDispo($idBene, "2019-01-16", "20:00:00", "22:00:00");
            $unverif = ModelDisponibilites::verificationDispo($idBene, "2019-01-14", "20:00:00", "22:00:00");
            
            self::assertEquals(1, $verif);
            self::assertEquals(0, $unverif);
        
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testVerifDispo'");
            
        }
    }

    /**
     * Tests ModelDisponibilites::selectAllDispo()
     */
    public function testSelectAllDispo()
    {
        $allDispo = ModelDisponibilites::selectAllDispo(1);
        
        $req = Model::$pdo->query("SELECT * FROM Disponibilites WHERE idBenevole = 1");
        $req->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
        $tab = $req->fetchAll();
        
        if(empty($tab)){
            $tab = false;
        }
        
        self::assertEquals($tab, $allDispo);
    }
}


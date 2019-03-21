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
				AND lbpf.IDFestival = :nom_Festival
				AND c.IDCreneau = :nom_Creneau");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        self::assertEquals(sizeof($tab), sizeof($allBeneDispo));
        
    }

    /**
     * Tests ModelDisponibilites::selectAllBenevoleAffecter()
     */
    public function testSelectAllBenevoleAffecter()
    {
        // TODO Auto-generated ModelDisponibilitesTest::testSelectAllBenevoleAffecter()
        $this->markTestIncomplete("selectAllBenevoleAffecter test not implemented");

        ModelDisponibilites::selectAllBenevoleAffecter(/* parameters */);
    }

    /**
     * Tests ModelDisponibilites::verificationDispo()
     */
    public function testVerificationDispo()
    {
        // TODO Auto-generated ModelDisponibilitesTest::testVerificationDispo()
        $this->markTestIncomplete("verificationDispo test not implemented");

        ModelDisponibilites::verificationDispo(/* parameters */);
    }

    /**
     * Tests ModelDisponibilites::selectAllDispo()
     */
    public function testSelectAllDispo()
    {
        // TODO Auto-generated ModelDisponibilitesTest::testSelectAllDispo()
        $this->markTestIncomplete("selectAllDispo test not implemented");

        ModelDisponibilites::selectAllDispo(/* parameters */);
    }
}


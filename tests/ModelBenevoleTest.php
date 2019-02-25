<?php
use PHPUnit\Framework\TestCase;
include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/ModelBenevole.php';

/**
 * ModelBenevole test case.
 */
class ModelBenevoleTest extends TestCase{

    /**
     *
     * @var ModelBenevole
     */
    private $modelBenevole;


    /**
     * Tests ModelBenevole->__get()
     */
    public function test__get() {
        
        //on cr�e les variables pour les valeurs sp�ciales
        $nonce = Security::generateRandomHex();
        
        //on cr�e les valeurs � donner au b�n�vole
        $data = array(
            "IDBenevole" => null,
            "login" => "testMethod__get",
            "password" => "testMethod__get",
            "nom" => "testMethod__get",
            "prenom" => "testMethod__get",
            "dateNaiss" => "testMethod__get",
            "email" => "testMethod__get",
            "numTelephone" => "testMethod__get",
            "nonce" => $nonce,
            );
        
        //on cr�e un b�n�vole
        $this->modelBenevole = new ModelBenevole($data);
        
        //on r�cup�re la valeur du login avec la fonction
        $log = $this->modelBenevole->__get("login");
        
        //on v�rifie qu'il est bien �gal au login donn�
        $this->assertEquals("testMethod__get", $log);
    }

    /**
     * Tests ModelBenevole->__set()
     */
    public function test__set() {
        
        //on cr�e les variables pour les valeurs sp�ciales
        $nonce = Security::generateRandomHex();
        
        //on cr�e les valeurs � donner au b�n�vole
        $data = array(
            "IDBenevole" => null,
            "login" => "testMethod__set",
            "password" => "testMethod__set",
            "nom" => "testMethod__set",
            "prenom" => "testMethod__set",
            "dateNaiss" => "testMethod__set",
            "email" => "testMethod__set",
            "numTelephone" => "testMethod__set",
            "nonce" => $nonce,
        );
        
        //on cr�e un b�n�vole
        $this->modelBenevole = new ModelBenevole($data);
        
        //on modifie la valeur du login avec la fonction
        $this->modelBenevole->__set("login", "testMethod__set2");
        
        //on r�cup�re la valeur du login
        $log = $this->modelBenevole->__get("login");
        
        //on v�rifie que cette valeur correspond � la nouvelle valeur donn�e
        $this->assertEquals("testMethod__set2", $log);
    }

    /**
     * Tests ModelBenevole::readAllOrga()
     */
    public function testReadAllOrga() {
        //on r�cup�re tous les organisateurs d'un festival avec la fonction
        $allOrga = $this->modelBenevole->readAllOrga(1);
        
        //on r�cup�re tous les organisateur d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ONb.IDBenevole = l.IDBenevole WHERE l.IDFestival == 1 AND l.isOrganisateur = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        $this->assertEquals(sizeOf($rep), sifeOf($allOrga));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < $allOrga; $i++) {
            $this->assertEquals($allOrga[$i], $rep[$i]);
        }
    }

    /**
     * Tests ModelBenevole::readAllBene()
     */
    public function testReadAllBene() {
        //on r�cup�re tous les b�n�voles d'un festival avec la fonction
        $allBene = $this->modelBenevole->readAllBene(1);
        
        //on r�cup�re tous les b�n�voles d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOINlink_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.valide = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        $this->assertEquals(sizeOf($rep), sifeOf($allBene));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < $allBene; $i++) {
            $this->assertEquals($allBene[$i], $rep[$i]);
        }
    }

    /**
     * Tests ModelBenevole::readAllDemandes()
     */
    public function testReadAllDemandes() {
        //on r�cup�re toutes les demandes de b�n�volat avec la fonction
        $allDemandes = $this->modelBenevole->readAllDemandes(1);
     
        //on r�cup�re toutes les demandes de b�n�volat "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.valide = 0;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        $this->assertEquals(sizeOf($rep), sifeOf($allDemandes));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < $allDemandes; $i++) {
            $this->assertEquals($allDemandes[$i], $rep[$i]);
        }
    }

    /**
     * Tests ModelBenevole::isPref()
     */
    public function testIsPref() {
        //on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste avec la fonction
        $pref = $this->modelBenevole->isPref(1, 46);
        
        //on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste "� la main"
        $rep = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDFestival = 1 AND IDPoste = 46;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        if(empty($rep)){
            $test = 0;
        }else{
            $test = 1;
        }
        
        //on v�rifie que les deux valeurs soient les m�mes
        $this->assertEquals($pref, $test);
    }

    /**
     * Tests ModelBenevole::readAllDemandesOrga()
     */
    public function testReadAllDemandesOrga() {
        //on r�cup�re toutes les demandes d'organisation de b�n�voles avec la fonction
        $allDemandesOrga = $this->modelBenevole->readAllDemandesOrga(1);
        
        //on r�cup�re toutes les demandes d'organisation de b�n�voles "� la main"
        $rep = Model::$pdo->query("SELET * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.candidat = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        $this->assertEquals(sizeOf($rep), sifeOf($allDemandesOrga));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < $allDemandesOrga; $i++) {
            $this->assertEquals($allDemandesOrga[$i], $rep[$i]);
        }
    }

    /**
     * Tests ModelBenevole::checkPassword()
     */
    public function testCheckPassword() {
        //on v�rifie si un mot de passe est correct avec la fonction
        $test = $this->modelBenevole->checkPassword("testMethodCheckPassword", "testMethodCheckPassword");
        
        //on v�rifie que le mot de passe n'est pas correct
        $this->assertFalse($test);
        
        //on cr�e des variables pour les donn�es "sp�ciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on ajoute un b�n�vole � la base de donn�es
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodCheckPassword, testMethodCheckPassword, testMethodCheckPassword, testMethodCheckPassword, testMethodCheckPassword, testMethodCheckPassword, testMethodCheckPassword, " . $nonce . ");");
        
        //on v�rifie si un mot de passe est correct avec la fonction
        $test2 = $this->modelBenevole->checkPassword("testMethodCheckPassword", "testMethodCheckPassword");
        
        //on supprime le b�n�vole cr�� pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodSelect;");
        
        //on v�rifie que le mot de passe est correct
        $this->assertTrue($test2);
    }

    /**
     * Tests ModelBenevole::accept()
     */
    public function testAccept()
    {
        // TODO Auto-generated ModelBenevoleTest::testAccept()
        $this->markTestIncomplete("accept test not implemented");

        ModelBenevole::accept(/* parameters */);
    }

    /**
     * Tests ModelBenevole::promote()
     */
    public function testPromote()
    {
        // TODO Auto-generated ModelBenevoleTest::testPromote()
        $this->markTestIncomplete("promote test not implemented");

        ModelBenevole::promote(/* parameters */);
    }

    /**
     * Tests ModelBenevole::demote()
     */
    public function testDemote()
    {
        // TODO Auto-generated ModelBenevoleTest::testDemote()
        $this->markTestIncomplete("demote test not implemented");

        ModelBenevole::demote(/* parameters */);
    }

    /**
     * Tests ModelBenevole::reject()
     */
    public function testReject()
    {
        // TODO Auto-generated ModelBenevoleTest::testReject()
        $this->markTestIncomplete("reject test not implemented");

        ModelBenevole::reject(/* parameters */);
    }

    /**
     * Tests ModelBenevole::isParticipant()
     */
    public function testIsParticipant()
    {
        // TODO Auto-generated ModelBenevoleTest::testIsParticipant()
        $this->markTestIncomplete("isParticipant test not implemented");

        ModelBenevole::isParticipant(/* parameters */);
    }

    /**
     * Tests ModelBenevole::getIDbyLogin()
     */
    public function testGetIDbyLogin()
    {
        // TODO Auto-generated ModelBenevoleTest::testGetIDbyLogin()
        $this->markTestIncomplete("getIDbyLogin test not implemented");

        ModelBenevole::getIDbyLogin(/* parameters */);
    }

    /**
     * Tests ModelBenevole::isOrga()
     */
    public function testIsOrga()
    {
        // TODO Auto-generated ModelBenevoleTest::testIsOrga()
        $this->markTestIncomplete("isOrga test not implemented");

        ModelBenevole::isOrga(/* parameters */);
    }

    /**
     * Tests ModelBenevole::isValide()
     */
    public function testIsValide()
    {
        // TODO Auto-generated ModelBenevoleTest::testIsValide()
        $this->markTestIncomplete("isValide test not implemented");

        ModelBenevole::isValide(/* parameters */);
    }

    /**
     * Tests ModelBenevole::nonce()
     */
    public function testNonce()
    {
        // TODO Auto-generated ModelBenevoleTest::testNonce()
        $this->markTestIncomplete("nonce test not implemented");

        ModelBenevole::nonce(/* parameters */);
    }

    /**
     * Tests ModelBenevole::kick()
     */
    public function testKick()
    {
        // TODO Auto-generated ModelBenevoleTest::testKick()
        $this->markTestIncomplete("kick test not implemented");

        ModelBenevole::kick(/* parameters */);
    }

    /**
     * Tests ModelBenevole::getLastSaved()
     */
    public function testGetLastSaved()
    {
        // TODO Auto-generated ModelBenevoleTest::testGetLastSaved()
        $this->markTestIncomplete("getLastSaved test not implemented");

        ModelBenevole::getLastSaved(/* parameters */);
    }

    /**
     * Tests ModelBenevole::affecterBenevole()
     */
    public function testAffecterBenevole()
    {
        // TODO Auto-generated ModelBenevoleTest::testAffecterBenevole()
        $this->markTestIncomplete("affecterBenevole test not implemented");

        ModelBenevole::affecterBenevole(/* parameters */);
    }

    /**
     * Tests ModelBenevole::supprimerBenevoleCreneau()
     */
    public function testSupprimerBenevoleCreneau()
    {
        // TODO Auto-generated ModelBenevoleTest::testSupprimerBenevoleCreneau()
        $this->markTestIncomplete("supprimerBenevoleCreneau test not implemented");

        ModelBenevole::supprimerBenevoleCreneau(/* parameters */);
    }

    /**
     * Tests ModelBenevole::planning()
     */
    public function testPlanning()
    {
        // TODO Auto-generated ModelBenevoleTest::testPlanning()
        $this->markTestIncomplete("planning test not implemented");

        ModelBenevole::planning(/* parameters */);
    }

    /**
     * Tests ModelBenevole::ajouterPref()
     */
    public function testAjouterPref()
    {
        // TODO Auto-generated ModelBenevoleTest::testAjouterPref()
        $this->markTestIncomplete("ajouterPref test not implemented");

        ModelBenevole::ajouterPref(/* parameters */);
    }

    /**
     * Tests ModelBenevole::retirerPref()
     */
    public function testRetirerPref()
    {
        // TODO Auto-generated ModelBenevoleTest::testRetirerPref()
        $this->markTestIncomplete("retirerPref test not implemented");

        ModelBenevole::retirerPref(/* parameters */);
    }

    /**
     * Tests ModelBenevole::readPostesPref()
     */
    public function testReadPostesPref()
    {
        // TODO Auto-generated ModelBenevoleTest::testReadPostesPref()
        $this->markTestIncomplete("readPostesPref test not implemented");

        ModelBenevole::readPostesPref(/* parameters */);
    }
}
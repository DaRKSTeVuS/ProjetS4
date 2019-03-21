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
        $bene = new ModelBenevole($data);
        
        //on r�cup�re la valeur du login avec la fonction
        $log = $bene->__get("login");
        
        //on v�rifie qu'il est bien �gal au login donn�
        self::assertEquals("testMethod__get", $log);
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
        $bene = new ModelBenevole($data);
        
        //on modifie la valeur du login avec la fonction
        $bene->__set("login", "testMethod__set2");
        
        //on r�cup�re la valeur du login
        $log = $bene->__get("login");
        
        //on v�rifie que cette valeur correspond � la nouvelle valeur donn�e
        self::assertEquals("testMethod__set2", $log);
    }

    /**
     * Tests ModelBenevole::readAllOrga()
     */
    public function testReadAllOrga() {
        //on r�cup�re tous les organisateurs d'un festival avec la fonction
        $bene = new ModelBenevole();
        $allOrga = $bene->readAllOrga(1);
        
        //on r�cup�re tous les organisateur d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.isOrganisateur = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        self::assertEquals(sizeof($tab), sizeof($allOrga));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < sizeof($allOrga); $i++) {
            self::assertEquals($allOrga[$i], $tab[$i]);
        }
    }

    /**
     * Tests ModelBenevole::readAllBene()
     */
    public function testReadAllBene() {
        //on r�cup�re tous les b�n�voles d'un festival avec la fonction
        $bene = new ModelBenevole();
        $allBene = $bene->readAllBene(2);
        
        //on r�cup�re tous les b�n�voles d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 2 AND l.valide = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        self::assertEquals(sizeOf($tab), sizeOf($allBene));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < sizeof($allBene); $i++) {
            self::assertEquals($allBene[$i], $tab[$i]);
        }
    }

    /**
     * Tests ModelBenevole::readAllDemandes()
     */
    public function testReadAllDemandes() {
        //on r�cup�re toutes les demandes de b�n�volat avec la fonction
        $bene = new ModelBenevole();
        $allDemandes = $bene->readAllDemandes(1);
     
        //on r�cup�re toutes les demandes de b�n�volat "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.valide = 0;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        self::assertEquals(sizeOf($tab), sizeOf($allDemandes));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < sizeof($allDemandes); $i++) {
            self::assertEquals($allDemandes[$i], $tab[$i]);
        }
    }

    /**
     * Tests ModelBenevole::isPref()
     */
    public function testIsPref() {
        //on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste avec la fonction
        $bene = new ModelBenevole();
        $pref = $bene->isPref(1, 46);
        
        //on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste "� la main"
        $rep = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDBenevole = 1 AND IDPoste = 46;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        if(empty($tab)){
            $test = 0;
        }else{
            $test = 1;
        }
        
        //on v�rifie que les deux valeurs soient les m�mes
        self::assertEquals($pref, $test);
    }

    /**
     * Tests ModelBenevole::readAllDemandesOrga()
     */
    public function testReadAllDemandesOrga() {
        //on r�cup�re toutes les demandes d'organisation de b�n�voles avec la fonction
        $bene = new ModelBenevole();
        $allDemandesOrga = $bene->readAllDemandesOrga(63);
        
        //on r�cup�re toutes les demandes d'organisation de b�n�voles "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 63 AND l.candidat = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        
        //on v�rifie que les deux tableaux de r�ponses ont la m�me taille
        self::assertEquals(sizeOf($tab), sizeOf($allDemandesOrga));
        
        //on v�rifie que tous les �l�ments des deux tableaux sont les m�mes
        for ($i = 0; $i < sizeof($allDemandesOrga); $i++) {
           self::assertEquals($allDemandesOrga[$i], $tab[$i]);
        }
    }

    /**
     * Tests ModelBenevole::checkPassword()
     */
    public function testCheckPassword() {
        //on v�rifie si un mot de passe est correct avec la fonction
        $bene = new ModelBenevole();
        $test = $bene->checkPassword("testMethodCheck", "testMethodCheck");
        
        //on v�rifie que le mot de passe n'est pas correct
        self::assertFalse($test);
        
        //on cr�e des variables pour les donn�es "sp�ciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un b�n�vole � la base de donn�es
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodCheck', 'testMethodCheck', 'testMethodCheck', 'testMethodCheck', '01/06/1999', 'testMethodCheck', 'testMethodCheck', '" . $nonce . "');");
        
        //on v�rifie si un mot de passe est correct avec la fonction
        $test2 = $bene->checkPassword("testMethodCheck", "testMethodCheck");
        
        //on supprime le b�n�vole cr�� pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodCheck';");
        
        //on v�rifie que le mot de passe est correct
        self::assertTrue($test2);
    }

    /**
     * Tests ModelBenevole::accept()
     */
    public function testAccept() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodAccept', 'testMethodAccept', 'testMethodAccept', 'testMethodAccept', '01/06/1999', 'testMethodAccept', 'testMethodAccept', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodAccept', 'testMethodAccept', '01/06/1999', '02/06/1999', 'testMethodAccept')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodAccept'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodAccept'");
                
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0);");
        
        //on verifie que l'attribut "valide" est bien a "false"
        $unvalide = Model::$pdo->query("SELECT valide FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on rend la participation valide avec la fonction
        $bene = new ModelBenevole();
        $bene->accept($idBene, $idFest);
        
        //on verifie que l'attribut "valide" est bien passe a "true"
        $valide = Model::$pdo->query("SELECT valide FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodAccept'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodAccept'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertFalse($unvalide);
        self::assertTrue($valide);
    }

    /**
     * Tests ModelBenevole::promote()
     */
    public function testPromote() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodPromote', 'testMethodPromote', 'testMethodPromote', 'testMethodPromote', '01/06/1999', 'testMethodPromote', 'testMethodPromote', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodPromote', 'testMethodPromote', '01/06/1999', '02/06/1999', 'testMethodPromote')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodPromote'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodPromote'");
       
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on verifie que l'attribut "isOrganisateur" est bien a "false"
        $unisOrga = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on donne le rang d'organisateur au benevole avec la fonction
        $bene = new ModelBenevole();
        $bene->promote($idBene, $idFest);
        
        //on verifie que l'attribut "isOrganisateur" est bien passe a "true"
        $isOrga = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodPromote'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodPromote'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertFalse($unisOrga);
        self::assertTrue($isOrga);
    }

    /**
     * Tests ModelBenevole::demote()
     */
    public function testDemote()
    {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodDemote', 'testMethodDemote', 'testMethodDemote', 'testMethodDemote', '01/06/1999', 'testMethodDemote', 'testMethodDemote', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodDemote', 'testMethodDemote', '01/06/1999', '02/06/1999', 'testMethodDemote')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodDemote'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodDemote'");
       
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on donne le rang d'organisateur au benevole avec la fonction
        $bene = new ModelBenevole();
        $bene->promote($idBene, $idFest);
        
        //on verifie que l'attribut "isOrganisateur" est bien a "true"
        $isOrga = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on enleve le rang d'organisateur au benevole avec la fonction
        $bene->demote();
        
        //on verifie que l'attribut "isOrganisateur" est bien passe a "false"
        $unisOrga = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
       
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodDemote'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodDemote'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertTrue($isOrga);
        self::assertFalse($unisOrga);  
    }

    /**
     * Tests ModelBenevole::reject()
     */
    public function testReject() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodReject', 'testMethodReject', 'testMethodReject', 'testMethodReject', '01/06/1999', 'testMethodReject', 'testMethodReject', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodReject', 'testMethodReject', '01/06/1999', '02/06/1999', 'testMethodReject')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodReject'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodReject'");
        
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on rejette le benevole avec la fonction
        $bene = new ModelBenevole();
        $bene->reject($idBene, $idFest);
        
        //on verifie que l'attribut "candidat" est bien passe a "false"
        $uniscandidat = Model::$pdo->query("SELECT candidat FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodReject'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodReject'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertFalse($uniscandidat);
        
    }

    /**
     * Tests ModelBenevole::isParticipant()
     */
    public function testIsParticipant() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsParticip', 'testMethodIsParticipant', 'testMethodIsParticipant', 'testMethodIsParticipant', '01/06/1999', 'testMethodIsParticipant', 'testMethodIsParticipant', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsParticip', 'testMethodIsParticipant', '01/06/1999', '02/06/1999', 'testMethodIsParticipant')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodIsParticip'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsParticip'");
       
        //on verifie que le benevole n'est pas participant avec la fonction
        $bene = new ModelBenevole();
        $unisParticipant = $bene->isParticipant($idBene, $idFest);
        
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on verifie que le benevole est participant avec la fonction
        $isParticipant = $bene->isParticipant($idBene, $idFest);
        
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsParticip'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsParticip'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest . " AND IDBenevole = " . $idBene . ";");
        
        self::assertFalse($unisParticipant);
        self::assertTrue($isParticipant);
    }

    /**
     * Tests ModelBenevole::getIDbyLogin()
     */
    public function testGetIDbyLogin() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodGetIdByLogin', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', '01/06/1999', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', '" . $nonce . "');");
        
        //on recupere l'id du benevole "a la main"
        $id = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodGetIdByLog'");
        
        //on recupere l'id du benevole avec la fonction
        $bene = new ModelBenevole();
        $test = $bene->getIDbyLogin('testMethodGetIdByLog');
        
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodGetIdByLog'");
        
        self::assertEquals($id, $test);
    }

    /**
     * Tests ModelBenevole::isOrga()
     */
    public function testIsOrga() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsOrga', 'testMethodIsOrga', 'testMethodIsOrga', 'testMethodIsOrga', '01/06/1999', 'testMethodIsOrga', 'testMethodIsOrga', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsOrga', 'testMethodIsOrga', '01/06/1999', '02/06/1999', 'testMethodIsOrga')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodIsOrga'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsOrga'");
        
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on verifie que le benevole n'est pas organisateur avec la fonction
        $bene = new ModelBenevole();
        $unisOrga = $bene->isOrga($idBene, $idFest);
        
        //on lui donne le rang d'organisateur
        $bene->promote($idBene, $idFest);
        
        //on verifie que le benevole n'est pas organisateur avec la fonction
        $isOrga = $bene->isOrga($idBene, $idFest);
        
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsOrga'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsOrga'"); 
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertFalse($unisOrga);
        self::assertTrue($isOrga);
    }

    /**
     * Tests ModelBenevole::isValide()
     */
    public function testIsValide() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsValide', 'testMethodIsValide', 'testMethodIsValide', 'testMethodIsValide', '01/06/1999', 'testMethodIsValide', 'testMethodIsValide', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsValide', 'testMethodIsValide', '01/06/1999', '02/06/1999', 'testMethodIsValide')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodIsValide'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsValide'");
        
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0)");
        
        //on verifie que le benevole n'est pas valide avec la fonction
        $bene = new ModelBenevole();
        $unisValide = $bene->isValide($idBene, $idFest);
        
        //on l'accepte
        $bene->accept($idBene, $idFest);
        
        //on verifie que le benevole est bien valide avec la fonction
        $isValide = $bene->isValide($idBene, $idFest);
       
        //on supprime les ojbets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsValide'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsValide'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        self::assertFalse($unisValide);
        self::assertTrue($isValide);
    }

    /**
     * Tests ModelBenevole::nonce()
     */
    public function testNonce() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodNonce', 'testMethodNonce', 'testMethodNonce', 'testMethodNonce', '01/06/1999', 'testMethodNonce', 'testMethodNonce', '" . $nonce . "');");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodNonce'");
        
        //on reinitialise le nonce avec la fonction
        $bene = new ModelBenevole();
        $bene->nonce($idBene);
        
        //on recupere la valeur de l'attribut nonce
        $test = Model::$pdo->query("SELECT nonce FROM Benevole WHERE login = 'testMethodNonce'");
        
        //on sumpprime les objets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodNonce'");
        
        //on verifie qu'il est "NULL"
        self::assertNull($test);
    }

    /**
     * Tests ModelBenevole::kick()
     */
    public function testKick() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodKick', 'testMethodKick', 'testMethodKick', 'testMethodKick', '01/06/1999', 'testMethodKick', 'testMethodKick', '" . $nonce . "');");
        Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodKick', 'testMethodKick', '01/06/1999', '02/06/1999', 'testMethodKick')");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodKick'");
        $idFest = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodKick'");
        
        //on fait participer le benevole au festival
        Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (". $idFest .", ". $idBene .", 0, 0, 0);");
        
        //on verifie qu'il est bien participant
        $bene = new ModelBenevole();
        $isPart = $bene->isParticipant($idBene, $idFest);
        
        //on le supprime du festival avec la fonction
        $bene->kick($idBene, $idFest);
        
        //on verifie qu'il n'est plus participant
        $unisPart = $bene->isParticipant($idBene, $idFest);
        
        //on supprime les objets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodKick'");
        Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodKick'");
        Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = ". $idFest ." AND IDBenevole = ". $idBene .";");
        
        
        self::assertTrue($isPart);
        self::assertFalse($unisPart);
    }

    /**
     * Tests ModelBenevole::getLastSaved()
     */
    public function testGetLastSaved() {
        //on cree des variables pour les donnees "speciales"
        $nonce = Security::generateRandomHex();
        
        //on ajoute un benevole
        Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodGetLastSav', 'testMethodGetLastSaved', 'testMethodGetLastSaved', 'testMethodGetLastSaved', '01/06/1999', 'testMethodGetLastSaved', 'testMethodGetLastSaved', '" . $nonce . "');");
        
        //on recupere les id des deux objets crees
        $idBene = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodGetLastSav'");
        
        $bene = new ModelBenevole();
        $test = $bene->getLastSaved();
                
        //on supprime les objets crees
        Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodGetLastSav'");
        
        //on verifie que les id sont bien identiques
        self::assertEquals($idBene, $test);
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
    public function testSupprimerBenevoleCreneau() {
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
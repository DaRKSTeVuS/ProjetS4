<?php
use PHPUnit\Framework\TestCase;

include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/ModelBenevole.php';
include '../src/model/ModelFestival.php';

/**
 * ModelBenevole test case.
 */
class ModelBenevoleTest extends TestCase

{

    /**
     *
     * @var ModelBenevole
     */
    private $modelBenevole;

    // Variable pour emuler des cookies de sessions
    public static $shared_session = array();

    /**
     * Tests ModelBenevole->__get()
     */
    public function test__get()
    {

        // on cr�e les variables pour les valeurs sp�ciales
        $nonce = Security::generateRandomHex();

        // on cr�e les valeurs � donner au b�n�vole
        $data = array(
            "IDBenevole" => null,
            "login" => "testMethod__get",
            "password" => "testMethod__get",
            "nom" => "testMethod__get",
            "prenom" => "testMethod__get",
            "dateNaiss" => "testMethod__get",
            "email" => "testMethod__get",
            "numTelephone" => "testMethod__get",
            "nonce" => $nonce
        );

        // on cr�e un b�n�vole
        $bene = new ModelBenevole($data);

        // on r�cup�re la valeur du login avec la fonction
        $log = $bene->__get("login");

        // on v�rifie qu'il est bien �gal au login donn�
        self::assertEquals("testMethod__get", $log);
    }

    /**
     * Tests ModelBenevole->__set()
     */
    public function test__set()
    {

        // on cr�e les variables pour les valeurs sp�ciales
        $nonce = Security::generateRandomHex();

        // on cr�e les valeurs � donner au b�n�vole
        $data = array(
            "IDBenevole" => null,
            "login" => "testMethod__set",
            "password" => "testMethod__set",
            "nom" => "testMethod__set",
            "prenom" => "testMethod__set",
            "dateNaiss" => "testMethod__set",
            "email" => "testMethod__set",
            "numTelephone" => "testMethod__set",
            "nonce" => $nonce
        );

        // on cr�e un b�n�vole
        $bene = new ModelBenevole($data);

        // on modifie la valeur du login avec la fonction
        $bene->__set("login", "testMethod__set2");

        // on r�cup�re la valeur du login
        $log = $bene->__get("login");

        // on v�rifie que cette valeur correspond � la nouvelle valeur donn�e
        self::assertEquals("testMethod__set2", $log);
    }

    /**
     * Tests ModelBenevole::readAllOrga()
     */
    public function testReadAllOrga()
    {
        // on r�cup�re tous les organisateurs d'un festival avec la fonction
        $bene = new ModelBenevole();
        $allOrga = $bene->readAllOrga(1);

        // on r�cup�re tous les organisateur d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.isOrganisateur = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();

        // On vérifie que les deux tableaux soient les mêmes
        self::assertEquals($tab, $allOrga);
    }

    /**
     * Tests ModelBenevole::readAllBene()
     */
    public function testReadAllBene()
    {
        // on r�cup�re tous les b�n�voles d'un festival avec la fonction
        $allBene = ModelBenevole::readAllBene(2);

        // on r�cup�re tous les b�n�voles d'un festival "� la main"
        $rep = Model::$pdo->query("SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 2 AND l.valide = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();

        // On vérifie que les deux tableaux soient les mêmes
        self::assertEquals($tab, $allBene);
    }

    /**
     * Tests ModelBenevole::readAllDemandes()
     */
    public function testReadAllDemandes()
    {
        // on r�cup�re toutes les demandes de b�n�volat avec la fonction
        $allDemandes = ModelBenevole::readAllDemandes(1);

        // on r�cup�re toutes les demandes de b�n�volat "� la main"
        $rep = Model::$pdo->query("SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b.email, b.numTelephone, b.nonce FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 1 AND l.valide = 0;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();

        // On vérifie que les deux tableaux soient les mêmes
        self::assertEquals($tab, $allDemandes);
    }

    /**
     * Tests ModelBenevole::isPref()
     */
    public function testIsPref()
    {
        // on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste avec la fonction
        $pref = ModelBenevole::isPref(1, 46);

        // on r�cup�re la valeur d'une pr�f�rence d'un b�n�vole pour un poste "� la main"
        $rep = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDBenevole = 1 AND IDPoste = 46;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();
        if (empty($tab)) {
            $test = 0;
        } else {
            $test = 1;
        }

        // on v�rifie que les deux valeurs soient les m�mes
        self::assertEquals($pref, $test);
    }

    /**
     * Tests ModelBenevole::readAllDemandesOrga()
     */
    public function testReadAllDemandesOrga()
    {
        // on r�cup�re toutes les demandes d'organisation de b�n�voles avec la fonction
        $bene = new ModelBenevole();
        $allDemandesOrga = $bene->readAllDemandesOrga(63);

        // on r�cup�re toutes les demandes d'organisation de b�n�voles "� la main"
        $rep = Model::$pdo->query("SELECT b.IDBenevole, b.login, b.password, b.nom, b.prenom, b.dateNaiss, b. email, b.numTelephone, b.nonce FROM Benevole b JOIN link_BenevoleParticipeFestival l ON b.IDBenevole = l.IDBenevole WHERE l.IDFestival = 63 AND l.candidat = 1;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();

        // On vérifie que les deux tableaux soient les mêmes
        self::assertEquals($tab, $allDemandesOrga);
    }

    /**
     * Tests ModelBenevole::checkPassword()
     */
    public function testCheckPassword()
    {
        try {

            // on v�rifie si un mot de passe est correct avec la fonction
            $test = ModelBenevole::checkPassword("testMethodCheck", "testMethodCheck");

            // on v�rifie que le mot de passe n'est pas correct
            self::assertFalse($test);

            // on cr�e des variables pour les donn�es "sp�ciales"
            $nonce = Security::generateRandomHex();
            // on ajoute un b�n�vole � la base de donn�es
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodCheck', 'testMethodCheck', 'testMethodCheck', 'testMethodCheck', '01/06/1999', 'testMethodCheck', 'testMethodCheck', '" . $nonce . "');");

            // on v�rifie si un mot de passe est correct avec la fonction
            $test2 = ModelBenevole::checkPassword("testMethodCheck", "testMethodCheck");

            // on v�rifie que le mot de passe est correct
            self::assertTrue($test2);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime le b�n�vole cr�� pour le test
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodCheck';");
        }
    }

    /**
     * Tests ModelBenevole::accept()
     */
    public function testAccept()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodAccept', 'testMethodAccept', 'testMethodAccept', 'testMethodAccept', '01/06/1999', 'testMethodAccept', 'testMethodAccept', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodAccept', 'testMethodAccept', '01/06/1999', '02/06/1999', 'testMethodAccept')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodAccept'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodAccept'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0);");

            // on verifie que l'attribut "valide" est bien a "false"
            $req = Model::$pdo->query("SELECT valide FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $unvalide = $req->fetchAll(PDO::FETCH_OBJ);
            $unvalide = $unvalide[0]->valide;

            // on rend la participation valide avec la fonction
            $bene = new ModelBenevole();
            $bene->accept($idBene, $idFest);

            // on verifie que l'attribut "valide" est bien passe a "true"
            $req = Model::$pdo->query("SELECT valide FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $valide = $req->fetchAll(PDO::FETCH_OBJ);
            $valide = $valide[0]->valide;

            self::assertEquals(0, $unvalide);
            self::assertEquals(1, $valide);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodAccept'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodAccept'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::promote()
     */
    public function testPromote()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodPromote', 'testMethodPromote', 'testMethodPromote', 'testMethodPromote', '01/06/1999', 'testMethodPromote', 'testMethodPromote', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodPromote', 'testMethodPromote', '01/06/1999', '02/06/1999', 'testMethodPromote')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodPromote'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodPromote'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on verifie que l'attribut "isOrganisateur" est bien a "false"
            $req = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $unisOrga = $req->fetchAll(PDO::FETCH_OBJ);
            $unisOrga = $unisOrga[0]->isOrganisateur;

            // on donne le rang d'organisateur au benevole avec la fonction
            ModelBenevole::promote($idBene, $idFest);

            // on verifie que l'attribut "isOrganisateur" est bien passe a "true"
            $req = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $isOrga = $req->fetchAll(PDO::FETCH_OBJ);
            $isOrga = $isOrga[0]->isOrganisateur;

            self::assertEquals(0, $unisOrga);
            self::assertEquals(1, $isOrga);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodPromote'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodPromote'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::demote()
     */
    public function testDemote()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodDemote', 'testMethodDemote', 'testMethodDemote', 'testMethodDemote', '01/06/1999', 'testMethodDemote', 'testMethodDemote', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodDemote', 'testMethodDemote', '01/06/1999', '02/06/1999', 'testMethodDemote')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodDemote'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodDemote'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on donne le rang d'organisateur au benevole avec la fonction
            ModelBenevole::promote($idBene, $idFest);

            // on verifie que l'attribut "isOrganisateur" est bien a "true"
            $req = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $isOrga = $req->fetchAll(PDO::FETCH_OBJ);
            $isOrga = $isOrga[0]->isOrganisateur;

            // on enleve le rang d'organisateur au benevole avec la fonction
            ModelBenevole::demote();

            // on verifie que l'attribut "isOrganisateur" est bien passe a "false"
            $req = Model::$pdo->query("SELECT isOrganisateur FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $unisOrga = $req->fetchAll(PDO::FETCH_OBJ);
            $unisOrga = $unisOrga[0]->isOrganisateur;

            self::assertEquals(1, $isOrga);
            self::assertEquals(0, $unisOrga);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodDemote'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodDemote'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::reject()
     */
    public function testReject()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodReject', 'testMethodReject', 'testMethodReject', 'testMethodReject', '01/06/1999', 'testMethodReject', 'testMethodReject', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodReject', 'testMethodReject', '01/06/1999', '02/06/1999', 'testMethodReject')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodReject'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodReject'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on rejette le benevole avec la fonction
            ModelBenevole::reject($idBene, $idFest);

            // on verifie que l'attribut "candidat" est bien passe a "false"
            $req = Model::$pdo->query("SELECT candidat FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            $uniscandidat = $req->fetchAll(PDO::FETCH_OBJ);
            $uniscandidat = $uniscandidat[0]->candidat;

            self::assertEquals(0, $uniscandidat);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodReject'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodReject'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::isParticipant()
     */
    public function testIsParticipant()
    {
        try {
            // On initialise le cookie de session
            $_SESSION = ModelBenevoleTest::$shared_session;

            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsParticip', 'testMethodIsParticipant', 'testMethodIsParticipant', 'testMethodIsParticipant', '01/06/1999', 'testMethodIsParticipant', 'testMethodIsParticipant', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsParticip', 'testMethodIsParticipant', '01/06/1999', '02/06/1999', 'testMethodIsParticipant')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodIsParticip'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsParticip'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // On affecte la valeur au cookie de sessions
            $_SESSION['login'] = $idBene;
            // on verifie que le benevole n'est pas participant avec la fonction
            $unisParticipant = ModelBenevole::isParticipant($idBene, $idFest);

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on verifie que le benevole est participant avec la fonction
            $isParticipant = ModelBenevole::isParticipant($idBene, $idFest);

            self::assertFalse($unisParticipant);
            self::assertTrue($isParticipant);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsParticip'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsParticip'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
            ModelBenevoleTest::$shared_session = $_SESSION;
        }
    }

    /**
     * Tests ModelBenevole::getIDbyLogin()
     */
    public function testGetIDbyLogin()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodGetIdByLogin', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', '01/06/1999', 'testMethodGetIdByLogin', 'testMethodGetIdByLogin', '" . $nonce . "');");

            // on recupere l'id du benevole "a la main"
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodGetIdByLog'");
            $id = $req->fetchAll(PDO::FETCH_OBJ);
            $id = $id[0]->IDBenevole;

            // on recupere l'id du benevole avec la fonction
            $test = ModelBenevole::getIDbyLogin('testMethodGetIdByLog');

            self::assertEquals($id, $test);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodGetIdByLog'");
        }
    }

    /**
     * Tests ModelBenevole::isOrga()
     */
    public function testIsOrga()
    {
        try {

            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsOrga', 'testMethodIsOrga', 'testMethodIsOrga', 'testMethodIsOrga', '01/06/1999', 'testMethodIsOrga', 'testMethodIsOrga', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsOrga', 'testMethodIsOrga', '01/06/1999', '02/06/1999', 'testMethodIsOrga')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodIsOrga'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsOrga'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on verifie que le benevole n'est pas organisateur avec la fonction
            $unisOrga = ModelBenevole::isOrga($idBene, $idFest);

            // on lui donne le rang d'organisateur
            ModelBenevole::promote($idBene, $idFest);

            // on verifie que le benevole n'est pas organisateur avec la fonction
            $isOrga = ModelBenevole;
            isOrga($idBene, $idFest);

            self::assertFalse($unisOrga);
            self::assertTrue($isOrga);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsOrga'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsOrga'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::isValide()
     */
    public function testIsValide()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodIsValide', 'testMethodIsValide', 'testMethodIsValide', 'testMethodIsValide', '01/06/1999', 'testMethodIsValide', 'testMethodIsValide', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodIsValide', 'testMethodIsValide', '01/06/1999', '02/06/1999', 'testMethodIsValide')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole, login FROM Benevole WHERE login = 'testMethodIsValide'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $logBene = $idBene[0]->login;
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodIsValide'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0)");

            // on verifie que le benevole n'est pas valide avec la fonction
            $unisValide = ModelBenevole::isValide($idBene, $idFest);

            // on l'accepte
            ModelBenevole::accept($idBene, $idFest);

            // on verifie que le benevole est bien valide avec la fonction
            $isValide = ModelBenevole::isValide($logBene, $idFest);

            self::assertFalse($unisValide);
            self::assertEquals(1, $isValide);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les ojbets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodIsValide'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodIsValide'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::nonce()
     */
    public function testNonce()
    {
        /**
         * D'apr�s nous, cette fonction r�initialise le nonce.
         * Nous ne savons pas a quoi elle peut servir.
         */
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodNonce', 'testMethodNonce', 'testMethodNonce', 'testMethodNonce', '01/06/1999', 'testMethodNonce', 'testMethodNonce', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodNonce'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;

            // on reinitialise le nonce avec la fonction
            ModelBenevole::nonce($idBene);

            // on recupere la valeur de l'attribut nonce
            $req = Model::$pdo->query("SELECT nonce FROM Benevole WHERE login = 'testMethodNonce'");
            $test = $req->fetchAll(PDO::FETCH_OBJ);
            $test = $test[0]->nonce;

            // on verifie qu'il est "NULL"
            self::assertEquals("", $test);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on sumpprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodNonce'");
        }
    }

    /**
     * Tests ModelBenevole::kick()
     */
    public function testKick()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodKick', 'testMethodKick', 'testMethodKick', 'testMethodKick', '01/06/1999', 'testMethodKick', 'testMethodKick', '" . $nonce . "');");
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodKick', 'testMethodKick', '01/06/1999', '02/06/1999', 'testMethodKick')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodKick'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodKick'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;

            // on fait participer le benevole au festival
            Model::$pdo->query("INSERT INTO link_BenevoleParticipeFestival VALUES (" . $idFest . ", " . $idBene . ", 0, 0, 0);");

            // on verifie qu'il est bien participant
            $isPart = ModelBenevole::isParticipant($idBene, $idFest);

            // on le supprime du festival avec la fonction
            ModelBenevole::kick($idBene, $idFest);

            // on verifie qu'il n'est plus participant
            $unisPart = ModelBenevole::isParticipant($idBene, $idFest);

            self::assertTrue($isPart);
            self::assertFalse($unisPart);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodKick'");
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodKick'");
            Model::$pdo->query("DELETE FROM link_BenevoleParticipeFestival WHERE IDFestival = " . $idFest . " AND IDBenevole = " . $idBene . ";");
        }
    }

    /**
     * Tests ModelBenevole::getLastSaved()
     */
    public function testGetLastSaved()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodGetLastSav', 'testMethodGetLastSaved', 'testMethodGetLastSaved', 'testMethodGetLastSaved', '01/06/1999', 'testMethodGetLastSaved', 'testMethodGetLastSaved', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodGetLastSav'");
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
            $idBene = $req->fetchAll();
            $idBene = $idBene[0];

            $test = ModelBenevole::getLastSaved();

            // on verifie que les id sont bien identiques
            self::assertEquals($idBene, $test);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodGetLastSav'");
        }
    }

    /**
     * Tests ModelBenevole::affecterBenevole()
     */
    public function testAffecterBenevole()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodAffecter', 'testMethodAffecter', 'testMethodAffecter', 'testMethodAffecter', '01/06/1999', 'testMethodAffecter', 'testMethodAffecter', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodAffecter'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;

            $req = Model::$pdo->query("SELECT * FROM link_AffecterCreneauBenevole WHERE idCreneaux = 22 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req->fetchAll();

            self::assertEmpty($tab);

            ModelBenevole::affecterBenevole($idBene, 22);

            $req = Model::$pdo->query("SELECT * FROM link_AffecterCreneauBenevole WHERE idCreneaux = 22 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req->fetchAll();

            self::assertNotEmpty($tab);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodAffecter'");
        }
    }

    /**
     * Tests ModelBenevole::supprimerBenevoleCreneau()
     */
    public function testSupprimerBenevoleCreneau()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodSuppr', 'testMethodSuppr', 'testMethodSuppr', 'testMethodSuppr', '01/06/1999', 'testMethodSuppr', 'testMethodSuppr', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodSuppr'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;

            // on affecte le benevole au creneau
            ModelBenevole::affecterBenevole($idBene, 22);

            // on verifie que l'affectation a bien eu lieu
            $req = Model::$pdo->query("SELECT * FROM link_AffecterCreneauBenevole WHERE idCreneaux = 22 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req->fetchAll();

            self::assertNotEmpty($tab);

            // on supprime le benevole du creneau
            ModelBenevole::supprimerBenevoleCreneau($idBene, 22);

            // on veririfie que l'affectation n'existe plus
            $req = Model::$pdo->query("SELECT * FROM link_AffecterCreneauBenevole WHERE idCreneaux = 22 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_OBJ);
            $tab = $req->fetchAll();

            self::assertEmpty($tab);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodSuppr'");
        }
    }

    /**
     * Tests ModelBenevole::planning()
     */
    public function testPlanning()
    {
        // TODO Auto-generated ModelBenevoleTest::testPlanning()
        $this->markTestIncomplete("planning test not implemented");

        ModelBenevole::planning( /* parameters */);
    }

    /**
     * Tests ModelBenevole::ajouterPref()
     */
    public function testAjouterPref()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodAjoutPref', 'testMethodAjoutPref', 'testMethodAjoutPref', 'testMethodAjoutPref', '01/06/1999', 'testMethodAjoutPref', 'testMethodAjoutPref', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodAjoutPref'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;

            // on verifie que l'affectation a bien eu lieu
            $req = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDPoste = 46 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
            $tab = $req->fetchAll();

            self::assertEmpty($tab);

            ModelBenevole::ajouterPref($idBene, 46);

            // on verifie que l'affectation a bien eu lieu
            $req = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDPoste = 46 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
            $tab = $req->fetchAll();

            self::assertNotEmpty($tab);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodAjoutPref'");
        }
    }

    /**
     * Tests ModelBenevole::retirerPref()
     */
    public function testRetirerPref()
    {
        try {
            // on cree des variables pour les donnees "speciales"
            $nonce = Security::generateRandomHex();

            // on ajoute un benevole
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodRetirer', 'testMethodRetirer', 'testMethodRetirer', 'testMethodRetirer', '01/06/1999', 'testMethodRetirer', 'testMethodRetirer', '" . $nonce . "');");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodRetirer'");
            $idBene = $req->fetchAll(PDO::FETCH_OBJ);
            $idBene = $idBene[0]->IDBenevole;

            // on ajoute une preference au benevole
            ModelBenevole::ajouterPref($idBene, 46);

            // on verifie que l'affectation a bien eu lieu
            $req = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDPoste = 46 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
            $tab = $req->fetchAll();

            self::assertNotEmpty($tab);

            ModelBenevole::retirerPref($idBene, 46);

            // on verifie que l'affectation a bien ete retiree
            $req = Model::$pdo->query("SELECT * FROM link_PreferenceBenevolePostes WHERE IDPoste = 46 AND idBenevole = " . $idBene . "");
            $req->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
            $tab = $req->fetchAll();

            self::assertEmpty($tab);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodRetirer'");
        }
    }

    /**
     * Tests ModelBenevole::readPostesPref()
     */
    public function testReadPostesPref()
    {
        $postesPref = ModelBenevole::readPostesPref(1);

        $rep = Model::$pdo->query("SELECT p.IDPoste, p.nomPoste
				FROM link_PreferenceBenevolePostes lpbp
				JOIN Poste p ON lpbp.IDPoste = p.IDPoste
				WHERE lpbp.IDBenevole = 1");

        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
        $tab = $rep->fetchAll();

        if (empty($tab)) {
            $tab = false;
        }

        self::assertEquals($tab, $postesPref);
    }
}
<?php
use PHPUnit\Framework\TestCase;

include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/ModelPoste.php';

/**
 * ModelPoste test case.
 */
class ModelPostesTest extends TestCase
{

    /**
     * Tests ModelPoste->__get()
     */
    public function test__get()
    {

        // on cree un poste
        $this->modelPoste = new ModelPoste(456, "testMethod__get");

        // on recupere la valeur du nom
        $nom = $this->modelPoste->__get("nomPoste");

        // on verifie qu'elle est bien egale a celle donnee
        self::assertEquals("testMethod__get", $nom);
    }

    /**
     * Tests ModelPoste->__set()
     */
    public function test__set()
    {
        // on cree les valeurs a doner au poste
        $data = array(
            "IDPoste" => null,
            "nmoPoste" => "testMethod__set"
        );

        // on cree un poste
        $this->modelPoste = new ModelPoste($data);

        // on modifie la valeur du nom du poste
        $this->modelPoste->__set("nomPoste", "testMethod__set2");

        // on recupere la valeur du nom du poste
        $nom = $this->modelPoste->__get("nomPoste");

        // on verifie qu'elle est bien egale a la nouvelle valeur
        self::assertEquals("testMethod__set2", $nom);
    }

    /**
     * Tests ModelPoste::getPostebyFestival()
     */
    public function testGetPostebyFestival()
    {
        // on selectionne tous les poste "a la main"
        $rep = Model::$pdo->query("SELECT DISTINCT p.IDPoste, p.nomPoste FROM Poste p JOIN link_PostesParFestival l ON p.IDPoste=l.IDPoste WHERE l.IDFestival = 2");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelPoste');
        $tab = $rep->fetchAll();

        // on selectionne tous les postes avec la fonction
        $allPoste = ModelPoste::getPostebyFestival("2");

        self::assertEquals(sizeOf($tab), sizeOf($allPoste));

        // on verifie que tous les elements des deux tableaux sont les memes
        for ($i = 0; $i < sizeof($allPoste); $i ++) {
            self::assertEquals($allPoste[$i], $tab[$i]);
        }
    }

    /**
     * Tests ModelPoste::savePoste()
     */
    public function testSavePoste()
    {
        try {
            // on cree un festival et un poste
            Model::$pdo->query("INSERT INTO Festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodSavePoste', 'testMethodSavePoste', '01/06/1999', '02/06/1999', 'testMethodSavePoste')");
            Model::$pdo->query("INSERT INTO Poste (nomPoste) VALUES ('testMethodSavePoste')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDFestival FROM Festival WHERE nomFestival = 'testMethodSavePoste'");
            $idFest = $req->fetchAll(PDO::FETCH_OBJ);
            $idFest = $idFest[0]->IDFestival;
            $req = Model::$pdo->query("SELECT IDPoste FROM Poste WHERE nomPoste = 'testMethodSavePoste'");
            $idPoste = $req->fetchAll(PDO::FETCH_OBJ);
            $idPoste = $idPoste[0]->IDPoste;

            // on verifie que le poste n'apparait pas pour ce festival
            $req = Model::$pdo->query("SELECT * FROM link_PostesParFestival WHERE IDFestival = '" . $idFest . "' AND IDPoste = '" . $idPoste . "'");
            $test = $req->fetchAll(PDO::FETCH_OBJ);
            self::assertTrue(empty($test));

            // on attribue le poste au festival
            ModelPoste::savePoste($idFest, $idPoste);

            // on verifie que le poste existe pour ce festival
            $req = Model::$pdo->query("SELECT IDPoste FROM link_PostesParFestival WHERE IDFestival = '" . $idFest . "' AND IDPoste = '" . $idPoste . "'");
            $test = $req->fetchAll(PDO::FETCH_OBJ);
            $test = $test[0]->IDPoste;
            self::assertEquals($test, $idPoste);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Festival WHERE nomFestival = 'testMethodSavePoste'");
            Model::$pdo->query("DELETE FROM Poste WHERE nomPoste = 'testMethodSavePoste'");
        }
    }

    /**
     * Tests ModelPoste::dernierPosteSave()
     */
    public function testDernierPosteSave()
    {
        try {
            // on cree un festival et un poste
            Model::$pdo->query("INSERT INTO Poste (nomPoste) VALUES ('testMethodPoste')");

            // on recupere les id des deux objets crees
            $req = Model::$pdo->query("SELECT IDPoste FROM Poste WHERE nomPoste = 'testMethodPoste'");
            $idPoste = $req->fetchAll(PDO::FETCH_OBJ);
            $idPoste = $idPoste[0]->IDPoste;

            $last = ModelPoste::dernierPosteSave();

            self::assertEquals($idPoste, $last->IDPoste);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime les objets crees
            Model::$pdo->query("DELETE FROM Poste WHERE nomPoste = 'testMethodPoste'");
        }
    }
}


<?php
use PHPUnit\Framework\TestCase;
include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/ModelBenevole.php';
/**
 * ModelPoste test case.
 */
class ModelPosteTest extends TestCase{

    /**
     * Tests ModelPoste->__get()
     */
    public function test__get() {
        $data = array(
            "IDPoste" => null,
            "nomPoste" => "testMethod__get",
        );
        
        //on cree un poste
        $this->modelPoste = new ModelPoste($data);
        
        //on recupere la valeur du nom
        $nom = $this->modelPoste->__get("nomPoste");
        
        //on verifie qu'elle est bien egale a celle donnee
        $this->assertEquald("testMethod__get", $nom);
    }

    /**
     * Tests ModelPoste->__set()
     */
    public function test__set() {
        //on cree les valeurs a doner au poste
        $data = array(
            "IDPoste" => null,
            "nmoPoste" => "testMethod__set",
        );
        
        //on cree un poste
        $this->modelPoste = new ModelPoste($data);
        
        //on modifie la valeur du nom du poste
        $this->modelPoste->__set("nomPoste", "testMethod__set2");
        
        //on recupere la valeur du nom du poste
        $nom = $this->modelPoste->__get("nomPoste");
        
        //on verifie qu'elle est bien egale a la nouvelle valeur
        $this->assertEquals("testMethod__set2", $nom);
    }

    /**
     * Tests ModelPoste::getPostebyFestival()
     */
    public function testGetPostebyFestival() {
        //on selectionne tous les poste "a la main"
        $rep = Model::$pdo->query("SELECT DISTINCT * FROM poste p JOIN link_PostesParFestival l ON p.IDPoste l.IDPoste WHERE l.IDFestival = 2");
        $rep->setFetchMode(PDO::FETCH_CLASS, Poste);
        $rep->fetchAll();
        
        //on selectionne tous les postes avec la fonction
        $poste = new ModelPoste();
        $allPoste = $this->poste->getPostebyFestival("2");
        
        $this->assertEquals(sizeOf($rep), sizeOf($allPoste));
        
        //on verifie que tous les elements des deux tableaux sont les memes
        for ($i = 0; $i < $allPoste; $i++) {
            $this->assertEquals($allPoste[$i], $rep[$i]);
        }
    }

    /**
     * Tests ModelPoste::savePoste()
     */
    public function testSavePoste() {
        //on cree un festival et un poste
        Model::$pdo->query("INSERT INTO festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodSavePoste', 'testMethodSavePoste', '01/06/1999', '02/06/1999', 'testMethodSavePoste')");
        Model::$pdo->query("INSERT INTO poste (nomPoste) VALUES ('testMethodSavePoste')");
        
        //on recupere les id des deux objets crees
        $idFest = Model::$pdo->query("SELECT IDFestival FROM festival WHERE nomFestival = 'testMethodSavePoste'");
        $idPoste = Model::$pdo->query("SELECT IDPoste FROM poste WHERE nomPoste = 'testMethodSavePoste'");
       
        //on verifie que le poste n'apparait pas pour ce festival
        $test = Model::$pdo->query("SELECT * FROM link_PostesParFestival WHERE IDFestival = '". $idFest ."' AND IDPoste = '". $idPoste ."'");
        $this->assertTrue(isEmpty($test));
        
        //on attribue le poste au festival
        $poste = new ModelPoste();
        $this->poste->savePoste($idFest, $idPoste);
        
        //on verifie que le poste existe pour ce festival
        $test = Model::$pdo->query("SELECT IDPoste FROM link_PostesParFestival WHERE IDFestival = '". $idFest ."' AND IDPoste = '". $idPoste ."'");
        $this->assertEquals($test, $idPoste);
        
        //on supprime les objets crees
        Model::$pdo->query("DELETE FROM festival WHERE nomFestival = 'testMethodSavePoste'");
        Model::$pdo->query("DELETE FROM poste WHERE nomPoste = 'testMethodSavePoste'");
    }

    /**
     * Tests ModelPoste::dernierPosteSave()
     */
    public function testDernierPosteSave() {
        //on cree un festival et un poste
        Model::$pdo->query("INSERT INTO festival (nomFestival, lieuFestival, dateDebutF, dateFinF, description) VALUES ('testMethodDernierPosteSave', 'testMethodDernierPosteSave', '01/06/1999', '02/06/1999', 'testMethodDernierPosteSave')");
        Model::$pdo->query("INSERT INTO poste (nomPoste) VALUES ('testMethodDernierPosteSave')");
        
        //on recupere les id des deux objets crees
        $idFest = Model::$pdo->query("SELECT IDFestival FROM festival WHERE nomFestival = 'testMethodDernierPosteSave'");
        $idPoste = Model::$pdo->query("SELECT IDPoste FROM poste WHERE nomPoste = 'testMethodDernierPosteSave'");
        
        //on attribue le poste au festival
        $poste = new ModelPoste();
        $this->poste->savePoste($idFest, $idPoste);
        
        $test = Model::$pdo->query("SELECT * FROM poste WHERE nomPoste = 'testMethodDernierPosteSave'");
        
        $last = $this->poste->dernierPosteSave();
        
        $this->assertEquals($test, $last);      
    }
}


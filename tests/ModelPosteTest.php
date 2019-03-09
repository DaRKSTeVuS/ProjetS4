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
    public function testSavePoste()
    {
        // TODO Auto-generated ModelPosteTest::testSavePoste()
        $this->markTestIncomplete("savePoste test not implemented");

        ModelPoste::savePoste(/* parameters */);
    }

    /**
     * Tests ModelPoste::dernierPosteSave()
     */
    public function testDernierPosteSave()
    {
        // TODO Auto-generated ModelPosteTest::testDernierPosteSave()
        $this->markTestIncomplete("dernierPosteSave test not implemented");

        ModelPoste::dernierPosteSave(/* parameters */);
    }
}


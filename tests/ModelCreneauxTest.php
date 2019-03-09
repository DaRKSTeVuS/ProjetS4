<?php
use PHPUnit\Framework\TestCase;
include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/ModelBenevole.php';

/**
 * ModelCreneaux test case.
 */
class ModelCreneauxTest extends TestCase{

    /**
     * Tests ModelCreneaux->__get()
     */
    public function test__get() {
        //on cree les valeurs a donner au creneau
        $data = array(
            "IDCreneau" => null,
            "debutCreneau" => "01/06/1999",
            "heureDebutCreneau" => "08:00:00",
            "heureFinCreneau" => "09:00:00",
            "nbBenevoles" => "8",
        );
        
        //on cree un creneau
        $this->modelCreneau = new ModelCreneaux($data);
        
        //on recupere la valeur du nombre de benevoles
        $nb = $this->modelBenevole->__get("nbBenevoles");
        
        //on verifie qu'ele est bien egale a celle donnee
        $this->assertEquals(8, $nb);
    }

    /**
     * Tests ModelCreneaux->__set()
     */
    public function test__set() {
        //on cree les valeurs a donner au creneau
        $data = array(
            "IDCreneau" => null,
            "debutCreneau" => "01/06/1999",
            "heureDebutCreneau" => "08:00:00",
            "heureFinCreneau" => "09:00:00",
            "nbBenevoles" => "8",
        );
        
        //on cree un creneau
        $this->modelCreneau = new ModelCreneaux($data);
        
        //on modifie la valeur du nombre de benevoles avec la fonction
        $this->modelBenevole->__set("nbBenevoles", 9);
        
        //on recupere la valeur du nombre de benevoles
        $nb = $this->modelBenevole->__get("nbBenevoles");
        
        //on verifie qu'elle est bien egale a la nouvelle valeur
        $this->assertEquals(9, $nb);
    }

    /**
     * Tests ModelCreneaux::selectAllCren()
     */
    public function testSelectAllCren() {
        //on selectionne tous les creneaux avec la fonction
        $cren = new ModelCreneaux();
        $allCren = $this->cren->selectAllCren(74, 22);
        
        //on selectionne tous les creneaux "a la main"
        $rep = Model::$pdo->query("SELECT * FROM Creneaux c JOIN link_PostesParFestival l ON c.IDPoste = l.IDPostee WHERE c.IDPoste = 74 AND l.IDFestival = 22;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Creneaux);
        $rep->fetchAll();
        
        $this->assertEquals(sizeOf($rep), sifeOf($allCren));
        
        //on verifie que tous les elements des deux tableaux sont les memes
        for ($i = 0; $i < $allCren; $i++) {
            $this->assertEquals($allCren[$i], $rep[$i]);
        }
    }
}


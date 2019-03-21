<?php
use PHPUnit\Framework\TestCase;

include '../src/lib/File.php';
include '../src/lib/Security.php';
include '../src/model/Model.php';
include '../src/model/ModelCreneaux.php';

/**
 * ModelCreneaux test case.
 */
class ModelCreneauxTest extends TestCase
{

    /**
     * Tests ModelCreneaux->__get()
     */
    public function test__get()
    {
        // on cree les valeurs a donner au creneau
        $data = array(
            "IDCreneau" => null,
            "debutCreneau" => "01/06/1999",
            "heureDebutCreneau" => "08:00:00",
            "heureFinCreneau" => "09:00:00",
            "nbBenevoles" => "8"
        );

        // on cree un creneau
        $modelCreneau = new ModelCreneaux($data);

        // on recupere la valeur du nombre de benevoles
        $nb = $modelCreneau->__get("nbBenevoles");

        // on verifie qu'ele est bien egale a celle donnee
        self::assertEquals(8, $nb);
    }

    /**
     * Tests ModelCreneaux->__set()
     */
    public function test__set()
    {
        // on cree les valeurs a donner au creneau
        $data = array(
            "IDCreneau" => null,
            "debutCreneau" => "01/06/1999",
            "heureDebutCreneau" => "08:00:00",
            "heureFinCreneau" => "09:00:00",
            "nbBenevoles" => "8"
        );

        // on cree un creneau
        $modelCreneau = new ModelCreneaux($data);

        // on modifie la valeur du nombre de benevoles avec la fonction
        $modelCreneau->__set("nbBenevoles", 9);

        // on recupere la valeur du nombre de benevoles
        $nb = $modelCreneau->__get("nbBenevoles");

        // on verifie qu'elle est bien egale a la nouvelle valeur
        self::assertEquals(9, $nb);
    }

    /**
     * Tests ModelCreneaux::selectAllCren()
     */
    public function testSelectAllCren()
    {
        // on selectionne tous les creneaux avec la fonction
        $cren = new ModelCreneaux();
        $allCren = $cren->selectAllCren(74, 39);

        // on selectionne tous les creneaux "a la main"
        $rep = Model::$pdo->query("SELECT * FROM Creneaux c JOIN link_PostesParFestival l ON c.IDPoste = l.IDPoste WHERE c.IDPoste = 74 AND l.IDFestival = 39;");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelDisponibilites');
        $tab = $rep->fetchAll();

        $this->assertEquals(sizeof($tab), sizeof($allCren));

        // on verifie que tous les elements des deux tableaux sont les memes
        for ($i = 0; $i < sizeof($allCren); $i ++) {
            self::assertEquals($allCren[$i], $tab[$i]);
        }
    }
}


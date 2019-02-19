<?php
use PHPUnit\Framework\TestSuite;

require_once '../src/model/Model.php';

/**
 * Model test case.
 */
class ModelTest extends TestSuite {
    
    private $model;

    
    protected function setUp() {
        parent::setUp();
        $this->model = new Model();
    }

    protected function tearDown() {
        $this->model = null;
        parent::tearDown();
    }

    /**
     * Tests Model::init()
     */
    public function testInit() {

    }

    /**
     * Tests Model::select()
     */
    public function testSelect() {
        //on crée des variables pour les données "spéciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on insère les données que l'on va sélectionner
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, " . $nonce . ");");
        
        //on sélectionne l'id correspondant aux données que l'on va sélectionner
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodSelect;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on sélectionne les données insérées avec la fonction
        $test = $this->model->select($rep);
        
        //on vérifie que les données existent dans la base de données
        $this->assertNotEmpty($rep);
        
        //on sélectionne "à la main" les données insérées
        $rep2 = Model::$pdo->query("SELECT * FROM Benevole WHERE login = testMethodSelect;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();
        
        //on supprime le bénévole créé pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodSelect;");
        
        
        //on vérifie que les valeurs des données sélectionnées sont les mêmes
        $this->assertEquals($rep2, $test);
    }

    public function testSelectAll() {
        //on sélectionne tous les bénévoles avec la fonction
        $tab = $this->model->selectAll();
        
        //on sélectionne tous les bénévoles "à la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole");
        $rep->setFetchMode(PDO::FETCH_CLASS, ModelBenevole);
        $rep->fetchAll();
        
        //on vérifie que les tailles des deux tableaux retournés sont égales
        $this->assertEquals(sizeof($tab), siezof($rep));
        
        //pour chaque élément, on vérifie qu'ils soient les mêmes
        for ($i = 0; $i < sizeOf($tab); $i++) {
            $this->assertEquals($rep[$i], $tab[$i]);
        }
    }

    /**
     * Tests Model::save()
     */
    public function testSave() {
        //on crée un tableau de données
        $values = array (
            "IDBenevole" => null,
            "login" => testMethodSave,
            "password" => testMethodSave,
            "nom" => testMethodSave,
            "prenom" => testMethodSave,
            "dateNaiss" => testMethodSave,
            "email" => testMethodSave,
            "numTelephone" => testMethodSave,
            "nonce" => Security::generateRandomHex()
        );
        
        //on enregistre les données avec la fonction
        $this->model->save($values);
        
        //on sélectionne l'élément correspondant aux données spécifiées
        $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = 'testMethodSave';");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime le bénévole créé pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodSave;");
        
        //on vérifie que l'élément a bien été enregistré
        $this->assertNotEmpty($rep);
        
        //on vérifie que l'élément existe dans la base de données
        $this->assertEquals($rep, "testMethodSave");
    }

    /**
     * Tests Model::delete()
     */
    public function testDelete() {
        //on crée des variables pour les données "spéciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on insère les données que l'on va supprimer
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, " . $nonce . ");");
        
        //on sélectionne l'id correspondant aux données que l'on va supprimer
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime les données insérées
        $this->model->delete($rep);
        
        //on sélectionne les données que l'on a supprimé
        $rep2 = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();

        //on supprime le bénévole créé pour le test (si celui-ci n'a pas été supprimé par la fonction)
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodDelete;");
        
        
        //on vérifie que les données ne sont plus dans la base de données
        $this->assertEmpty($rep2);
    }

    /**
     * Tests Model::update()
     */
    public function testUpdate() {
        //on crée des variables pour les données "spéciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on insère les données que l'on va modifier
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodUpdate, testMethodUpdate, testMethodUpdate, testMethodUpdate, testMethodUpdate, testMethodUpdate, testMethodUpdate, " . $nonce . ");");
        
        //on sélectionne l'id correspondant aux données que l'on va modifier
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on crée un tableau de nouvelles valeurs 
        $values = array (
            "IDBenevole" => null,
            "login" => testMethodUpdateToDate,
            "password" => testMethodUpdateToDate,
            "nom" => testMethodUpdateToDate,
            "prenom" => testMethodUpdateToDate,
            "dateNaiss" => testMethodUpdateToDate,
            "email" => testMethodUpdateToDate,
            "numTelephone" => testMethodUpdateToDate,
            "nonce" => Security::generateRandomHex()
        );
        
        //on met à jour les données avec la méthode
        $this->model->update($rep, $values);
        
        //on sélectionne les données ayant les anciennes valeurs
        $rep2 = Model::$pdo->query("SELECT login FROM Benevole WHERE login = testMethodUpdate;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();
        
        //on vérifie que les données avec les anciennes valeurs n'existent plus dans la base de données
        $this->assertEmpty($rep2);
        
        //on sélectionne les données ayant les nouvelles valeurs
        $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = testMethodUpdateToDate;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime le bénévole créé pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodUpdate;");
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodUpdateToDate;");
        
        
        
        //on vérifie que les données avec les nouvelles valeurs existent dans la base de données 
        $this->assertEquals($rep, "testMethodUpdateToDate");
    }
}
?>

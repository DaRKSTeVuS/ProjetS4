<?php
use PHPUnit\Framework\TestCase;
include '../src/lib/Security.php';
include '../src/lib/File.php';
include '../src/model/Model.php';
include '../src/model/ModelBenevole.php';


/**
 * Model test case.
 */
class ModelTest extends TestCase {
    
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
     * Tests Model::select()
     */
    public function testSelect() {
        //on cr�e des variables pour les donn�es "sp�ciales"
        $nonce = Security::generateRandomHex();
        $id = null;

        //on ins�re les donn�es que l'on va s�lectionner
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, testMethodSelect, " . $nonce . ");");
        
        //on s�lectionne l'id correspondant aux donn�es que l'on va s�lectionner
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodSelect;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on s�lectionne les donn�es ins�r�es avec la fonction
        $test = $this->model->select($rep);
        
        //on v�rifie que les donn�es existent dans la base de donn�es
        $this->assertNotEmpty($rep);
        
        //on s�lectionne "� la main" les donn�es ins�r�es
        $rep2 = Model::$pdo->query("SELECT * FROM Benevole WHERE login = testMethodSelect;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();
        
        //on supprime le b�n�vole cr�� pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodSelect;");
        
        
        //on v�rifie que les valeurs des donn�es s�lectionn�es sont les m�mes
        $this->assertEquals($rep2, $test);
    }

    public function testSelectAll() {
        //on s�lectionne tous les b�n�voles avec la fonction
        $bene = new ModelBenevole();
        $tab = $this->bene->selectAll();
        
        //on s�lectionne tous les b�n�voles "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole");
        $rep->setFetchMode(PDO::FETCH_CLASS, ModelBenevole);
        $rep->fetchAll();
        
        //on v�rifie que les tailles des deux tableaux retourn�s sont �gales
        $this->assertEquals(sizeof($tab), siezof($rep));
        
        //pour chaque �l�ment, on v�rifie qu'ils soient les m�mes
        for ($i = 0; $i < sizeOf($tab); $i++) {
            $this->assertEquals($rep[$i], $tab[$i]);
        }
    }

    /**
     * Tests Model::save()
     */
    public function testSave() {
        //on cr�e un tableau de donn�es
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
        
        //on enregistre les donn�es avec la fonction
        $this->model->save($values);
        
        //on s�lectionne l'�l�ment correspondant aux donn�es sp�cifi�es
        $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = 'testMethodSave';");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime le b�n�vole cr�� pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodSave;");
        
        //on v�rifie que l'�l�ment a bien �t� enregistr�
        $this->assertNotEmpty($rep);
        
        //on v�rifie que l'�l�ment existe dans la base de donn�es
        $this->assertEquals($rep, "testMethodSave");
    }

    /**
     * Tests Model::delete()
     */
    public function testDelete() {
        //on cr�e des variables pour les donn�es "sp�ciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on ins�re les donn�es que l'on va supprimer
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, testMethodDelete, " . $nonce . ");");
        
        //on s�lectionne l'id correspondant aux donn�es que l'on va supprimer
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime les donn�es ins�r�es
        $this->model->delete($rep);
        
        //on s�lectionne les donn�es que l'on a supprim�
        $rep2 = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();

        //on supprime le b�n�vole cr�� pour le test (si celui-ci n'a pas �t� supprim� par la fonction)
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodDelete;");
        
        
        //on v�rifie que les donn�es ne sont plus dans la base de donn�es
        $this->assertEmpty($rep2);
    }

    /**
     * Tests Model::update()
     */
    public function testUpdate() {
        //on cr�e des variables pour les donn�es "sp�ciales"
        $nonce = Security::generateRandomHex();
        $id = null;
        
        //on ins�re les donn�es que l'on va modifier
        Model::$pdo->query("INSERT INTO Benevole(IDBenevole, login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES (". $id .", testMethodUpdate, testMethodUpdate, testMethodUpdate, testMethodUpdate, 03/02/2019, testMethodUpdate, testMethodUpdate, $nonce );");
        
        //on s�lectionne l'id correspondant aux donn�es que l'on va modifier
        $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = testMethodDelete;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on cr�e un tableau de nouvelles valeurs 
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
        
        //on met � jour les donn�es avec la m�thode
        $this->model->update($rep, $values);
        
        //on s�lectionne les donn�es ayant les anciennes valeurs
        $rep2 = Model::$pdo->query("SELECT login FROM Benevole WHERE login = testMethodUpdate;");
        $rep2->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep2->fetchAll();
        
        //on v�rifie que les donn�es avec les anciennes valeurs n'existent plus dans la base de donn�es
        $this->assertEmpty($rep2);
        
        //on s�lectionne les donn�es ayant les nouvelles valeurs
        $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = testMethodUpdateToDate;");
        $rep->setFetchMode(PDO::FETCH_CLASS, Benevole);
        $rep->fetchAll();
        
        //on supprime le b�n�vole cr�� pour le test
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodUpdate;");
        Model::$pdo->query("DELETE FROM Benevole WHERE login = testMethodUpdateToDate;");
        
        
        
        //on v�rifie que les donn�es avec les nouvelles valeurs existent dans la base de donn�es 
        $this->assertEquals($rep, "testMethodUpdateToDate");
    }
}
?>

<?php
use PHPUnit\Framework\TestCase;

include '../src/lib/Security.php';
include '../src/lib/File.php';
include '../src/model/Model.php';
include '../src/model/ModelBenevole.php';

/**
 * Model test case.
 */
class ModelTest extends TestCase
{

    private $model;

    /**
     * Tests Model::select()
     */
    public function testSelect()
    {
        try {
            // on cr�e des variables pour les donn�es "sp�ciales"
            $nonce = Security::generateRandomHex();

            // on ins�re les donn�es que l'on va s�lectionner
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodSelect', 'testMethodSelect', 'testMethodSelect', 'testMethodSelect', '05/05/1999', 'testMethodSelect', 'testMethodSelect', '" . $nonce . "');");

            // on s�lectionne l'id correspondant aux donn�es que l'on va s�lectionner
            $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodSelect';");
            $id = $rep->fetchAll(PDO::FETCH_OBJ);
            $id = $id[0]->IDBenevole;

            // on s�lectionne les donn�es ins�r�es avec la fonction
            $test = ModelBenevole::select($id);

            // on v�rifie que les donn�es existent dans la base de donn�es
            self::assertNotEmpty($test);

            // on s�lectionne "� la main" les donn�es ins�r�es
            $rep = Model::$pdo->query("SELECT * FROM Benevole WHERE login = 'testMethodSelect';");
            $rep->setFetchMode(PDO::FETCH_CLASS, "ModelBenevole");
            $tab = $rep->fetchAll();

            // on v�rifie que les valeurs des donn�es s�lectionn�es sont les m�mes
            self::assertEquals($tab[0], $test);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime le b�n�vole cr�� pour le test
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodSelect';");
        }
    }

    public function testSelectAll()
    {
        // on s�lectionne tous les b�n�voles avec la fonction
        $all = ModelBenevole::selectAll();

        // on s�lectionne tous les b�n�voles "� la main"
        $rep = Model::$pdo->query("SELECT * FROM Benevole");
        $rep->setFetchMode(PDO::FETCH_CLASS, 'ModelBenevole');
        $tab = $rep->fetchAll();

        // on v�rifie que les tailles des deux tableaux retourn�s sont �gales
        self::assertEquals(sizeof($all), sizeof($tab));

        // pour chaque �l�ment, on v�rifie qu'ils soient les m�mes
        for ($i = 0; $i < sizeOf($tab); $i ++) {
            self::assertEquals($all[$i], $tab[$i]);
        }
    }

    /**
     * Tests Model::save()
     */
    public function testSave()
    {
        try {
            // on cr�e un tableau de donn�es
            $values = array(
                "IDBenevole" => null,
                "login" => "testMethodSave",
                "password" => "testMethodSave",
                "nom" => "testMethodSave",
                "prenom" => "testMethodSave",
                "dateNaiss" => "testMethodSave",
                "email" => "testMethodSave",
                "numTelephone" => "testMethodSave",
                "nonce" => Security::generateRandomHex()
            );

            // on enregistre les donn�es avec la fonction
            ModelBenevole::save($values);

            // on s�lectionne l'�l�ment correspondant aux donn�es sp�cifi�es
            $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = 'testMethodSave';");
            $log = $rep->fetchAll(PDO::FETCH_OBJ);

            // on v�rifie que l'�l�ment a bien �t� enregistr�
            self::assertNotEmpty($log);

            // on v�rifie que l'�l�ment existe dans la base de donn�es
            self::assertEquals($log[0]->login, "testMethodSave");
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime le b�n�vole cr�� pour le test
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodSave';");
        }
    }

    /**
     * Tests Model::delete()
     */
    public function testDelete()
    {
        try {
            // on cr�e des variables pour les donn�es "sp�ciales"
            $nonce = Security::generateRandomHex();

            // on ins�re les donn�es que l'on va supprimer
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodDelete', 'testMethodDelete', 'testMethodDelete', 'testMethodDelete', '01/06/1999', 'testMethodDelete', 'testMethodDelete', '" . $nonce . "');");

            // on s�lectionne l'id correspondant aux donn�es que l'on va supprimer
            $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodDelete';");
            $id = $rep->fetchAll(PDO::FETCH_OBJ);
            $id = $id[0]->IDBenevole;

            // on supprime les donn�es ins�r�es
            ModelBenevole::delete($id);

            // on s�lectionne les donn�es que l'on a supprim�
            $rep2 = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodDelete';");
            $id2 = $rep2->fetchAll(PDO::FETCH_OBJ);

            // on v�rifie que les donn�es ne sont plus dans la base de donn�es
            self::assertEmpty($id2);
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime le b�n�vole cr�� pour le test (si celui-ci n'a pas �t� supprim� par la fonction)
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodDelete';");
        }
    }

    /**
     * Tests Model::update()
     */
    public function testUpdate()
    {
        try {
            // on cr�e des variables pour les donn�es "sp�ciales"
            $nonce = Security::generateRandomHex();

            // on ins�re les donn�es que l'on va modifier
            Model::$pdo->query("INSERT INTO Benevole(login, password, nom, prenom, dateNaiss, email, numTelephone, nonce) VALUES ('testMethodUpdate', 'testMethodUpdate', 'testMethodUpdate', 'testMethodUpdate', '03/02/2019', 'testMethodUpdate', 'testMethodUpdate', '" . $nonce . "');");

            // on s�lectionne l'id correspondant aux donn�es que l'on va modifier
            $rep = Model::$pdo->query("SELECT IDBenevole FROM Benevole WHERE login = 'testMethodUpdate';");
            $id = $rep->fetchAll(PDO::FETCH_OBJ);
            $id = $id[0]->IDBenevole;

            // on cr�e un tableau de nouvelles valeurs
            $values = array(
                // "IDBenevole" => null,
                "login" => "testMethodUpdateToDa",
                "password" => "testMethodUpdateToDa",
                "nom" => "testMethodUpdateToDa",
                "prenom" => "testMethodUpdateToDa",
                "dateNaiss" => "testMethodUpdateToDa",
                "email" => "testMethodUpdateToDa",
                "numTelephone" => "testMethodUpdateToDa",
                "nonce" => Security::generateRandomHex()
            );

            // on met � jour les donn�es avec la m�thode
            ModelBenevole::update($id, $values);

            // on s�lectionne les donn�es ayant les anciennes valeurs
            $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = 'testMethodUpdate';");
            $log = $rep->fetchAll(PDO::FETCH_OBJ);

            // on v�rifie que les donn�es avec les anciennes valeurs n'existent plus dans la base de donn�es
            self::assertEmpty($log);

            // on s�lectionne les donn�es ayant les nouvelles valeurs
            $rep = Model::$pdo->query("SELECT login FROM Benevole WHERE login = 'testMethodUpdateToDa';");
            $log = $rep->fetchAll(PDO::FETCH_OBJ);
            $log = $log[0]->login;

            // on v�rifie que les donn�es avec les nouvelles valeurs existent dans la base de donn�es
            self::assertEquals($log, "testMethodUpdateToDa");
        } catch (PDOException $e) {
            // On affiche le message d'erreur
            echo $e->getMessage();
            // On force un fail parce qu'il y a une une erreur
            self::fail("Il ne devrait pas y avoir d'erreur");
        } finally {
            // on supprime le b�n�vole cr�� pour le test
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodUpdate';");
            Model::$pdo->query("DELETE FROM Benevole WHERE login = 'testMethodUpdateToDa';");
        }
    }
}
?>

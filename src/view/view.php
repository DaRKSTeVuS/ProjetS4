<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
        <link rel='stylesheet' href='css/projetS3css.css' type='text/css'>
		<script type="text/javascript">
		<!--
 
		function toggleDisplay(elmt){
			if(typeof elmt == "string")
				elmt = document.getElementById(elmt);
			if(elmt.style.display == "none")
				elmt.style.display = "";
			else
				elmt.style.display = "none";
		}
		</script>
    </head>
 
    <header>
        <div id="navbar">
                <?php
                if(isset($_SESSION['login'])){
                    echo'<a href="index.php?controller=benevole&action=deconnect">Se Déconnecter</a>';
                    $id = ModelBenevole::getIDbyLogin($_SESSION['login']);
                    echo'<a href="index.php?controller=benevole&action=read&IDBenevole=' . rawurlencode($id) . '">Mon Compte</a>';
                }else{
                    echo'<a href="index.php?controller=benevole&action=connect">Se Connecter</a>';
                    //Créer un compte
                    echo'<a href="index.php?controller=benevole&action=create">Créer un compte</a>';
                }
                ?>
        </div>

		<div class="container">
            <img class="imagebanniere" src="./images/banniere.jpg" alt="">
			 <a href="http://webinfo/~alarconj/ProjetS3/index.php?action=home">Festivalio</a>
		</div>

        <nav>
            <div class="topnav">
                <a href="index.php?action=home">Accueil</a>
                <a href="index.php?action=readAll">Festivals</a>
            </div> 
        </nav>
      </header>
      
      <body>
        <main>
            <?php
                if($pagetitle== "Entrez vos informations" || $pagetitle== "Modifier le festival" || $pagetitle== "Créer un festival" || $pagetitle=="Création d'un festival" || $pagetitle=="Liste des Disponibilites"){
                    echo '<h2 class="EVI">' . $pagetitle . '</h2>';
                }
                else{
                echo '<h2>' . $pagetitle . '</h2>';}
                $filepath = File::build_path(array("view", self::$object, "$view.php"));
                require $filepath; 
            ?>
            <br></br>
            <br></br>
        <main>
        <div class="footer">
          <p>Festivalio</p>
        </div>
    </body>
</html>


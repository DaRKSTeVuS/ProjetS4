
<div class="boite">
    <?php
        if(empty($tab_b)){
        	echo '<p>la liste est vide</p>';
            
        }else{
            echo '<p>Ces utilisateurs postulent en tant qu\'oraganistaur pour votre festival</p>';
            foreach ($tab_b as $b){
                echo '<p> Bénévole ' . $b->__get('login') .'</p>';
                echo '<p>Nom: ' . $b->__get('nom') .' </p>';
                echo '<p>Prénom: ' . $b->__get('prenom') .' </p>';
                echo '<p><a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=read&id=' . rawurlencode($b->__get('IDBenevole')) . '">Voir en détail</a></p>';
                echo '<a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=promote&IDFestival='.$_GET['IDFestival'] .'&IDBenevole=' . $b->__get('IDBenevole') . '">Promouvoir organisateur</a>';
                echo '<a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=reject&IDFestival='.$_GET['IDFestival'] .'&IDBenevole=' . $b->__get('IDBenevole') . '">Refuser la demande</a>';
            }
        }
        echo '<p><a href="./index.php?action=read&IDFestival=' . $_GET['IDFestival']. '"> Retour au portail du festival </a></p>'; 
    ?>
</div>
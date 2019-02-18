<div class="boite">
    <?php
        echo '<div><p> Bénévole : ' . htmlspecialchars($b->__get('login')) . '</p></div>';
        echo '<div><p>Nom : ' . htmlspecialchars($b->__get('nom')) . '</p></div>';
        echo '<div><p>Prénom : ' . htmlspecialchars($b->__get('prenom')) . '</p></div>';
        echo '<div><p>Courriel : ' . htmlspecialchars($b->__get('email')) . '</p></div>';
        echo '<div><p>Numéro de téléphone : ' . htmlspecialchars($b->__get('numTelephone')) . '</p></div>';
        echo '<div><p>Date naissance : ' . htmlspecialchars($b->__get('dateNaiss')) . '</p></div>';
        if(isset($_SESSION['login'])){
        if($_SESSION['login'] == $b->__get('login')){
        echo '<div class="item"><a href="index.php?controller=disponibilites&action=create&IDBenevole=' . htmlspecialchars($b->__get('IDBenevole')) . '">Ajouter une disponibilité  </a></div>';
        echo '<div class="item"><a href="index.php?controller=disponibilites&action=readAll&IDBenevole=' . htmlspecialchars($b->__get('IDBenevole')) . '">Toutes vos disponibilités </a></div>';
        echo '<div class="item"><a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=deleted&id=' . htmlspecialchars($b->__get("IDBenevole")) . '">Supprimer</a></div>'.
        '<div class="item"><a href="http://webinfo/~alarconj/ProjetS3/index.php?controller=benevole&action=update&id=' . htmlspecialchars($b->__get("IDBenevole")) . '">Modifier</a></div>';  
        }
        }
    ?>
</div>

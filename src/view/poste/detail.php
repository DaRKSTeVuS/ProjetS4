<div class="boite">
    <?php
    	if(ModelBenevole::isOrga($_SESSION['login'], rawurlencode($_GET['IDFestival']))){
        echo '<p>Poste ' . htmlspecialchars($p->__get('nomPoste')) .'</p>';
        echo '<div class="item"><a href="./index.php?controller=poste&action=deleted&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDPoste=' . htmlspecialchars($p->__get('IDPoste')) . '">Supprimer le poste  </a></p></div>';
        echo '<div class="item"><a href="./index.php?controller=poste&action=update&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDPoste=' . htmlspecialchars($p->__get('IDPoste')) . '">Modifier le poste </a></p></div>';
    	echo '<div class="item"><a href="./index.php?controller=creneaux&action=create&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDPoste=' . htmlspecialchars($p->__get('IDPoste')) . '">Ajouter un créneau au poste de ' . htmlspecialchars($p->__get('nomPoste')) . '</a></p></div>';
    	}
    	echo '<div class="item"><a href="./index.php?controller=creneaux&action=readAll&IDFestival=' . rawurlencode($_GET['IDFestival']) . '&IDPoste=' . htmlspecialchars($p->__get('IDPoste')) . '">Ensemble des creneaux pour le poste de ' . htmlspecialchars($p->__get('nomPoste')) . '</a></p></div>';
    	echo '<div class="item"><a href="./index.php?controller=benevole&action=ajouterPref&IDPoste=' . rawurlencode($_GET['IDPoste']) .'">Ajouter ce poste aux postes préférés </a></p></div>';
    	//echo '<div class="item"><a href="./index.php?controller=benevole&action=supprimerPref&IDPoste=' . rawurlencode($_GET['IDPoste']) .'">Supprimer ce poste des postes préférés </a></p></div>';
    ?>
</div>

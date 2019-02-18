<div class="boite">
    <?php
        echo  'Créneau ' . $d->__get('debutDispo') .' Date et heure de début de disponibilité :' . $d->__get("debutDispo") . 'Date et heure de fin de disponiblité :' . $d->__get("finDispo");
       
       	//A faire
        echo '<div class="item"><a href="http://webinfo/~alarconj/ProjetS3/index.php?action=deleted&id=' . $c->__get("IDCreneau") . '"> supprimer  </a></p></div>'.
        '<div class="item"><a href="http://webinfo/~alarconj/ProjetS3/index.php?action=update&id=' . $c->__get("IDCreneau") . '"> modifier  </a></p></div>';
    ?>
</div>

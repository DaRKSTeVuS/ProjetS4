
	<?php
	if(empty($tab_plan)){
		echo '<p>Votre planning est vide</p>';
	}else{
        foreach ($tab_plan as $plan) {
        	echo"<div class='boite'>";
        		echo'<p>Poste: '.$plan[0].'</p>';
        		echo'<p> Vous commencez le '.$plan[1].' de '.$plan[2].' h à '.$plan[3].' h .</p>';
			echo'</div>';
		}
	}
	?>


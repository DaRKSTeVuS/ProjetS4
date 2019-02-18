
<div>
    <form method="get"  action='index.php'> <!-- formulaire de type get charge creerVoiture-->
      <fieldset>
        <!--<legend>Création de festival :</legend>-->
        <input type='hidden' name='action' value='created'>

        <p>
          <label for="nom_festival">Nom :</label> 
          <input type="text" placeholder="Mon festival" name="nomFestival" id="nom_festival" required/>

          <label for="nom_lieu">Lieu :</label> 
          <input type="text" placeholder="Ma ville" name="lieuFestival" id="nom_lieu" required/>

          
          <label for="nom_dateD">Date début :</label> 
          <input type="date" name="dateDebutF" id="nom_dateD" required/>

          <label for="nom_dateF">Date fin :</label> 
          <input type="date" name="dateFinF" id="nom_dateF" required/>

          <label for="nom_description">Description :</label> 
          <textarea placeholder="La description de mon festival" name="description" id="nom_description"/></textarea>
        </p>
        <p>
          <input type="submit" value="Envoyer" />
        </p>
      </fieldset> 
    </form>
</div> 
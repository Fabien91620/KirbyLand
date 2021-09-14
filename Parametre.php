<html>
<head>
   <meta charset="utf-8">
   <link rel="stylesheet" href="parametre.css" />
   <?php
    include_once('../PHP/Fonctions.php');
    ?>
</head>
<body>
    <form method="post" action="">
        <div class="all" >
            <p class="titre">Paramètre généraux du compte </p>
            <label>Nom : </label>
            <input type="text" name="nom" size="30" /><br />
            <label>Adresse : </label>
            <input type="text" name="adresse" size="30" /><br />
            <label>Code postal : </label>
            <input type="text" name="codepostal" size="30" /><br />
            <label>Ville : </label>
            <input type="text" name="ville" size="30" /><br />
            <label>Mail : </label>
            <input type="text" name="Mail" size="30" /><br />
            <label>Pays : </label>
            <select name="pays">
                <option value="france">France</option>
                <option value="belgique">Belgique</option>
                <option value="suisse">Suisse</option>
            </select>
            <p class="titre">Message</p>
            <fieldset id="message">
              <textarea name="comments" rows="5" cols="40"></textarea>
            </fieldset>
            <p id="buttons">
              <input class="btn" type="submit" value="Enregistrer les modifications" / name="update">
              <a href="Jeux.php"><input class="btn" type="button" value="Quitter" /></a>
                by Yousra
            </p>
        </div>
    </form>
    <?php

    if (isset($_POST["update"]))
    {
      $res=update();
      if ($res)
        echo "mise a jour reussie ";
      else 
        echo "mise a jour echoué";


    }
    ?>
</body>
</html>
<!DOCTYPE html>
<html>     
    <head>
        <title> Bienvenue sur KirbyLAND</title>
        <link href="Accueil.css" rel="stylesheet"/>
        <?php
        include_once('Fonctions.php');
        ?>
    </head>
    <body>
      <form method="post" action="">
            <h2>Bienvenue sur KirbyLAND</h2>
            <p class="Erreur">
            <?php
                if(isset($_POST['connection'])){
                    if(connectUser()==true){
                        header("Location:Jeux.php");
                    }
                    else{
                        echo "Erreur de connection";
                    }
                }
            ?>
            </p>
            <div class="info">
                <p>
                    <label for="pseudo"> Entrez un pseudo</label>
                    <input type="text" name="pseudo" placeholder="Mon PSEUDO" required/>
                </p>
                <p>
                    <label for="pass">Votre mot de passe</label>
                    <input type="password" name="pass" id="pass" placeholder="Mon PASSWORD" required/>
                </p>
            </div>
            <div id="button">
                <a href="Inscription.php"><input class="btn" type="button" name="inscrire" value="S'inscrire"/></a>
                <input class="btn" type="submit" name="connection" value="Connection"/>
            </div>
        </form> 
    </body>
</html>
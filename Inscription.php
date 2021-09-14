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
      <form method="post" action="Accueil.php">
            <input class="btn" type="submit" name="Retour" value="Retour"/>
      </form> 
      <form method="post" action="">
            <h2>Bienvenue sur KirbyLAND</h2>
            <div class="info">
                <p>
                    <label for="pseudo"> Entrez un pseudo</label>
                    <input type="text" name="pseudo" placeholder="Mon PSEUDO"/ required>
                </p>
                <p>
                    <label for="pass">Votre mot de passe</label>
                    <input type="password" name="pass" id="pass" placeholder="Mon PASSWORD" required/>
                </p>
                <p>
                    <label for="mail">Votre mail</label>
                    <input type="text" name="mail" placeholder="abc@abc.com" required/>
                </p>
                <p>
                    <label for="adresse">Votre adresse</label>
                    <input type="text" name="adresse" placeholder="15 Impasse Voltaire" required/>
                </p>
                <p>
                    <label for="ville">Votre Ville</label>
                    <input type="text" name="ville" placeholder="Paris" required/>
                </p>
                <p>
                    <label for="cp">Votre Code Postal</label>
                    <input type="text" name="cp" placeholder="75015" required/>
                </p>
                <select name="pays">
                    <option value="france">France</option>
                    <option value="belgique">Belgique</option>
                    <option value="suisse">Suisse</option>
                </select>
            </div>
            <div id="button">
                <input class="btn" type="submit" name="Connection" value="Connection"/>
                <a href="Accueil.php"><input class="btn" type="button" name="Retour" value="Retour"/></a>
            </div>
        </form>
        <?php
        if(isset($_POST['Connection'])){
            $success = addUser();
            if($success){
                header("Location:Accueil.php");
            }                
            else{
                
            }               
        }
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <title>KirbyLand</title>
    <link href="Profil.css" rel="stylesheet"/>
    <?php
        include_once('Fonctions.php');
    ?>
</head>
<body>
    <div class="pseudo">
        <p>
            <?php
                $user = $_SESSION['pseudo'];
                echo $user;
            ?>
        </p>
    </div>
    <div class="image">
        <?php $imageP = myProfil(); ?>
        <?php foreach($imageP as $data):?>
            <img src="<?php echo $data['image'];?>" alt="Ma Photo">
        <?php endforeach; ?>
    </div>
    <div class="amis">
        <label>Mes Amis</label>
        <?php
            getFriend();
        ?>
    </div>
    <p class="pPseudo">Pseudo</p>
    <p class="pScore">Best Score</p>
    <div class="score">
        <?php
            getScore();  
        ?>
    </div>
    <div class="btn">
        <a href="Jeux.php"><input class="btnJouer" type="button" name="Jouer" value="Jouez"/></a>
        <a href="Parametre.php"><input class="btnParametre" type="button" name="parametre" value="parametre"/></a>
        <a href="Amis.php"><input class="btnAmis" type="button" name="btnAmis" value="Ajouter Amis"/></a>
    </div>
</body>
</html>
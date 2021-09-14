<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <title>KirbyLand | Profil d'amis</title>
    <link href="Profil.css" rel="stylesheet"/>
    <?php
        include_once('Fonctions.php');
    ?>
</head>
<body>
    <div class="pseudo">
            <?php $amis = profilAmis(); ?>
            <?php foreach($amis as $data):?>
            <p><?= $data['Pseudo'];?></p>
            <?php endforeach; ?>
    </div>
    <div class="image">
        <?php $amis = profilAmis(); ?>
        <?php foreach($amis as $data):?>
        <img src="<?php echo $data['image'];?>" alt="Ma Photo">
        <?php endforeach; ?>
    </div>
    <div class="amis">
        <label>Ses Amis</label>
        <?php $amis = getProfilAmis(); ?>
        <?php foreach($amis as $data):?>
            <p><?php echo $data['Pseudo'];?></p>
        <?php endforeach; ?>
    </div>
    <form class="fAjouter" method="post" action="">
        <input class="btnAjouter" type="submit" name="ajouter" value="Suivre" />
    </form>
    <div class="dAjouter">
        <?php if(isset($_POST['ajouter'])):?>
            <?php addAmis();?>
        <?php endif; ?>
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
        <a href="Amis.php"><input class="btnRetour" type="button" name="btnRetour" value="Retour"/></a>
    </div>
</body>
</html>
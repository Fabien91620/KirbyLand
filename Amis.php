<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>KirbyLand</title>
        <link href="Amis.css" rel="stylesheet"/>
        <?php include_once('Fonctions.php'); ?>
    </head>
    <body>
        <form class="ajouter" method="post"  action="">
            <input class="rechercheAmis" type="text" name="rechercheAmis" placeholder="Pseudo Amis"/>
            <input class="btnrechercheAmis" type="submit" name="btnrechercheAmis" value="Rechercher"/>
            <a class="jeux" href="Jeux.php"><input type="button" name="jeux" value="Jouer"/></a>
            <div class="titreJoueur">
                <h2>Joueur</h2>
                <hr />
            </div>
        </form>
        <form method="get" action="">
            <?php $amis = ficheAmis(); ?>
            <?php foreach($amis as $data):?>
                <a href="ProfilAmis.php?pseudo=<?php echo $data['ID']?>">
                    <div class="carreAmis">
                        <?php $_SESSION['idAmis'] = $data['ID'];?>
                        <img src="<?php echo $data['image'];?>"/>
                        <hr />
                        <p><?= $data['Pseudo'];?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </form>
        <?php if(isset($_POST['btnrechercheAmis'])):?>
                <?php $_SESSION['rAmis'] = $_POST['rechercheAmis']; ?>
                <?php header("Location:RechercheAmis.php");?>
        <?php endif; ?>
    </body>
</html>
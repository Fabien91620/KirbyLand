<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <link href="Jeux.css" rel="stylesheet"/>
    <title>KirbyLand</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/phaser@3.15.1/dist/phaser.js"></script>
	<script src="//cdn.jsdelivr.net/npm/phaser@3.15.1/dist/phaser.min.js"></script>
	<script class="jeux" type="text/javascript" src="Jeux/main.js"></script>
    <?php
        include_once('Fonctions.php');
    ?>
</head>
<body>
    <form method="post" action="">
        <div class="chat">
            <p>
                <?php
                    chat();
                ?>
            </p>
        </div>
        <a href="Profil.php"><input class="btnProfil" type="button" name="btnProfil" value="Mon Profil"/></a>
        <a href="Amis.php"><input class="btnAmis" type="button" name="btnAmis" value="Mes Amis"/></a>
        <a href="Parametre.php"><input class="btn" type="button" name="parametre" value="Mes Paramétre"/></a>
        <a href="Jeux.php"><input class="btnJeux" type="button" name="btnJeux" value="Autre Jeux"/></a>
        <input class="txtm" type="text" name="message"  placeholder="Votre message" required/>
        <input class="btne" type="submit" name="envoyer" value="Envoyer"/>
    </form>
    <?php
        if(isset($_POST['envoyer'])){
            addChat();
        }
    ?>
    <script>
        setInterval('load_Chat()' , 1500);
        function load_Chat(){
            $('.chat').load('load_Chat.php');
        }
    </script>
    <script>
    var height = 0;
    $('div').each(function(i, value){
        height += parseInt($(this).height());
    });

    height += '';

    $('div').animate({scrollTop: height});
    </script>
</body>
</html>
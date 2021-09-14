<?php
session_start();
function connectDB(){
$host ="localhost";
$user="root";
$mdp="root";
$db="kirbyland_yf";
$link = mysqli_connect($host,$user,$mdp,$db);
if($link){
	return $link;
}
else{
    echo "Erreur de connection à la base de donnée";
	return false;
}
}
function connectUser(){
	$link = connectDB();
	if(!$link){
		return false;
	}
    else{
		$user= $_POST['pseudo'];
		$mdp= $_POST['pass'];
		$req= "select * from Compte where Pseudo='$user' and motdepasse='$mdp'";
		$res = mysqli_query($link,$req);
		$row = mysqli_fetch_array($res);
        $_SESSION['pseudo'] = $user;
        $_SESSION['connectID'] = $row[0];
        echo $row[0];
        if($row){
            return true;
        }
        else{
            return false;
        }
	}
}
function getUser($login,$mdp){
    $link = connectDB();
    $req= "select * from Compte where pseudo='$login' and motdepasse='$mdp'";
    $res= mysqli_query($link,$req);
    $row = mysqli_fetch_array($res);
    return $row;
}
function addUser(){
	$success=false;
	$link = connectDB();
    if(!$link){
        return false;
    }
    else{
        $user= $_POST["pseudo"];
        $mdp= $_POST["pass"];
        $mail= $_POST["mail"];
        $adresse= $_POST["adresse"];
        $ville= $_POST["ville"];
        $CP = $_POST["cp"];
        $pays= $_POST["pays"];
        $exist = getUser($user,$mdp);
        if(!$exist){
            $req= "INSERT INTO Compte (Pseudo, Mail, motdepasse, codepostal, adresse, pays, ville ) VALUES('$user', '$mail', '$mdp', '$CP', '$adresse', '$pays', '$ville')";
            $res = mysqli_query($link,$req);
            echo $req;
            if($res==TRUE){
                 $success=true;
            }
            $id = mysqli_insert_id($link);
            $req = "INSERT INTO `Score`(point, ID_compte) VALUES (0, '$id')";
            $res= mysqli_query($link, $req);
        }   
    }
	return $success;
}
function addChat(){
    $link = connectDB();
    $user = $_SESSION['pseudo'];
    $mess = $_POST['message'];
    $_SESSION['message'] = $mess;
    $req = "INSERT INTO Chat (pseudo, message) VALUES('$user','$mess')";
    $res = mysqli_query($link,$req);
}
function chat(){
    $link = connectDB();
    $req = "SELECT pseudo, message FROM Chat ORDER BY Id ASC";
    $res = mysqli_query($link,$req);
    while($data = mysqli_fetch_assoc($res)){
         echo '<p><strong>' . htmlspecialchars($data['pseudo']) . '</strong> : ' . htmlspecialchars($data['message']) . '</p>';
    }
    mysqli_close($link);    
}
function getFriend(){
    $link = connectDB();
	if(!$link){
		return false;
	}
    else{
        $id = $_SESSION['connectID'];
        $req = "SELECT * FROM Compte WHERE ID in (select ami2 from Amis where ami1 = '$id')";
        $res = mysqli_query($link, $req);
        echo mysqli_error($link);
        while($data = mysqli_fetch_assoc($res)){
        echo '<p><strong>'.($data['Pseudo'].'</strong></p>');
        }
    mysqli_close($link);
    }
}
function getScore(){
    $link = connectDB();
    $req = "SELECT Compte.Pseudo, Score.point FROM Score INNER JOIN Compte ON Compte.ID = Score.ID_compte ORDER BY point DESC";
    $res = mysqli_query($link, $req);        
    while($data = mysqli_fetch_assoc($res)){
        echo '<p><strong>'.($data['Pseudo'].'</strong>'." ".$data['point'].'</p>');
    }
    mysqli_close($link); 
}
function ficheAmis(){
    $link = connectDB();
    $user = getID();
    $req = "SELECT Pseudo, image, ID FROM Compte WHERE ID != $user ";
    $res = mysqli_query($link, $req);
    return $res;
    mysqli_close($link);
}
function rechercheAmis(){       
    $link = connectDB();
    $recherche = $_SESSION['rAmis'];
    $req = "SELECT ID, Pseudo , image FROM Compte WHERE Pseudo = '$recherche'";
    $res = mysqli_query($link, $req);
    return $res;
    mysqli_close($link);
}
function addAmis(){
    $success = false;
    $link = connectDB();
    $idUser = getId();
    $userAmis = $_GET['pseudo'];
    $exist = getExistAmis($idUser, $userAmis);
    if(!$exist){
        $req = "INSERT INTO Amis (ami1, ami2) VALUES ('$idUser', '$userAmis')";
        $res = mysqli_query($link, $req);
        if($res){
            $success = true;
            echo "<script>alert('Ajouté au personne suivie');</script>";
        }
    }
    else{
        echo "<script>alert('Vous le suivez déja !');</script>";
    }
    return $success;
}
function getExistAmis($ami1, $ami2){
    $link = connectDB();
    $req= "select * from Amis where Ami1= $ami1 and ami2= $ami2 ";
    $res= mysqli_query($link,$req);
    $row = mysqli_fetch_array($res);
    return $row;
}
function getId(){
    $link = connectDB();
    $user = $_SESSION['pseudo'];
    $req = "SELECT id FROM Compte WHERE Pseudo = '$user'";
    $res = mysqli_query($link,$req);
    while($data = mysqli_fetch_assoc($res)){
        $row = $data['id'];
    }
    return $row;
    mysqli_close($link);
}
function myProfil(){
    $link = connectDB();
    $user = $_SESSION['pseudo'];
    $req= "SELECT ID, Pseudo, image FROM Compte WHERE Pseudo = '$user'";
    $res = mysqli_query($link, $req);
    return $res;
    mysqli_close($link);
}
function profilAmis(){
    $link = connectDB();
    $amis = $_GET['pseudo'];
    $req= "SELECT Compte.ID, Compte.Pseudo, Compte.image, Score.point FROM Compte INNER JOIN Score ON Compte.ID = Score.ID_compte WHERE Compte.ID = $amis";
    $res = mysqli_query($link, $req);
    return $res;
    mysqli_close($link);
}
function getProfilAmis(){
    $link = connectDB();
    $amis = $_GET['pseudo'];
    $req= "SELECT Pseudo FROM Compte WHERE ID in (select ami2 from Amis where ami1 = $amis)";
    $res = mysqli_query($link, $req);
    return $res;
    mysqli_close($link);
}
function update(){
    $link = connectDB();
    $success=false;
    $name= $_POST["nom"];
    $adresse= $_POST["adresse"];
    $cp= $_POST["codepostal"];
    $ville= $_POST["ville"];
    $mail= $_POST["Mail"];
    $pays= $_POST["pays"];
    $id = getId();
    $req ="update compte SET Pseudo='$name', Mail = '$mail', codepostal=$cp, ville='$ville', pays='$pays', adresse='$adresse' where ID='$id'";
    $res = mysqli_query($link,$req);
    if($res==TRUE){
        $success=true;
    }
    return $success;
}
?>
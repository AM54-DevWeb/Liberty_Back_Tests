<?php 
session_start();
require("connexion_bdd.php");

$requete=$bdd->prepare("SELECT * FROM customer WHERE mail_custom=?");
$requete->execute(array($_POST["mail_custom"]));
$nbcustomer = $requete->rowCount();


if($nbcustomer!=0){
    $customer=$requete->fetch();

    if(password_verify(strip_tags($_POST["password_custom"]),$customer["password_custom"])){
        $_SESSION["id_customer"]=$customer["id_custom"];
        $_SESSION["type"]=$customer["id_type_custom"];
        $_SESSION["firstname"]=$customer["firstname_custom"];

        header("Location:../index.php");
        exit;
    }else{
        header("Location:../index.php?page=connexion&erreur=pw");
        exit;
    }
}else{
    header("Location:../index.php?page=connexion&erreur=login");
    exit;
}

?>
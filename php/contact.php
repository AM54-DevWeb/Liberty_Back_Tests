<?php
session_start();
require_once("connexion_bdd.php");

if(isset($_POST["message"]) && isset($_POST["nom"]) && isset($_POST["email"])){
    if(!empty($_POST["message"]) && !empty($_POST["nom"]) && !empty($_POST["email"])){
        if(isset($_SESSION["id_customer"])){
            $custom = $_SESSION["id_customer"];
        }else{
            $custom = NULL;
        }

        $insert=$bdd->prepare("INSERT INTO contact (content_contact, id_service, id_custom) VALUES (?,?,?)");
        $insert->execute(array(strip_tags($_POST["message"]), strip_tags($_POST["adresse"]), $custom));

        $requete=$bdd->prepare("SELECT * FROM liberty");
        $requete->execute(array());
        $liberty=$requete->fetch();



        if(isset($_POST["adresse"])){
            if($_POST["adresse"]=="1"){
                $service="Direction";
            }elseif($_POST["adresse"]=="2"){
                $service="Marketing";
            }elseif($_POST["adresse"]=="5"){
                $service="Communication";
            }            
        }

        $dest = $liberty["mail_liberty"];
        $sujet = $service.' '.$_POST['nom'];
        $corp = strip_tags($_POST['message']);
        $headers = "From:".$_POST['email'];
        if (mail($dest, $sujet, $corp, $headers)) {
        echo "Email envoyé avec succès à $dest ...";
        header("Location:../index.php");
        } else {
        echo "Échec de l'envoi de l'email...";
        }
    }else{
        echo "Vous avez oublié une information";
    }  
}
?>
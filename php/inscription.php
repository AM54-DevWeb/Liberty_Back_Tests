<?php 
session_start();
require("connexion_bdd.php");

if(isset($_POST["name_custom"])
&&isset($_POST["firstname_custom"])
&&isset($_POST["object_custom"])
&&isset($_POST["password_custom"])
&&isset($_POST["password_customer_conf"])
&&isset($_POST["mail_custom"])){

    if(!empty($_POST["name_custom"])
    &&!empty($_POST["firstname_custom"])
    &&!empty($_POST["password_custom"])
    &&!empty($_POST["password_customer_conf"])
    &&!empty($_POST["mail_custom"])){

        if($_POST["password_custom"]==$_POST["password_customer_conf"]){
            //si "object" est rempli, c'est une entreprise, sinon c'est un particulier.
            //le type_cutom de :
            //entreprise = 3, particulier = 2, admin = 1
            if(!empty($_POST["object_custom"])){
                $type_custom=3;
            }else{
                $type_custom=2;
            }

            $insert=$bdd->prepare("INSERT INTO customer 
            (name_custom, firstname_custom, object_custom, password_custom, mail_custom, id_type_custom)
            VALUES(:name_custom, :firstname_custom, :object_custom, :password_custom, :mail_custom, :id_type_custom)");

            $insert->execute(array(
                ":name_custom"=>strip_tags($_POST["name_custom"]),
                ":firstname_custom"=>strip_tags($_POST["firstname_custom"]),
                ":object_custom"=>strip_tags($_POST["object_custom"]),
                ":password_custom"=>password_hash(strip_tags($_POST["password_custom"]), PASSWORD_BCRYPT),
                ":mail_custom"=>strip_tags($_POST["mail_custom"]),
                ":id_type_custom"=>$type_custom,
            ));

            $_SESSION["type"]=$type_custom;
            $_SESSION["id_customer"]=$bdd->lastInsertId();
            header("Location:../index.php");
        }else{
            header("Location:./php/form_inscription.php?erreur=pwd");
            exit;
        }

    }else{
        header("Location:form_inscription.php?erreur=saisie");
        exit;
    }

}else{
    header("Location:form_inscription.php?erreur=saisie");
    exit;
}

?>
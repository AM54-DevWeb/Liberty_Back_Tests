<?php 

require("connexion_bdd.php");
if(isset($_GET["action"])){
    if($_GET["action"]=="project"){
        $delete=$bdd->prepare("DELETE FROM project WHERE id_project=?");
        $delete->execute(array($_GET["id"]));

        header("Location:../index.php?page=project_list");
        exit;
    }

    if($_GET["action"]=="sub"){
        $delete=$bdd->prepare("DELETE FROM subscription WHERE id_sub=?");
        $delete->execute(array($_GET["id"]));

        header("Location:../index.php?page=subscription_list");
        exit;
    }
}
?>
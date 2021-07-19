<?php 
require("connexion_bdd.php");

if(isset($_GET["action"])){
    if($_GET["action"]=="project"){
        if(isset($_POST["title"]) && isset($_POST["description"])){
            if(!empty($_POST["title"]) && !empty($_POST["description"])){
                if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])){
                    $file=$_FILES["file"]["name"];
    
                    $dossier='../images/';
                    $fichier=basename($_FILES['file']['name']);
                    $taille_max=2000000;
                    $taille=filesize($_FILES['file']['tmp_name']);
                    $extensions=array('.png','.jpg','.jpeg','.gif');
                    $extension=strchr($_FILES['file']['name'],'.'); 
    
                    if(in_array($extension,$extensions)){
                        if ($taille<$taille_max){
                            $fichier=preg_replace('/([^.a-z0-9]+)/i','-',$fichier);
                            move_uploaded_file($_FILES['file']['tmp_name'], $dossier.$fichier);
                        }
                    }
                        }else{
                            $file=$_POST["name_file"];
                        }
    
                $update=$bdd->prepare("UPDATE project 
                                        SET title_project=?, description_project=?, picture_project=? 
                                        WHERE id_project=?");
    
                $update->execute(array(strip_tags($_POST["title"]),strip_tags($_POST["description"]),$file,$_GET["id"]));
    
                if($update){
                    header("Location:../index.php?page=project_list");
                    exit;
                }
            }
        }
    }

    if($_GET["action"]=="sub"){

        if(isset($_POST["cloud"]) && ($_POST["cloud"]) == "on"){
            $cloud = 1;
        }else{
            $cloud = 0;
        }
        
        if(isset($_POST["report"]) && ($_POST["report"]) == "on"){
            $report = 1;
        }else{
            $report = 0;
        }

        if(empty($_POST["project"])){
            $project = NULL;
        }else{
            $project = $_POST["project"];
        }

        if(empty($_POST["api"])){
            $api = NULL;
        }else{
            $api = $_POST["api"];
        }

        if(empty($_POST["storage"])){
            $storage = NULL;
        }else{
            $storage = $_POST["storage"];
        }

        $update=$bdd->prepare("UPDATE subscription 
        SET title_sub=?, price_sub=?, account_sub=?, project_sub=?, API_sub=?, storage_sub=?, cloud_sub=?, report_sub=?, id_liberty=?
        WHERE id_sub=?");

        $update->execute(array(strip_tags($_POST["title"]),
                                (float)strip_tags($_POST["price"]),
                                strip_tags($_POST["account"]),
                                $project,
                                $api,
                                $storage,
                                $cloud,
                                $report,
                                1,
                                $_GET["id"]));

        if($update){
        header("Location:../index.php?page=subscription_list");
        exit;
        }
    }
}

?>
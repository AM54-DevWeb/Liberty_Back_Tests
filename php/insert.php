<?php
require("connexion_bdd.php");

if(isset($_GET["action"])){
    switch ($_GET["action"]){
        case "project":
                
    if(isset($_FILES["file"])
    &&isset($_POST["title"])
    &&isset($_POST["description"])){
        $dossier='../images/';
        $fichier=basename($_FILES['file']['name']);
        $taille_max=2000000;
        $taille=filesize($_FILES['file']['tmp_name']);
        $extensions=array('.png','.jpg','.jpeg','.gif');
        $extension=strchr($_FILES['file']['name'],'.'); 

        if(!in_array($extension,$extensions)){
            $erreur="mauvais fichier uploadé !";
        }
        if ($taille>$taille_max){
            $erreur="fichier trop gros !";
        }

        if(!isset($erreur)){
            $fichier=preg_replace('/([^.a-z0-9]+)/i','-',$fichier);
            if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier.$fichier)){

                $insert=$bdd->prepare("INSERT INTO project (picture_project, title_project, description_project, id_liberty) 
                VALUES (?,?,?,?)");
                $insert->execute(array($fichier, strip_tags($_POST["title"]), strip_tags($_POST["description"]), 1));

                if($insert){
                    header("Location:../index.php?page=project");
                    exit;
                }else{
                    header("Location:../index.php?erreur=insert");
                    exit;
                    }
                }
            }
    }
        break;
    
    case "sub":
        if(isset($_POST["title"]) && isset($_POST["price"]) && isset($_POST["account"])){
            if(strip_tags($_POST["cloud"]) == "on"){
                $cloud = 1;
            }else{
                $cloud = 0;
            }

            if(strip_tags($_POST["report"]) == "on"){
                $report = 1;
            }else{
                $report = 0;
            }

            $insert=$bdd->prepare("INSERT INTO subscription 
                                                (title_sub, 
                                                price_sub, 
                                                account_sub, 
                                                project_sub, 
                                                API_sub, 
                                                storage_sub, 
                                                cloud_sub, 
                                                report_sub, 
                                                id_liberty) 
                                    VALUES (?,?,?,?,?,?,?,?,?)");

            $insert->execute(array(strip_tags($_POST["title"]), 
                                    strip_tags($_POST["price"]), 
                                    strip_tags($_POST["account"]), 
                                    strip_tags($_POST["project"]), 
                                    strip_tags($_POST["api"]), 
                                    strip_tags($_POST["storage"]), 
                                    $cloud, 
                                    $report, 
                                    1));

            if($insert){
                header("Location:../index.php?page=subscription");
                exit;
            }else{
                header("Location:../index.php?erreur=insert");
                exit;
            }
        }
        break;
    }

}

    ?>
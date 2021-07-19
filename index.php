<?php 
session_start(); 
require("php/connexion_bdd.php");


//TITLES & SUBTITLES
$requete=$bdd->prepare("SELECT * FROM title");
$requete->execute(array());

$tab_title=array();
$tab_subtitle=array();
$i=0;
while($title=$requete->fetch()){
    $tab_title[$i]=$title["content_title"];
    $tab_subtitle[$i]=$title["content_subtitle"];
    $i++;
}


//LIBERTY
$requete=$bdd->prepare("SELECT * FROM liberty");
$requete->execute(array());
$liberty=$requete->fetch();


//SUBSCRIPTION
$requete=$bdd->prepare("SELECT * FROM subscription");
$requete->execute(array());
$subscription=$requete->fetch();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liberty</title>
    <link rel="stylesheet" href="./css/liberty.css">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>

<body>
    <header>
        <h1>Liberty</h1>
        <nav>
            <ul>
                <li>
                    <a href="#home">home</a>
                </li>
                <li>
                    <a href="#work"><?= strtolower($tab_title[0]) ?></a>
                </li>
                <li>
                    <a href="#price"><?= strtolower($tab_title[1]) ?></a>
                </li>
                <li>
                    <a href="#contact"><?= strtolower($tab_title[2]) ?></a>
                </li>
                <?php if(!isset($_SESSION["type"])){ ?>
                <li>
                    <a href="index.php?page=connexion">Se connecter</a>
                </li>

                <li>
                    <a href="index.php?page=inscription">S'inscrire</a>
                </li>

                <?php }else{ ?>

                <li>
                    <a href="./php/deconnexion.php">Se Déconnecter</a>
                </li>

                <?php if($_SESSION["type"]==1){ ?>

                <li>
                    <a href="index.php?page=admin">Administration</a>
                </li>

                <?php } ?>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <section id="home">
        <div>
            <img src="<?= './images/'.$liberty["logo_liberty"] ?>" alt="Logo société Liberty">
        </div>
        <div class="titre">
            <h1><?php echo $liberty["title_liberty"] ?></h1>
            <h2><?php echo $liberty["slogan_liberty"] ?></h2>
        </div>
        <div class="bout"><a href="#contact">Contact us</a></div>
    </section>
    <section id="work">
        <div class="boutSLUp">
            <a href="#home"> <i class="fas fa-chevron-up"></i></a>
        </div>

        <div>
            <h1><?= $tab_title[0] ?></h1>
        </div>
        <div class="titre">
            <?= $tab_subtitle[0] ?>
        </div>
        <div class="portfolio">
        <?php
            $requete=$bdd->prepare("SELECT * FROM project");
            $requete->execute(array());
            while($project=$requete->fetch()){
            ?>
            <article>
                <div class="voile">
                    <br />
                    <i class="fas fa-plus-circle"></i>
                    <span><?= $project["title_project"] ?></span>
                </div>
                <img src="<?= './images/'.$project["picture_project"]?>" alt="<?= $project["title_project"] ?>">
            </article>
            <?php  } ?>
        </div>

    </section>
    <section id="price">
        <div class="boutSLUp">
            <a href="#home"> <i class="fas fa-chevron-up"></i></a>
        </div>

        <div>
            <h1><?= $tab_title[1] ?></h1>
        </div>
        <div class="titre">
            <?= $tab_subtitle[1] ?>
        </div>
        <div class="table">

        <?php
            $requete=$bdd->prepare("SELECT * FROM subscription");
            $requete->execute(array());
            $sub_title=array();
            $sub_price=array();
            $sub_account=array();
            $sub_project=array();
            $sub_api=array();
            $sub_storage=array();
            $sub_cloud=array();
            $sub_report=array();
            $j=0;
            while($subscription=$requete->fetch()){
                if($subscription["cloud_sub"]==1){
                    $sub_cloud[$j]="Custom Cloud Services";
                }else{
                    $sub_cloud[$j]="<s>Custom Cloud Services</s>";
                }
            
                if($subscription["report_sub"]==1){
                    $sub_report[$j]="Weekly Reports";
                }else{
                    $sub_report[$j]="<s>Weekly Reports</s>";
                }
            ?>

            <article>
                <div class="titreTable">
                    <h2><?= $subscription["title_sub"] ?></h2>
                    <h3><?= $subscription["price_sub"] ?>$ / month</h3>
                </div>
                <div class="content">
                    <div><?= $subscription["account_sub"] ?> account</div>
                    <div class="ligne"></div>
                    <div><?= $subscription["project_sub"] ?> project</div>
                    <div class="ligne"></div>
                    <div><?= $subscription["API_sub"] ?>K API Access</div>
                    <div class="ligne"></div>
                    <div><?= $subscription["storage_sub"] ?>MB Storage</div>
                    <div class="ligne"></div>
                    <div><?= $sub_cloud[0] ?></div>
                    <div class="ligne"></div>
                    <div><?= $sub_report[0] ?></div>
                    <div class="ligne"></div>
                    <div class="bout">
                        <a href="#">Sign up now</a>
                    </div>
                </div>

            </article>

            <?php } ?>
        </div>
    </section>
    <section id="contact">
        <div class="boutSLUp">
            <a href="#home"> <i class="fas fa-chevron-up"></i></a>
        </div>

        <div>
            <h1><?= $tab_title[2] ?></h1>
        </div>
        <div class="titre">
            <?= $tab_subtitle[2] ?>
        </div>
        
        <?php 
            if(isset($_SESSION["id_customer"])){
                $requete=$bdd->prepare("SELECT * FROM customer WHERE id_custom=?");
                $requete->execute(array($_SESSION["id_customer"]));
                $customer=$requete->fetch();
                $mail_custom="value='".$customer['mail_custom']."'";
                $mail_customer=$customer["mail_custom"];
                $name_custom="value='".$customer['name_custom']."'";
                $name_customer=$customer["name_custom"];
            }else{
                $mail_custom="Email";
                $name_custom="Name";
            }
        ?>

        <div class="form">
            <form action="./php/contact.php" method="POST">
                <div class="right">
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                </div>
                <div class="left">
                    <input type="text" name="nom" id="nom" placeholder="<?= $name_customer ?>" <?= $name_custom ?>>
                    <input type="text" name="email" id="email" placeholder="<?= $mail_customer ?>" <?= $mail_custom ?>>
                    <div class="sel">
                        <select name="adresse" id="adresse">
                        <?php
                        $requete=$bdd->prepare("SELECT * FROM service");
                        $requete->execute(array());
                        while($service=$requete->fetch()){ ?>
                            <option value="<?= $service["id_service"]?>"><?= $service["name_service"] ?></option>
                        <?php } ?>
                        </select>
                        <input type="submit" value="Send">
                    </div>
                </div>
            </form>
        </div>

    </section>

    <!-- ------------FORMULAIRE CONNEXION------------ -->

    <section id="formulaires">
        <div class="form_insc">
            <?php 
            if(isset($_GET["page"])){
                switch($_GET["page"]){
                    case "connexion":
                        include("./php/form_connect.php");
                        break;

                    case "inscription":
                        include("./php/form_inscription.php");
                        break;
                    case "admin":
                        include("./php/admin.php");
                        break;
                    case "project":
                        include("./php/form_project.php");
                        break;
                    case "project_list":
                        include("./php/project.php");
                        break;
                    case "subscription":
                        include("./php/form_subscription.php");
                        break;
                    case "subscription_list":
                        include("./php/subscription.php");
                        break;
                }
            }
            ?>
        </div>
    </section>

    <!-- ----------------------------------------------- -->

    <footer>
        <div class="boutSLUp">
            <a href="#home"> <i class="fas fa-chevron-up"></i></a>
        </div>
        <div class="titre">
            Copyright 2014 Compagny. Inc. All rights reserved.<br />
            Thème Liberty 1.0.1 Designed by JdeDev
        </div>
        <div class="center">
            <div class="face"><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            </div>
            <div class="twit"><a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a></div>
            <div class="goog"><a href="https://plus.google.com/" target="_blank"><i
                        class="fab fa-google-plus-g"></i></a></div>
        </div>
    </footer>
</body>

</html>
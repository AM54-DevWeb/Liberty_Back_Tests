<?php 
session_start();
include("admin.php"); 
?>

<?php 
require("connexion_bdd.php");

if(isset($_GET["id"])){
    $requete=$bdd->prepare("SELECT * FROM subscription WHERE id_sub=?");
    $requete->execute(array($_GET["id"]));
    $subscription=$requete->fetch();
}


if($subscription["cloud_sub"]==1){
    $checkedCloud="checked";
}else{
    $checkedCloud="";
}

if($subscription["report_sub"]==1){
    $checkedReport="checked";
}else{
    $checkedReport="";
}
?>

<form action="update.php?action=sub&id=<?= $subscription['id_sub'] ?>" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="<?= $subscription['title_sub'] ?>">

    <label for="price">Price</label>
    <input type="text" name="price" id="price" value="<?= $subscription['price_sub'] ?>">

    <label for="account">Account</label>
    <input type="number" name="account" id="account" value="<?= $subscription['account_sub'] ?>">

    <label for="project">Project</label>
    <input type="number" name="project" id="project" value="<?= $subscription['project_sub'] ?>">

    <label for="api">API</label>
    <input type="number" name="api" id="api" value="<?= $subscription['API_sub'] ?>">

    <label for="storage">Storage</label>
    <input type="number" name="storage" id="storage" value="<?= $subscription['storage_sub'] ?>">

    <label for="cloud">Cloud</label>
    <input type="checkbox" name="cloud" id="cloud" <?= $checkedCloud ?>>

    <label for="report">Report</label>
    <input type="checkbox" name="report" id="report" <?= $checkedReport ?>>

    <input type="submit" value="SEND">
</form>
<?php 
session_start();
include("admin.php"); 
?>

<?php 
require("connexion_bdd.php");

if(isset($_GET["id"])){
    $requete=$bdd->prepare("SELECT * FROM project WHERE id_project=?");
    $requete->execute(array($_GET["id"]));
    $project=$requete->fetch();
}


?>

<form action="update.php?action=project&id=<?= $project['id_project'] ?>" method="post" enctype="multipart/form-data">
    <img src="<?= '../images/'.$project['picture_project'] ?>">
    <label for="file">Picture</label>
    <input type="file" name="file">
    <input type="hidden" name="name_file" value="<?= $project['picture_project'] ?>">
    <label for="title">Title</label>
    <input type="text" name="title" value="<?= $project['title_project'] ?>">
    <label for="description">Description</label>
    <textarea name="description"><?= $project["description_project"] ?></textarea>
    <input type="submit" value="SEND">
</form>
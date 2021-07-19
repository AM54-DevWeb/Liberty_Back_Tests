<?php include("./php/admin.php"); ?>

<?php 
require("php/connexion_bdd.php");
$requete=$bdd->prepare("SELECT * FROM project");
$requete->execute(array());

?>
<table>
    <thead>
        <tr>
            <th>Project Titles</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
<?php 
while($project=$requete->fetch()){?>
    <tr>
        <td><?= $project["title_project"] ?></td>
        <td><a href="php/update_project.php?id=<?= $project['id_project'] ?>">Edit</a></td>
        <td><a href="php/delete.php?action=project&id=<?= $project['id_project'] ?>">Delete</a></td>
    </tr>
<?php
}
?>
    </tbody>
</table>
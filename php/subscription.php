<?php include("./php/admin.php"); ?>

<?php 
require("php/connexion_bdd.php");
$requete=$bdd->prepare("SELECT * FROM subscription");
$requete->execute(array());

?>
<table>
    <thead>
        <tr>
            <th>Subscription Titles</th>
            <th></th>
            <th></th>
        </tr>
    </thead>

    <tbody>
<?php 
while($subscription=$requete->fetch()){?>
    <tr>
        <td><?= $subscription["title_sub"] ?></td>
        <td><a href="php/update_subscription.php?id=<?= $subscription['id_sub'] ?>">Edit</a></td>
        <td><a href="php/delete.php?action=sub&id=<?= $subscription['id_sub'] ?>">Delete</a></td>
    </tr>
<?php
}
?>
    </tbody>
</table>
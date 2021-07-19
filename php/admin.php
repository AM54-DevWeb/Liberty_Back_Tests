<?php 
require("connexion_bdd.php");

if($_SESSION["type"]==1){
echo("Salut ".$_SESSION["firstname"]);
?> 
<a href="index.php?page=project">Upload a new project</a>
<a href="index.php?page=project_list">Project list</a>
<a href="index.php?page=subscription">Add Subscription</a>
<a href="index.php?page=subscription_list">Subscription list</a>
<?php 
}
?>
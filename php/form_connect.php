<form action="./php/connexion.php" method="post">
    <label for="mail">Email :</label>
    <input type="text"  id="mail" name="mail_custom">

    <label for="pwd">Password :</label>
    <input type="password" id="pwd" name="password_custom">

    <input type="submit" value="Send">
</form>

<?php 

if(isset($_GET["erreur"])){
    if($_GET["erreur"]=="pw"){
        echo "Invalid Password";
    }else{
        echo "Invalid Login";
    }
}

?>
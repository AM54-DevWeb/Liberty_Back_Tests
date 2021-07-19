<?php
/* connexion A  la bdd en PDO */
try{
    $bdd = new PDO('mysql:host=localhost; dbname=liberty2; charset=utf8', 'root', '');
}
    // on attrape l'exception (l'erreur) et on l'affiche
    catch(exception $e)
{
    die('Erreur '.$e->getMessage());
}
?>
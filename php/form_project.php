<?php include("./php/admin.php"); ?>

<form action="php/insert.php?action=project" method="post" enctype="multipart/form-data">
    <label for="file">Picture</label>
    <input type="file" name="file">
    <label for="title">Title</label>
    <input type="text" name="title">
    <label for="description">Description</label>
    <textarea name="description"></textarea>
    <input type="submit" value="SEND">
</form>
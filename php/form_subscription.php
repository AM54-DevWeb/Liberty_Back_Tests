<?php include("./php/admin.php"); ?>

<form action="php/insert.php?action=sub" method="post">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">

    <label for="price">Price</label>
    <input type="text" name="price" id="price">

    <label for="account">Account</label>
    <input type="number" name="account" id="account">

    <label for="project">Project</label>
    <input type="number" name="project" id="project" value="null">

    <label for="api">API</label>
    <input type="number" name="api" id="api">

    <label for="storage">Storage</label>
    <input type="number" name="storage" id="storage">

    <label for="cloud">Cloud</label>
    <input type="checkbox" name="cloud" id="cloud">

    <label for="report">Report</label>
    <input type="checkbox" name="report" id="report">

    <input type="submit" value="SEND">
</form>
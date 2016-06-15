<?php

function echoActiveClassIfRequestMatches($requestUri)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
        echo 'class="active"';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Nurse Dashboard</title>

</head>

<body>
<div id="header">
    <h1>Dashboard</h1>
    <hr>
    <ul class="nav nav-pills">
        <li <?=echoActiveClassIfRequestMatches("nurse_home")?> role="presentation"><a href="/views/nurse/nurse_home.php">Home</a></li>
        <li <?=echoActiveClassIfRequestMatches("room_management")?> role="presentation"><a href="/views/nurse/room_management.php">Room Management</a></li>
        <li <?=echoActiveClassIfRequestMatches("patient_byFloor_search")?> role="presentation"><a href="/views/nurse/patient_byFloor_search.php">Check Floor Capacity</a></li>
    </ul>
</div>

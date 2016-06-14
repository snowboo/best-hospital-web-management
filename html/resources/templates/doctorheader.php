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
    <title>Doctor Dashboard</title>
</head>

<body>
<div id="header">
    <h1>Dashboard</h1>
    <ul class="nav nav-pills">
        <li <?=echoActiveClassIfRequestMatches("doctor_home")?> role="presentation"><a href="/views/doctor/doctor_home.php">Home</a></li>
        <li <?=echoActiveClassIfRequestMatches("doctor_patients")?> role="presentation"><a href="/views/doctor/doctor_patients.php">My Patients</a></li>
        <li <?=echoActiveClassIfRequestMatches("medicalrecordsearch")?> role="presentation"><a href="/views/doctor/medicalrecordsearch.php">Medical Records</a></li>
        <li <?=echoActiveClassIfRequestMatches("patient_filter")?> role="presentation"><a href="/views/doctor/patient_filter.php">Search for specific patients</a></li>
    </ul>
</div>

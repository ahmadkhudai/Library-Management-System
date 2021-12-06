<?php

$dbUser = 'root';
$pass = '';

$db = 'mylibrary';


$libraryDB = new mysqli('localhost', $dbUser, $pass, $db) or die("Unable to Connect...");

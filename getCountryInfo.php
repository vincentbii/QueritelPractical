<?php

/**
 * a user posts a list of columns to be retrieved
 * NB:: input list can be in any form
 * for this demonstration, a user will post a comma separated list of columns as the second argument in the format below via a command line
 *
 * php getCountryInfo.php "Contry Name,Country Code" Kenya
 *
 */

if (!isset($argv[1]) && !isset($argv[2])) {
    print_r("provide relevant information to be retrieved");
}

$columns = htmlspecialchars($argv[1]);
$country = htmlspecialchars($argv[2]);
$col = explode(",", $columns);

try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=Queritel', 'user', 'password');
    $sth = $dbh->prepare("SELECT $col from COUNTRIES WHERE Country Name = :countryName", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':countryName' => $country));
    $dbh = null;
    print_r($sth->fetchAll());
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
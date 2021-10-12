<?php

/**
 * for the purpose of this demonstration
 *
 * we will use the command php getCountryCode.php to retrieve the information
 */

try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=Queritel', 'user', 'password');
    $stmt = $dbh->query('SELECT Country Name, Phone Code from COUNTRIES');
    $stmt->execute();
    $dbh = null;
    print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
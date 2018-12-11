<?php

try {
    $db = new PDO('mysql:host=xy1fd.myd.infomaniak.com;dbname=xy1fd_bottleglass', 'xy1fd_admin','XUxtMTgfTqcx');

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


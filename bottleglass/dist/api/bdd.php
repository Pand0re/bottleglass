<?php

try {
    $db = new PDO('mysql:host=xy1fd.myd.infomaniak.com;dbname=xy1fd_bottleglass', 'xy1fd_admin','XUxtMTgfTqcx');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


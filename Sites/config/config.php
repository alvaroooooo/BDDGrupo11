<?php
    try {
        $user = 'grupo11';
        $password = 'grupo11';
        $databaseName = 'grupo11e3';
        $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
        $user2 = 'grupo46';
        $password2 = 'pipeyfran';
        $databaseName2 = 'grupo46e3';
        $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
    } catch (Exception $e) {
        echo "No se pudo conectar a la base de datos $e";
    }
?>
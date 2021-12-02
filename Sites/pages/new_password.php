<?php


# se crean funciones auxiliares:

function password_changer($str) {
    $myarray = str_split($str);
    $largo = count($myarray);
    if ($largo > 0) {
        $new_password = "";
        for ($i = 0; $i < $largo; $i += 1) {
            $key = array_rand($myarray);
            $character = $myarray[$key];
            unset($myarray [$key]);
            $new_password += $character;
        }
        $new_password;
    }
}

# citado de https://stackoverflow.com/questions/37524969/check-if-an-object-exists-in-an-array

function existsInArray($entry, $array) {
    foreach ($array as $compare) {
        if ($compare->id == $entry->id) {
            return true;
        }
    }
    return false;
}

function max_index() {
    require("config/conexion.php");
    $result = $db -> prepare("SELECT MAX(usuario.id)
                                FROM usuario");
    $result -> execute();
    $dataCollected = $result -> fetchAll();

    foreach ($dataCollected as $d) {
        $MAX_id = $d;
    
    return $MAX_id;
    }
}

# Cambiar contraseñas Grupo impar 

function full_process() {

    require("config/conexion.php");
    $result = $db -> prepare("SELECT usuario.nombre, usuario.id  FROM usuarios;");
    $result -> execute();
    $dataCollected = $result -> fetchAll();

    foreach ($dataCollected as $d) {
        $name = $d[0];
        $id = $d[1];
        $new_password = password_changer($name);
        $change = $db -> prepare("UPDATE usuario SET usuario.contraseña = $new_password WHERE usuario.id = $id;");
        $result -> execute();

    }
    # Se crea una funcion para guardar todos los mail del grupo impar:

    require("config/conexion.php");
    $result = $db -> prepare("SELECT usuario.email FROM usuarios;");
    $result -> execute();
    $dataCollectedemail = $result -> fetchAll();

    # Se obtiene el id maximo:

    $MaxID = max_index();
    $contador = 1;
    # Cambiar contraseñas Grupo par

    require("config/conexion.php");
    $query = "WITH horas as (
        SELECT id_user, sum(Juegosusuario.hours)
        FROM Juegosusuario
        GROUP BY id_user
        )
        SELECT usuario.*, horas.sum FROM usuario, horas WHERE usuario.id = horas.id_user;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $dataCollected = $result -> fetchAll();

    foreach ($dataCollected as $d) {
        $id_anterior = $d[0];
        $id_nuevo = $MaxID + $contador;
        $nombre = str_replace(" ", "", $d[1]);
        $mail = $d[2];
        $username = $d[4];
        $horas = strval($d[5]);
        $name = $nombre .= $horas;
        $new_password = password_changer($name);
        if (!existsInArray($mail, $dataCollectedemail)) {
            $change = $db -> prepare("INSERT INTO usuario VALUES ($id_nuevo, $d[1], $mail, $new_password, $username)");
            $change -> execute();
        }
        # Ahora se actualizan los ids en las bdd pares:
        $otro = fix_ids($db2, $id_anterior, $id_nuevo);
        $contador = $contador + 1;
        }
}

function fix_ids($db, $old_id, $new_id) {
    $query1 = "UPDATE juegosusuario
               SET juegosusuario.id_user = $new_id
               WHERE juegosusuario.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

    $query1 = "UPDATE Resena
               SET Resena.id_user = $new_id
               WHERE Resena.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

    $query1 = "UPDATE Comprador
               SET Comprador.id_user = $new_id
               WHERE Comprador.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

    $query1 = "UPDATE Suscripcion
               SET Suscripcion.id_user = $new_id
               WHERE Suscripcion.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

    $query1 = "UPDATE Pagossuscripcion
               SET Pagossuscripcion.id_user = $new_id
               WHERE Pagossuscripcion.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

    $query1 = "UPDATE Pagovideojuego
               SET Pagovideojuego.id_user = $new_id
               WHERE Pagovideojuego.id_user = $old_id";
    $result = $db -> prepare($query);
    $result -> execute();

}

?>


<?php
    try {
        $user = 'grupo11';
        $password = 'luisalvaro';
        $databaseName = 'grupo11e3';
        $db1 = new PDO("pgsql:dbname=$databaseName:host=$localhost;port=5432;user=$user;password=$password");
        $user2 = 'grupo46';
        $password2 = 'pipeyfran';
        $databaseName2 = 'grupo46e3';
        $db2 = new PDO("pgsql:dbname=$databaseName:host=$localhost;port=5432;user=$user;password=$password");
    } catch (Exception $e) {
        echo "No se pudo conectar a la base de datos $e";
    }
?>
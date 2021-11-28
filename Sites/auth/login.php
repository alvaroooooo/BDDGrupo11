<?php
require_once '../__init__.php';
$request_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
if ($request_method  === 'POST') {
    // Aquí se tendría que buscar el id del usuario en la BDD con el mail y la contraseña
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    

    $result = validateLogin($db, $user_email, $user_password);

    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>"; 

    if (empty($result)) {
        //echo "Esta vacio";
        header('Location: ' . $_SERVER['PHP_SELF']);
        $isReload = true;
        die;
        
    } else {
        $_SESSION['email'] = $user_email;
        $_SESSION['contrasena'] = $user_password;
        $_SESSION['username'] = $result[0]['username'];
        $_SESSION['nombre'] = $result[0]['nombre'];
        $_SESSION['uid'] = $result[0]['uid'];
        // Se manda al usuario
        go_home();
    }

    } elseif ($request_method === 'GET') {
        // En este caso, que se trata de obtener la página de inicio de sesión
        // y no hay una sesión iniciada, se muestra el form
        include './../layout/header2.php'; ?>

        <body>
        <?php 
        if ($isReload) {
            echo '<script type="text/javascript">  window.onload = function() alert("New user added");}</script>';
            $isReload = false;
        }
        ?>
        <div style="margin-top: 100px;"> </div>
        <div class="container mt-5 card w-50 px-5 py-2 border-primary">
            <form class="align-items-center" method="POST">
                <div class="mt-5 mb-5 text-center">
                    <p class="text-primary h2"> Login </p>
                </div>
                <div class="mb-5 mt-5 w-100">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Por ejemplo: Juanito@gmail.com" autocomplete="off">
                    <div id="emailHelp" class="form-text"> No se compartira la información </div>
                </div>
                <div class="mb-5 mt-5 w-100">
                    <label for="exampleInputPassword1" class="form-label" aria-autocomplete="off">Contraseña</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="text-center mt-5 mb-5">
                    <button type="submit" class="btn btn-primary w-50">Ingresar</button>
                </div>
            </form>

            <a href="./register.php" class="btn btn-link text-center">
                Crear cuenta nueva
            </a>
        </div>
    <?php include './../layout/footer.html';
    } ?>

</body>
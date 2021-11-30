<!DOCTYPE html>
<html>

<head>
  <title> MiPeli </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <link rel="stylesheet" href="/~grupo11/styles/tables.css?v=5">
  <link rel="stylesheet" href="/~grupo11/styles/styles.css?v=5">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="shortcut icon" href="/~grupo11/screen-712.svg">
</head>

<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/~grupo11/index.php"> <i class="fas fa-video"></i> MiPeli </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <li class="text-light text-info"> Para tus películas favoritas </li>
        </li>
      </ul>

      <?php
      if (isset($_SESSION["username"])) {
      ?>
        <div class="justify-content-end">
          <a href="/~grupo11/auth/personal_info.php" class="btn btn-outline-primary me-3"> <?php echo $_SESSION['nombre']; ?> </a>
          <a href="/~grupo11/auth/logout.php" class="btn btn-outline-warning me-5"> Logout </a>
        </div>
      <?php
      } else {
      ?>
        <div class="justify-content-end">
          <a href="/~grupo11/auth/login.php" class="btn btn-outline-primary"> Iniciar Sesión </a>

          <a href="/~grupo11/auth/register.php" class="btn btn-outline-warning ms-2 me-3"> Registrarse </a>
        </div>
      <?php
      }
      ?>


    </div>
  </div>
</nav>
<body>
  <?php
    include('layout/header2.php');
    require('config/config.php');
  ?>
  <!--<link rel="stylesheet" href="styles/styles.css?v=4"> -->
  <div class="general">
    <p class="display-6 special"> Consulta tus peliculas <i class="fas fa-clone"></i> </p>
    <hr>
    <!-- Comienzo de las consultas -->
    <!-- Consulta 1 -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 1: Todas las películas y series gratuitas por los proveedores </h4>
        <form action="Consultas/c1.php" method="post">
          <div class="row">
            <div class="col-9">
              <div class="form-group">
                <label for="formGroupExampleInput">Sólo consulta</label>
                <input type="text" class="form-control" id="disabledTextInput" disabled placeholder="Sólo apreta 'Consultar'">
              </div>
            </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Consultar </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- Consulta 2: Dado un n devolver todas las series con a lo menos n temporadas  -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 2: Series con n o más temporadas </h4>
        <form action="Consultas/c2.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">Selecciona una opción</label>
          </div>
          <?php echo "<input type='number' name='n' min=0 max=".$max_temp_series." class='form-control' placeholder='Ingrese un número (Ej: 1)'>" ?>
          </div>
          <div class="col-3 align-self-center text-center">
            <button class="btn btn-success" style="width: 80%"> Buscar </button>
          </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Consulta 3: Dado el titulo de una serie o pelicula retorna las peliculas con ese nombre
    y donde estan disponibles -->  
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 3: Muestra en qué proveedor esta disponible la pelicula/serie que ingreses </h4>
        <form action="Consultas/c3.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">Título de película/serie</label>
          </div>
          <input name="nombre_peli_serie" type="text" class="form-control" placeholder="Ejemplo: Avatar">
          </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Buscar </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Consulta 4: Dado un genero devolver todas las peliculas que 
    pertenezcan a ese genero y sus respectivos subgeneros inmediatos -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 4: Selecciona un género </h4>
        <form action="Consultas/c4.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">Selecciona una opción</label>
          </div>
          <select name="genero" class="custom-select my-dropdown">
            <option value="" disabled selected> Elige un género </option>
              <?php 
                foreach($nombre_generos_query as $key => $value){
                  echo "<option value=$value[0]>$value[0] </option>";
                }
              ?>
          </select>
          </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Buscar </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Consulta 5 -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 5: Peliculas a las que tiene acceso un usuario </h4>
        <form action="Consultas/c5.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">Escribe el nombre de un usuario</label>
          </div>
          <input type="text" name="username" class="form-control" placeholder="Ejemplo: emiller1965">
          </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Buscar </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Consulta 6 -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 6: Series a las que un usuario ha visto más de 1 capitulo el último año </h4>
        <form action="Consultas/c6.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">Coloca el nombre de un usuario</label>
          </div>
          <input type="text" name="username_serie" class="form-control" placeholder="Ejemplo: emiller1965">
          </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Buscar </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Consulta 7 -->
    <br>
    <div class="card w-80">
      <div class="card-body">
        <h4 class="special"> Consulta 7: Cantidad gastada por cada usuario en peliculas no gratuitas </h4>
        <form action="Consultas/c7.php" method="post">
          <div class="row">
          <div class="col-9">
          <div class="form-group">
            <label for="formGroupExampleInput">A consultar!</label>
          </div>
          <input type="text" class="form-control" placeholder="Solo apretar 'Consultar'" disabled>
          </div>
            <div class="col-3 align-self-center text-center">
              <button class="btn btn-success" style="width: 80%"> Consultar </button>
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
  <?php 
    include('layout/footer.html')
  ?>
</body>


</html>
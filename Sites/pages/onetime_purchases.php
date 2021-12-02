<?php
include_once('./../__init__.php');
include('./../layout/header2.php');
include('./../Consultas/cOneTimeMovies.php');
include('./../Consultas/cOneTimeGames.php');

$all_games = all_games($db2);

?>

<body>
  <div style="margin-top: 200px"></div>

  <div class="container">
    <a href="./onetime_games.php" class="btn btn-success"> 
      Ir a juegos de paga única 
    </a>
    <span></span>
    <a href="./onetime_movies.php" class="btn btn-info">
      Ir a películas de paga única 
    </a>
  </div>

  <div style="margin:600px 0px;">
    <span></span>
  </div>

</body>






<?php
include('./../layout/footer.html')
?>
<?php 
  include("../DB/conecta.php");
  include("../dao/usuariosDao.php");
  include("Cabecalho.php");
?>

<?php
  session_start();
  $usuario_id = $_SESSION['usuario_id'];
  $usuario_nome = $_SESSION['usuario_nome'];

  if (isset($usuario_id) && isset($usuario_nome)) {
    echo '
      <div class="d-flex justify-content-center">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item"><a href="Seguidor.php" class="nav-link" aria-current="page">Seguidores</a></li>
              <li class="nav-item"><a href="Seguindo.php" class="nav-link">Seguindo</a></li>
          </ul>
      </div>';
    echo "</br>";
    echo '<h2>Seguidores</h2>';
    $seguidor = getSeguidor(getConection(),$usuario_id);
    while ($registro = mysqli_fetch_assoc($seguidor)) {
        $id = $registro["id"];
        $nome = $registro["seguidor"];
        echo '
          <div class="container">
            <form class="row g-3 needs-validation" action="" method="post" novalidate>
              <div class="col-md-6">
                  '.$nome.'
              </div>
              <div class="col-md-6">
                <input type="hidden" name="id" value="'.$id.'">
                <button class="btn btn-primary" type="deletar" name="deletar">Retirar seguidor</button>
              </div>
            </form>
          </div>';
    }
  } else {
      echo '<div class="container">
      <form class="row g-3 needs-validation" action="" novalidate>
        <div class="col-md-12">
          <h2>Faça Login para ver seus seguidores!</h2>
        <div class="col-12">
          <a class="btn btn-primary" href="Login.php">Login</a>
        </div>
      </form>
    </div>';
  }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletar"])) {
      $conexao = getConection();
      $id = $_POST["id"];
      $resultado_exclusao = delSeguir($conexao, $id);
      header("Location: Seguidor.php");
  }
  
?>

<?php include("Rodape.php");?>
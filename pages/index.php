<?php 
  include("../DB/conecta.php");
  include("../dao/publicacoesDao.php");
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
      </div>
';

    include("novoPost.php");
    $resultado = getSelfPosts(getConection(),$usuario_id);
    echo "</br>";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $id = $registro["id"];
        $pai = $registro["pai"];
        $conteudo = $registro["conteudo"];
        $usuario = $registro["usuario"];
        $data = $registro["data"];
        
        echo '<div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                  <div class="col-md-2">
                    '.$data.'
                  </div>
                  <div class="col-md-8">
                    '.$usuario_nome.': '.$conteudo.'
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-primary" href=comentarios.php?id='.$id.' name="id">Comentários</a>
                  </div>
                </form>
              </div>';
    }
  } else {
      echo '<div class="container">
      <form class="row g-3 needs-validation" action="" novalidate>
        <div class="col-md-12">
          <h2>Faça Login para ver seu perfil!</h2>
        <div class="col-12">
          <a class="btn btn-primary" href="Login.php">Login</a>
        </div>
      </form>
    </div>';
  }
    
?>

<?php include("Rodape.php");?>
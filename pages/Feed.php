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
    include("novoPost.php");
    $resultado = getPosts(getConection(),$usuario_id);
    echo "</br>";

    while ($registro = mysqli_fetch_assoc($resultado)) {
        $id = $registro["id"];
        $pai = $registro["pai"];
        $conteudo = $registro["conteudo"];
        $usuario = $registro["usuario"];
        $data = $registro["data"];
        $nome = $registro["nome"];
        
        echo '<div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                  <div class="col-md-2">
                    '.$data.'
                  </div>
                  <div class="col-md-8">
                    '.$nome.': '.$conteudo.'
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-primary" href=comentarios.php?id='.$id.' name="id">Comentários</a>
                  </div>
                </form>
              </div>';
    }
  }
    
?>

<?php include("Rodape.php");?>
<?php 
  include("../DB/conecta.php");
  include("../dao/usuariosDao.php");
  include("Cabecalho.php");
?>

<?php
    session_start();
    $usuario_id = $_SESSION['usuario_id'];
    echo '
    <div class="container">
    <form class="row g-3 needs-validation" action="" method="post" novalidate>
      <div class="col-md-12">
        <h2>Quem está procurando?</h2>
        <input type="text" class="form-control" name="pesquisa" required>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="pesquisar" name="pesquisar">pesquisar</button>
      </div>
    </form>
    </div>
    ';


    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pesquisar"])) {
        $conexao = getConection();
        $pesquisa = $_POST["pesquisa"];
    
        $resultado_pesquisa = getUsuarioByUsername($conexao, $pesquisa);
        // Verificar se foram encontrados resultados
        if ($resultado_pesquisa && mysqli_num_rows($resultado_pesquisa) > 0) {
            // Mostrar os resultados
            echo "<h2>Resultado da pesquisa:</h2>";
            while ($usuario = mysqli_fetch_assoc($resultado_pesquisa)) {

                $seguindo = getSeguir($conexao,$usuario_id,$usuario['id']);
                $row = mysqli_fetch_assoc($seguindo);

                echo '<div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                  <div class="col-md-6">
                    <h5>'.$usuario['nome'].'</h5>
                  </div>
                  <div class="col-md-6">
                  ';

                    if ($usuario_id == $usuario['id']){
                        echo '<h5>Seu Perfil</h5>';
                    }
                    else if ($seguindo && mysqli_num_rows($seguindo) > 0) {
                        // Se há resultados, significa que o usuário está seguindo o outro usuário
                        echo '
                            <input type="hidden" name="id" value="'.$row['id'].'">

                            <button class="btn btn-primary" type="deletar" name="deletar">Deixar de seguir</button>';
                    } else {
                        echo '
                            <input type="hidden" name="seguidor" value="'.$usuario_id.'">
                            <input type="hidden" name="seguido" value="'.$usuario['id'].'">
                            <button class="btn btn-primary" type="add" name="add">Seguir</button>';
                    }
                  echo'
                  </div>
                </form>
              </div>';
            }
        } else {
            // Indicar que nenhum resultado foi encontrado
            echo "<p>Nenhum resultado encontrado para a pesquisa '" . $pesquisa . "'.</p>";
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deletar"])) {
        $conexao = getConection();
        $id = $_POST["id"];
        $resultado_exclusao = delSeguir($conexao, $id);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
        $conexao = getConection();
        $seguidor = $_POST["seguidor"];
        $seguido = $_POST["seguido"];
        $resultado_add = addSeguir($conexao, $seguidor,$seguido);
    }
    
    

?>

<?php include("Rodape.php");?>
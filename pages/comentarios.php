<?php 
  include("../DB/conecta.php");
  include("../dao/publicacoesDao.php");
  include("Cabecalho.php");
?>

<?php
    session_start();
    $usuario_id = $_SESSION['usuario_id'];
    $usuario_nome = $_SESSION['usuario_nome'];
    $id = $_GET['id'];
    $resultado = getPostsById(getConection(),$id);
    $registro = mysqli_fetch_assoc($resultado);
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
                    <h2>'.$nome.': '.$conteudo.'</h2>
                </div>
            </form>
        </div>';

    echo "</br>";

    $resultado_comentario = getPostsSegundario(getConection(),$id);
    while ($registro_comentario = mysqli_fetch_assoc($resultado_comentario)) {
        $id_comentario = $registro_comentario["id"];
        $pai_comentario = $registro_comentario["pai"];
        $conteudo_comentario = $registro_comentario["conteudo"];
        $usuario_comentario = $registro_comentario["usuario"];
        $data_comentario = $registro_comentario["data"];
        $nome_comentario = $registro_comentario["nome"];
        echo '<div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                  <div class="col-md-2">
                    '.$data_comentario.'
                  </div>
                  <div class="col-md-8">
                    '.$nome_comentario.': '.$conteudo_comentario.'
                  </div>
                </form>
              </div>';
    }

    echo "</br>";

    echo    '<div class="container">
                <form class="row g-3 needs-validation" action="" method="post" novalidate>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="validationCustom03" name="comentario" required>
                </div>
                <div class="col-3">
                    <button class="btn btn-primary" type="submit" name="comentar">Comentar</button>
                </div>
                </form>
            </div>';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comentar"])) {
        if (!empty($_POST["comentario"])) {
            $conteudo = $_POST["comentario"];
            $conexao = getConection();

            if (!$conexao) {
                die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
            }
    
            $query = "INSERT INTO publicacoes (pai, conteudo, usuario, data) VALUES ('$id', '$conteudo', '$usuario_id',  NOW())";
    
            if (mysqli_query($conexao, $query)) {
                echo "Nova comentario inserida com sucesso!";
            } else {
                echo "Erro ao inserir a nova comentario: " . mysqli_error($conexao);
            }

            mysqli_close($conexao);
        } else {
            echo "Por favor, insira o conteúdo da sua nova comentario.";
        }
    }
?>

<?php include("Rodape.php");?>
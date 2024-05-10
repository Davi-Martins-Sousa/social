<?php 
  include("Cabecalho.php");
  include("../DB/conecta.php");
  include("../dao/usuariosDao.php");
?>

<div class="container">
  <form class="row g-3 needs-validation" id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
    <div>
      <div class="col-md-4 mx-auto">
        <label for="validationCustom01" class="form-label">Nome de Usuário</label>
        <input type="text" class="form-control" id="validationCustom01" name="username" required>
        <div class="invalid-feedback">
          Por favor, insira seu nome de usuário.
        </div>
      </div>
    </div>
    <div>
      <div class="col-md-4  mx-auto">
        <label for="validationCustom02" class="form-label">Senha</label>
        <input type="password" class="form-control" id="validationCustom02" name="password" required>
        <div class="invalid-feedback">
          Por favor, insira sua senha.
        </div>
      </div>
    </div>
    <div class="col-12">
      <input class="btn btn-primary" type="submit" value="Entrar" name="submit"/>
      <a class="btn btn-primary" href="criarUsuario.php">Criar usuário</a>
    <div class="col-12">

    <?php 
      // Iniciar a sessão
      session_start();

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $username = $_POST["username"];
          $password = $_POST["password"];

          $conexao = getConection();
          if (!$conexao) {
              die("Erro ao conectar ao banco de dados.");
          }

          $usuario = getUsuarioByUsername($conexao, $username);
          if ($usuario && mysqli_num_rows($usuario) > 0) {
              $row = mysqli_fetch_assoc($usuario);
              if ($row['senha'] == $password) {
                  $_SESSION['usuario_id'] = $row['id'];
                  $_SESSION['usuario_nome'] = $row['nome'];
                  echo "Login realizado com sucesso!";
                  header("Location: Feed.php");
                  exit();
              }
          }
          echo "Usuário ou senha incorretos!";
          mysqli_close($conexao);
      }
      ?>

    </div>
  </form>
</div>
<?php include("Rodape.php");?>

<?php 
  include("Cabecalho.php");
  include("../DB/conecta.php");
  include("../dao/usuariosDao.php");
?>

<div class="container">
  <form class="row g-3 needs-validation" id="criarForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
    <div>
      <div class="col-md-4 mx-auto">
        <label for="nome" class="form-label">Nome de Usuário</label>
        <input type="text" class="form-control" id="nome" name="username" required>
      </div>
    </div>
    <div>
      <div class="col-md-4  mx-auto">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="password" required>
      </div>
    </div>
    <div>
      <div class="col-md-4  mx-auto">
        <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
        <input type="password" class="form-control" id="confirmarSenha" name="passwordConfirm" required>
      </div>
    </div>
    <div class="col-12">
        <a class="btn btn-primary" href="Login.php">Voltar</a>
        <input class="btn btn-primary" type="submit" value="Criar" name="submit"/>
    </div>
  </form>
</div>

<?php 
  // Iniciar a sessão
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];

    if ($password !== $passwordConfirm) {
        echo "As senhas não coincidem";
    } else {
        $conexao = getConection();
        if (!$conexao) {
            die("Erro ao conectar ao banco de dados.");
        }

        $usuario = getUsuarioByUsername($conexao, $username);
        if ($usuario && mysqli_num_rows($usuario) > 0) {
            echo "Usuário já existe";
        } else {
            $resposta = criarUsuario($conexao, $username, $password);
            echo $resposta;
            header("Location: Login.php");
        }
    }
  }
?>



<?php include("Rodape.php");?>
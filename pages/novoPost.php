<div class="container">
  <form class="row g-3 needs-validation" action="" method="post" novalidate>
    <div class="col-md-12">
      <h2>O que está pensando <?php session_start(); echo $_SESSION['usuario_nome'];?></h2>
      <input type="text" class="form-control" id="validationCustom03" name="conteudo" required>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit" name="publicar">Publicar</button>
    </div>
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["publicar"])) {
    if (!empty($_POST["conteudo"])) {
        // Captura o conteúdo da nova publicação
        $conteudo = $_POST["conteudo"];

        // Conecta ao banco de dados (substitua as credenciais conforme necessário)
        $conexao = getConection();

        // Verifica se a conexão foi bem sucedida
        if (!$conexao) {
            die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
        }

        // Prepara a consulta SQL para inserir a nova publicação
        // Substitua '$usuario_id' pelo id do usuário logado
        $query = "INSERT INTO publicacoes (pai, conteudo, usuario, data) VALUES (null, '$conteudo', '$usuario_id',  NOW())";

        // Executa a consulta
        if (mysqli_query($conexao, $query)) {
            // A publicação foi inserida com sucesso
            echo "Nova publicação inserida com sucesso!";
        } else {
            // Erro ao inserir a publicação
            echo "Erro ao inserir a nova publicação: " . mysqli_error($conexao);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
    } else {
        // Caso o campo de conteúdo da publicação esteja vazio
        echo "Por favor, insira o conteúdo da sua nova publicação.";
    }
}
?>

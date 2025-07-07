<?php
// Inclua suas funções aqui
include("../DB/conecta.php");
include("../dao/publicacoesDao.php");

// Configurar a conexão com o banco de dados
$connection = getConection();

// Verificar se a conexão foi bem-sucedida
if (!$connection) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Teste para getPosts
$usuario_id = 1; // ID de teste
$result = getPosts($connection, $usuario_id);
if ($result) {
    echo "getPosts: " . mysqli_num_rows($result) . " resultados encontrados.<br>";
} else {
    echo "getPosts: Erro na consulta.<br>";
}

// Teste para getSelfPosts
$result = getSelfPosts($connection, $usuario_id);
if ($result) {
    echo "getSelfPosts: " . mysqli_num_rows($result) . " resultados encontrados.<br>";
} else {
    echo "getSelfPosts: Erro na consulta.<br>";
}

// Teste para getPostsById
$id = 1; // ID de teste
$result = getPostsById($connection, $id);
if ($result) {
    echo "getPostsById: " . mysqli_num_rows($result) . " resultados encontrados.<br>";
} else {
    echo "getPostsById: Erro na consulta.<br>";
}

// Teste para getPostsSegundario
$pai_id = 1; // ID de teste
$result = getPostsSegundario($connection, $pai_id);
if ($result) {
    echo "getPostsSegundario: " . mysqli_num_rows($result) . " resultados encontrados.<br>";
} else {
    echo "getPostsSegundario: Erro na consulta.<br>";
}

// Fechar a conexão
$connection->close();
?>

<?php
// Inclua suas funções aqui
include("../DB/conecta.php");
include("../dao/usuariosDao.php");

// Configurar a conexão com o banco de dados
$connection = getConection();

// Verificar se a conexão foi bem-sucedida
if (!$connection) {
    die("Conexão falhou: " . mysqli_connect_error());
}

// Teste para getUsuarios
$result = getUsuarios($connection);
if ($result) {
    echo "getUsuarios: " . mysqli_num_rows($result) . " usuários encontrados.<br>";
} else {
    echo "getUsuarios: Erro na consulta.<br>";
}

// Teste para getUsuarioByUsername
$username = 'usuario_teste'; // Substitua pelo nome de um usuário existente
$result = getUsuarioByUsername($connection, $username);
if ($result) {
    echo "getUsuarioByUsername: " . mysqli_num_rows($result) . " resultado(s) encontrado(s) para o usuário '$username'.<br>";
} else {
    echo "getUsuarioByUsername: Erro na consulta.<br>";
}

// Teste para criarUsuario
$newUsername = 'novo_usuario'; // Nome do novo usuário
$newPassword = 'senha123'; // Senha do novo usuário
$result = criarUsuario($connection, $newUsername, $newPassword);
echo "criarUsuario: $result<br>";

// Teste para getSeguindo
$seguidorId = 1; // ID do seguidor
$result = getSeguindo($connection, $seguidorId);
if ($result) {
    echo "getSeguindo: " . mysqli_num_rows($result) . " seguindo(s).<br>";
} else {
    echo "getSeguindo: Erro na consulta.<br>";
}

// Teste para getSeguidor
$seguidoId = 1; // ID do seguido
$result = getSeguidor($connection, $seguidoId);
if ($result) {
    echo "getSeguidor: " . mysqli_num_rows($result) . " seguidor(es).<br>";
} else {
    echo "getSeguidor: Erro na consulta.<br>";
}

// Teste para delSeguir
$seguirId = 1; // ID do relacionamento a ser excluído
$result = delSeguir($connection, $seguirId);
echo "delSeguir: " . ($result ? "Exclusão bem-sucedida." : "Erro na exclusão.") . "<br>";

// Teste para getSeguir
$seguidorId = 1; // ID do seguidor
$seguidoId = 2; // ID do seguido
$result = getSeguir($connection, $seguidorId, $seguidoId);
if ($result) {
    echo "getSeguir: " . mysqli_num_rows($result) . " resultado(s) encontrado(s).<br>";
} else {
    echo "getSeguir: Erro na consulta.<br>";
}

// Teste para addSeguir
$result = addSeguir($connection, $seguidorId, $seguidoId);
echo "addSeguir: " . ($result ? "Seguiu com sucesso!" : "Erro ao seguir.") . "<br>";

// Fechar a conexão
$connection->close();
?>

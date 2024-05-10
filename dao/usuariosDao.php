<?php
function getUsuarios($connection) {
    $query = "SELECT * FROM usuarios";
    return mysqli_query($connection, $query);
}

function getUsuarioByUsername($conexao, $username) {
    $query = "SELECT * FROM usuarios WHERE nome = '$username'";
    $resultado = mysqli_query($conexao, $query);
    return $resultado;
}

function criarUsuario($conexao, $username, $password) {
    $query = "INSERT INTO usuarios (nome, senha) VALUES ('$username', '$password')";
    if (mysqli_query($conexao, $query)) {
        return "Usuário criado com sucesso.";
    } else {
        return "Erro ao criar usuário: " . mysqli_error($conexao);
    }
}

function getSeguindo($conexao,$id) {
    $query = "SELECT s.id, u.nome AS seguido
    FROM usuarios u
    JOIN seguir s ON u.id = s.seguido_id
    WHERE s.seguidor_id = '$id';
    ";
    return mysqli_query($conexao, $query);
}


function getSeguidor($conexao,$id) {
    $query = "SELECT s.id, u.nome AS seguidor
    FROM usuarios u
    JOIN seguir s ON u.id = s.seguidor_id
    WHERE s.seguido_id = '$id'
    ";
    return mysqli_query($conexao, $query);
}

function delSeguir($conexao, $id) {

    $query = "DELETE FROM seguir WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $query);

    // Verificar se houve erro na execução da consulta
    if ($resultado) {
        echo "Exclusão bem-sucedida!";
    } else {
        // Se houver um erro na consulta, exiba o erro
        echo "Erro na exclusão: " . mysqli_error($conexao);
    }

    return $resultado;
}

function getSeguir($conexao,$seguidor,$seguido) {
    $query = "SELECT * FROM seguir
    WHERE seguir.seguido_id = '$seguido'
    AND seguir.seguidor_id = '$seguidor'
    ";
    return mysqli_query($conexao, $query);
}

function addSeguir($conexao,$seguidor,$seguido) {
    $query = "INSERT INTO seguir (seguidor_id, seguido_id, data_seguindo) VALUES
    ('$seguidor', '$seguido', CURRENT_DATE);";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        echo "Seguiu com sucesso!";
    } else {
        // Se houver um erro na consulta, exiba o erro
        echo "Erro ao seguir: " . mysqli_error($conexao);
    }

    return $resultado; 
}



?>

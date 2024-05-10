<?php 
    function getPosts($connection, $usuario_id) {
        $query = "  SELECT publicacoes.*, usuarios.nome
                    FROM publicacoes 
                    LEFT JOIN seguir ON publicacoes.usuario = seguir.seguido_id 
                    JOIN usuarios ON publicacoes.usuario = usuarios.id
                    WHERE seguir.seguidor_id = '$usuario_id'
                    AND publicacoes.pai IS NULL
                    ORDER BY publicacoes.data DESC";

                    
        return mysqli_query($connection, $query);
    }

    function getSelfPosts($connection, $usuario_id) {
        $query = "  SELECT publicacoes.*
                    FROM publicacoes 
                    WHERE publicacoes.usuario = '$usuario_id'
                    AND publicacoes.pai IS NULL
                    ORDER BY publicacoes.data DESC";

                    
        return mysqli_query($connection, $query);
    }

    function getPostsById($connection, $id) {
        $query = "SELECT publicacoes.*, usuarios.nome 
              FROM publicacoes 
              JOIN usuarios ON publicacoes.usuario = usuarios.id
              WHERE publicacoes.id = $id";
        
        return mysqli_query($connection, $query);
    }

    function getPostsSegundario($connection, $pai_id) {
        $query = "  SELECT publicacoes.*, usuarios.nome
                    FROM publicacoes, usuarios
                    WHERE publicacoes.pai = '$pai_id'
                    AND usuarios.id = publicacoes.usuario
                    ORDER BY publicacoes.data DESC";

                    
        return mysqli_query($connection, $query);
    }
    
?>
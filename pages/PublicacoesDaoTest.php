<?php

use PHPUnit\Framework\TestCase;

class PublicacoesDaoTest extends TestCase {
    protected $connection;

    protected function setUp(): void {
        // Simula a conexão com o banco de dados
        $this->connection = $this->createMock(mysqli::class);
    }

    public function testGetPosts() {
        $usuario_id = 1;

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_all')->willReturn([
            ['id' => 1, 'nome' => 'João'],
            ['id' => 2, 'nome' => 'Maria']
        ]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $posts = getPosts($this->connection, $usuario_id);

        // Verifica se o resultado está correto
        $this->assertNotNull($posts);
        $this->assertIsObject($posts);
    }

    public function testGetSelfPosts() {
        $usuario_id = 1;

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_all')->willReturn([
            ['id' => 1, 'usuario' => $usuario_id, 'conteudo' => 'Post 1'],
            ['id' => 2, 'usuario' => $usuario_id, 'conteudo' => 'Post 2']
        ]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $posts = getSelfPosts($this->connection, $usuario_id);

        // Verifica se o resultado está correto
        $this->assertNotNull($posts);
        $this->assertIsObject($posts);
    }

    public function testGetPostsById() {
        $id = 1;

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_assoc')->willReturn(['id' => $id, 'nome' => 'João']);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $post = getPostsById($this->connection, $id);

        // Verifica se o resultado está correto
        $this->assertNotNull($post);
        $this->assertIsObject($post);
    }

    public function testGetPostsSegundario() {
        $pai_id = 1;

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_all')->willReturn([
            ['id' => 1, 'pai' => $pai_id, 'conteudo' => 'Post secundário 1'],
            ['id' => 2, 'pai' => $pai_id, 'conteudo' => 'Post secundário 2']
        ]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $posts = getPostsSegundario($this->connection, $pai_id);

        // Verifica se o resultado está correto
        $this->assertNotNull($posts);
        $this->assertIsObject($posts);
    }
}

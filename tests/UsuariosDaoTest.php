<?php

use PHPUnit\Framework\TestCase;

class UsuariosDaoTest extends TestCase {
    protected $connection;

    protected function setUp(): void {
        // Simula a conexão com o banco de dados
        $this->connection = $this->createMock(mysqli::class);
    }

    public function testGetUsuarios() {
        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_all')->willReturn([
            ['id' => 1, 'nome' => 'João'],
            ['id' => 2, 'nome' => 'Maria']
        ]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $usuarios = getUsuarios($this->connection);

        // Verifica se o resultado está correto
        $this->assertNotNull($usuarios);
        $this->assertIsObject($usuarios);
    }

    public function testGetUsuarioByUsername() {
        $username = 'João';

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_assoc')->willReturn(['id' => 1, 'nome' => $username]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $usuario = getUsuarioByUsername($this->connection, $username);

        // Verifica se o resultado está correto
        $this->assertNotNull($usuario);
        $this->assertIsObject($usuario);
    }

    public function testCriarUsuario() {
        $username = 'teste';
        $password = 'senha';

        // Simula o resultado da consulta de inserção
        $this->connection->method('query')->willReturn(true);

        // Chama a função que está sendo testada
        $resultado = criarUsuario($this->connection, $username, $password);

        // Verifica se a mensagem de sucesso está correta
        $this->assertEquals("Usuário criado com sucesso.", $resultado);
    }

    public function testCriarUsuarioErro() {
        $username = 'teste';
        $password = 'senha';

        // Simula o resultado da consulta de inserção com erro
        $this->connection->method('query')->willReturn(false);
        $this->connection->method('error')->willReturn('Erro de teste');

        // Chama a função que está sendo testada
        $resultado = criarUsuario($this->connection, $username, $password);

        // Verifica se a mensagem de erro está correta
        $this->assertStringContainsString("Erro ao criar usuário:", $resultado);
    }

    public function testGetSeguindo() {
        $id = 1;

        // Simula o resultado da consulta
        $result = $this->createMock(mysqli_result::class);
        $result->method('fetch_all')->willReturn([
            ['id' => 1, 'seguido' => 'Maria'],
            ['id' => 2, 'seguido' => 'José']
        ]);

        // Configura o método mysqli_query para retornar o resultado simulado
        $this->connection->method('query')->willReturn($result);

        // Chama a função que está sendo testada
        $seguindo = getSeguindo($this->connection, $id);

        // Verifica se o resultado está correto
        $this->assertNotNull($seguindo);
        $this->assertIsObject($seguindo);
    }
}

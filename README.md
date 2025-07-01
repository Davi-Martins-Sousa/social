# Disciplina de Engenharia de Software I -- Davi Martins de Sousa e Gabriel Ferreira Silveira
# Implementação de uma rede social de texto
# para abrir o xampp: sudo /opt/lampp/./manager-linux-x64.run
# para desativar o mysql: sudo systemctl stop mysql

# teste de unidade
  1. Instalação do PHPUnit
    composer require --dev phpunit/phpunit

  2. Estrutura do Projeto
    social/dao
        publicacoesDao.php
        usuariosDao.php
    social/tests
        PublicacoesDaoTest.php
        UsuariosDaoTest.php

  3. Criando Testes para publicacoesDao.php
  4. Criando Testes para usuariosDao.php
  5. Executando os Testes
     vendor/bin/phpunit tests

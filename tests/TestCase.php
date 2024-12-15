<?php

namespace Tests;
use Core\Database\Database;
use PHPUnit\Framework\TestCase as FrameworkTestCase;

class TestCase extends FrameworkTestCase
{
  protected function setUp(): void
  {
    // Criação e migração do banco de dados podem ser feitas aqui
    Database::create();
    Database::migrate();
  }

  protected function tearDown(): void
  {
    // O banco de dados pode ser removido aqui, se necessário
    // Database::drop();
  }

  protected function getOutput(callable $callable): string
  {
    ob_start();
    $callable();
    return ob_get_clean();
  }
}

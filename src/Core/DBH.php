<?php

namespace App\Core;

use \PDO;

class DBH
{
    private string $host;
    private string $name;
    private string $user;
    private string $pwd;
    private string $charset;
    private string $port;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->name = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pwd = $_ENV['DB_PWD'];
        $this->charset = $_ENV['DB_CHARSET'];
        $this->port = $_ENV['DB_PORT'];
    }

    protected function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};port={$this->port};charset={$this->charset}";
        $pdo = new PDO($dsn,  $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public function get_connection()
    {
        return $this->connect();
    }
}

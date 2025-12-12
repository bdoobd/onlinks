<?php

namespace App\Core;

use \PDO;
use \PDOStatement;

class DBH
{
    private string $host;
    private string $name;
    private string $user;
    private string $pwd;
    private string $charset;
    private string $port;
    public PDO $pdo;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->name = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->pwd = $_ENV['DB_PWD'];
        $this->charset = $_ENV['DB_CHARSET'];
        $this->port = $_ENV['DB_PORT'];

        $this->connect();
    }
    /**
     * Cоздать объект подключения к базе данных
     * 
     * @return void
     */
    protected function connect()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->name};port={$this->port};charset={$this->charset}";
        $this->pdo = new PDO($dsn,  $this->user, $this->pwd);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Подготовка сторки SQL для запроса к базе данных
     * 
     * @param string $sql Сторка подготовленного запроса
     * 
     * @return bool|PDOStatement
     */
    public function prepare(string $sql): bool|PDOStatement
    {
        return $this->pdo->prepare($sql);
    }

    public function query(string $sql): bool|PDOStatement
    {
        return $this->pdo->query($sql);
    }
}

<?php

namespace App\Database;

use PDO;
use PDOStatement;

final class Database
{
    private ?PDO $connection = null;

    public function __construct(
        private readonly string $host,
        private readonly string $dbname,
        private readonly string $user,
        private readonly ?string $pass = null,
        private readonly ?array $options = null,
    ) {}

    public function getConnection(): PDO
    {
        if (!$this->connection) {
            $this->connection = new PDO($this->getDsn(), $this->user, $this->pass, $this->options);
        }

        return $this->connection;
    }

    public function query(string $query, array $bind = []): PDOStatement
    {
        $statement = $this->getConnection()->prepare($query);
        $statement->execute($bind);

        return $statement;
    }

    private function getDsn()
    {
        return 'mysql:host='.$this->host.';dbname='.$this->dbname;
    }
}

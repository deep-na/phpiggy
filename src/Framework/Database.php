<?php

declare(strict_types=1);

namespace Framework;


use PDO;
use PDOException, PDOStatement;


class Database
{
    public PDO $connection;
    private PDOStatement $stmt;

    function __construct(string $driver, array $config, string $user, string $password)
    {

        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";


        try {
            $this->connection = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            die("Unable to connect to database");
        }
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    function count()
    {
        return $this->stmt->fetchColumn();
    }
}

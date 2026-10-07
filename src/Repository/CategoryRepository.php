<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;

class CategoryRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    public function getAll(): array
    {
        $stmt = $this->connection->query(
            'SELECT * FROM categories ORDER BY name'
        );

        return $stmt->fetchAll();
    }
}
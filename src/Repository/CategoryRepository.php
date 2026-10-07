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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById(int $id): ?array
    {
        $stmt = $this->connection->prepare(
            'SELECT *
         FROM categories
         WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        return $category ?: null;
    }
}
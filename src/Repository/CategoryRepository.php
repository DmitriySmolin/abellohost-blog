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

    public function getWithArticles(): array
    {
        $stmt = $this->connection->query(
            'SELECT c.*
         FROM categories c
         WHERE EXISTS (
             SELECT 1
             FROM article_category ac
             WHERE ac.category_id = c.id
         )
         ORDER BY c.name'
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
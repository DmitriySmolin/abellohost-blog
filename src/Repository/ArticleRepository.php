<?php

declare(strict_types=1);

namespace App\Repository;

use PDO;

class ArticleRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    public function getLatest(int $limit = 3): array
    {
        $stmt = $this->connection->prepare(
            'SELECT *
             FROM articles
             ORDER BY created_at DESC
             LIMIT :limit'
        );

        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
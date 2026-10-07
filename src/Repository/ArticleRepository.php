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

    public function getLatestByCategory(
        int $categoryId,
        int $limit = 3
    ): array {
        $stmt = $this->connection->prepare(
            'SELECT a.*
             FROM articles a
             INNER JOIN article_category ac
                 ON ac.article_id = a.id
             WHERE ac.category_id = :category_id
             ORDER BY a.published_at DESC
             LIMIT :limit'
        );

        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
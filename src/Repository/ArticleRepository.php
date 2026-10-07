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

    public function getByCategory(
        int $categoryId,
        string $sort,
        int $limit,
        int $offset
    ): array {
        $orderBy = match ($sort) {
            'views' => 'a.views DESC',
            default => 'a.published_at DESC',
        };

        $stmt = $this->connection->prepare(
            "SELECT a.*
     FROM articles a
     INNER JOIN article_category ac
         ON ac.article_id = a.id
     WHERE ac.category_id = :category_id
     ORDER BY {$orderBy}
     LIMIT :limit
     OFFSET :offset"
        );

        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByCategory(int $categoryId): int
    {
        $stmt = $this->connection->prepare(
            'SELECT COUNT(*)
         FROM article_category
         WHERE category_id = :category_id'
        );

        $stmt->execute([
            'category_id' => $categoryId,
        ]);

        return (int) $stmt->fetchColumn();
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->connection->prepare(
            'SELECT *
         FROM articles
         WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
        ]);

        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        return $article ?: null;
    }
    public function incrementViews(int $id): void
    {
        $stmt = $this->connection->prepare(
            'UPDATE articles
         SET views = views + 1
         WHERE id = :id'
        );

        $stmt->execute([
            'id' => $id,
        ]);
    }
    public function getCategoryId(int $articleId): ?int
    {
        $stmt = $this->connection->prepare(
            'SELECT category_id
         FROM article_category
         WHERE article_id = :article_id
         LIMIT 1'
        );

        $stmt->execute([
            'article_id' => $articleId,
        ]);

        $categoryId = $stmt->fetchColumn();

        return $categoryId
            ? (int) $categoryId
            : null;
    }
    public function getRelated(
        int $articleId,
        int $categoryId,
        int $limit = 3
    ): array {
        $stmt = $this->connection->prepare(
            'SELECT a.*
         FROM articles a
         INNER JOIN article_category ac
             ON ac.article_id = a.id
         WHERE ac.category_id = :category_id
           AND a.id != :article_id
         ORDER BY a.published_at DESC
         LIMIT :limit'
        );

        $stmt->bindValue(
            ':category_id',
            $categoryId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':article_id',
            $articleId,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':limit',
            $limit,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
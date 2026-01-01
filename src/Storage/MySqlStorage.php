<?php

namespace Swapnil\UrlShortener\Storage;

use PDO;
use Swapnil\UrlShortener\Contracts\StorageInterface;

class MySqlStorage implements StorageInterface
{
    public function __construct(private PDO $pdo) {}

    public function save(string $originalUrl, string $code): void
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO short_urls (original_url, short_code) VALUES (?, ?)"
        );
        $stmt->execute([$originalUrl, $code]);
    }

    public function findByCode(string $code): ?string
    {
        $stmt = $this->pdo->prepare(
            "SELECT original_url FROM short_urls WHERE short_code=?"
        );
        $stmt->execute([$code]);

        return $stmt->fetchColumn() ?: null;
    }

    public function incrementClicks(string $code): void
    {
        $this->pdo->prepare(
            "UPDATE short_urls SET clicks = clicks + 1 WHERE short_code=?"
        )->execute([$code]);
    }
}

<?php

namespace Swapnil\UrlShortener\Contracts;

interface StorageInterface
{
    public function save(string $originalUrl, string $code): void;

    public function findByCode(string $code): ?string;

    public function incrementClicks(string $code): void;
}

<?php

namespace Swapnil\UrlShortener;

use Swapnil\UrlShortener\Contracts\StorageInterface;
use Swapnil\UrlShortener\Encoders\Base62Encoder;
use InvalidArgumentException;

class UrlShortener
{
    public function __construct(
        private StorageInterface $storage,
        private Base62Encoder $encoder
    ) {}

    public function shorten(string $url, int $id): string
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Invalid URL");
        }

        $code = $this->encoder->encode($id);
        $this->storage->save($url, $code);

        return $code;
    }

    public function resolve(string $code): string
    {
        $url = $this->storage->findByCode($code);

        if (!$url) {
            throw new Exceptions\UrlNotFoundException();
        }

        $this->storage->incrementClicks($code);

        return $url;
    }
}

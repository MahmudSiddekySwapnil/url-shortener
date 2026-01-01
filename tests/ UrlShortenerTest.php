<?php

use PHPUnit\Framework\TestCase;
use Swapnil\UrlShortener\UrlShortener;
use Swapnil\UrlShortener\Encoders\Base62Encoder;
use Swapnil\UrlShortener\Contracts\StorageInterface;

class UrlShortenerTest extends TestCase
{
    public function test_it_generates_short_code()
    {
        $storage = $this->createMock(StorageInterface::class);
        $encoder = new Base62Encoder();

        $shortener = new UrlShortener($storage, $encoder);

        $code = $shortener->shorten('https://example.com', 100);

        $this->assertNotEmpty($code);
    }
}
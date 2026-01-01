<?php

namespace Swapnil\UrlShortener\Encoders;

class Base62Encoder
{
    private string $chars =
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function encode(int $number): string
    {
        $base = strlen($this->chars);
        $result = '';

        while ($number > 0) {
            $result = $this->chars[$number % $base] . $result;
            $number = intdiv($number, $base);
        }

        return $result;
    }
}

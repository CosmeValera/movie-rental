<?php

declare(strict_types=1);

namespace Kata;

readonly class Movie
{
    const int REGULAR = 0;
    const int NEW_RELEASE = 1;
    const int CHILDRENS = 2;

    public function __construct(
        private string $title,
        private int $priceCode
    ) {
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

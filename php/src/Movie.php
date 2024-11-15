<?php

declare(strict_types=1);

namespace Kata;

class Movie
{
    const int REGULAR = 0;
    const int NEW_RELEASE = 1;
    const int CHILDRENS = 2;
    private int $priceCode;
    private string $title;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $arg): void
    {
        $this->priceCode = $arg;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}

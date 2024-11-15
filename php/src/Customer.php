<?php

declare(strict_types=1);

namespace Kata;

class Customer
{
    /**
     * @param list<Rental> $rentals
     */
    public function __construct(
        private readonly string $name,
        private array $rentals = [],
    ) {
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function calculateRentalPrice(Rental $rental): float
    {
        $thisAmount = 0;
        // determine amounts for each rental
        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                // base price
                $thisAmount += 2;
                if ($rental->getDaysRented() > 2) {
                    $thisAmount += ($rental->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                // base price
                $thisAmount += 1.5;
                if ($rental->getDaysRented() > 3) {
                    $thisAmount += ($rental->getDaysRented() - 3) * 1.5;
                }
                break;
        }
        return $thisAmount;
    }
    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->name . "\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $this->calculateRentalPrice($rental);

            // add frequent renter points
            $frequentRenterPoints++;
            // add bonus for a two day new release rental
            if ($rental->getDaysRented() > 1 && ($rental->getMovie()->getPriceCode() === Movie::NEW_RELEASE)) {
                $frequentRenterPoints++;
            }

            // show figures for this rental
            $result .= sprintf("\t%s\t%1.1f\n", $rental->getMovie()->getTitle(), $thisAmount);
            $totalAmount += $thisAmount;
        }

        // add footer lines
        $result .= sprintf("Amount owed is %1.1f\n", $totalAmount);
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";

        return $result;
    }

}

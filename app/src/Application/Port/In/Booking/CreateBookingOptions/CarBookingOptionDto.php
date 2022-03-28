<?php

declare(strict_types=1);

namespace App\Application\Port\In\Booking\CreateBookingOptions;

use App\Domain\CarBooking\CarBookingVo;

class CarBookingOptionDto
{

    private string $brand;
    private string $model;
    private int $stock;
    private float $totalPrice;
    private float $averagePrice;

    public function __construct(CarBookingVo $carBooking)
    {
        $this->brand = $carBooking->getCarStock()->getBrand()->getValue();
        $this->model = $carBooking->getCarStock()->getModel()->getModel();
        $this->stock = $carBooking->getCarStock()->getStock();
        $this->totalPrice = $carBooking->getTotalPrice();
        $this->averagePrice = $carBooking->getAveragePrice();
    }

    public function getBrand(): int|string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getAveragePrice(): float
    {
        return $this->averagePrice;
    }

    public function setAveragePrice(float $averagePrice): void
    {
        $this->averagePrice = $averagePrice;
    }


}
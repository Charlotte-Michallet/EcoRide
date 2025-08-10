<?php
namespace App\Entity;

class Trip
{
    protected int $id;
    protected int $car_id;
    protected string $departure_city;
    protected string $arrival_city;
    protected string $departure_date;
    protected string $departure_hour;
    protected string $arrival_time;
    protected int $price;
    protected int $num_seats;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of car_id
     */
    public function getCarId(): int
    {
        return $this->car_id;
    }

    /**
     * Set the value of car_id
     */
    public function setCarId(int $car_id): self
    {
        $this->car_id = $car_id;

        return $this;
    }

    /**
     * Get the value of departure_city
     */
    public function getDepartureCity(): string
    {
        return $this->departure_city;
    }

    /**
     * Set the value of departure_city
     */
    public function setDepartureCity(string $departure_city): self
    {
        $this->departure_city = $departure_city;

        return $this;
    }

    /**
     * Get the value of arrival city
     */
    public function getArrivalCity(): string
    {
        return $this->arrival_city;
    }

    /**
     * Set the value of arrival city
     */
    public function setArrivalCity(string $arrival_city): self
    {
        $this->arrival_city = $arrival_city;

        return $this;
    }

    /**
     * Get the value of departure_date
     */
    public function getDepartureDate(): string
    {
        return $this->departure_date;
    }

    /**
     * Set the value of departure_date
     */
    public function setDepartureDate(string $departure_date): self
    {
        $this->departure_date = $departure_date;

        return $this;
    }

    /**
     * Get the value of departure_hour
     */
    public function getDepartureHour(): string
    {
        return $this->departure_hour;
    }

    /**
     * Set the value of departure_hour
     */
    public function setDepartureHour(string $departure_hour): self
    {
        $this->departure_hour = $departure_hour;

        return $this;
    }

    /**
     * Get the value of arrival_time
     */
    public function getArrivalTime(): string
    {
        return $this->arrival_time;
    }

    /**
     * Set the value of arrival_time
     */
    public function setArrivalTime(string $arrival_time): self
    {
        $this->arrival_time = $arrival_time;

        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of num_seats
     */
    public function getNumSeats(): int
    {
        return $this->num_seats;
    }

    /**
     * Set the value of num_seats
     */
    public function setNumSeats(int $num_seats): self
    {
        $this->num_seats = $num_seats;

        return $this;
    }
}

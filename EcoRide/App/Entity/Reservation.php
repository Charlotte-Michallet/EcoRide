<?php
namespace App\Entity;

class Reservation
{
    protected int $id;
    protected string $numReser;
    protected int $carSharingId;
    protected int $userId;
    protected string $reservationDate;
    protected int $numSeatsBookes;
    protected string $paymentStatus;
    protected string $status;
    protected string $departure_city;
    protected string $arrival_city;
    protected string $departure_date;
    protected string $departureDateFormat;
    protected string $departure_hour;
    protected string $arrival_time;
    protected ?int $price;
    protected ?int $totalprice;
    protected int $car_id;
    protected string $statusCarSharing;
    protected int $kilometers;
    protected string $travel_time;
    protected string $username;
    protected string $brand;
    protected string $model;
    protected string $color;
    protected string $energie;
    protected int $driverId;

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
     * Get the value of numReser
     */
    public function getNumReser(): string
    {
        return $this->numReser;
    }

    /**
     * Set the value of numReser
     */
    public function setNumReser(string $numReser): self
    {
        $this->numReser = $numReser;

        return $this;
    }

    /**
     * Get the value of carSharingId
     */
    public function getCarSharingId(): int
    {
        return $this->carSharingId;
    }

    /**
     * Set the value of carSharingId
     */
    public function setCarSharingId(int $carSharingId): self
    {
        $this->carSharingId = $carSharingId;

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get the value of numSeatsBookes
     */
    public function getNumSeatsBookes(): int
    {
        return $this->numSeatsBookes;
    }

    /**
     * Set the value of numSeatsBookes
     */
    public function setNumSeatsBookes(int $numSeatsBookes): self
    {
        $this->numSeatsBookes = $numSeatsBookes;

        return $this;
    }

    /**
     * Get the value of paymentStatus
     */
    public function getPaymentStatus(): string
    {
        return $this->paymentStatus;
    }

    /**
     * Set the value of paymentStatus
     */
    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of departure_city
     */
    public function getDepartCity(): string
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
     * Get the value of arrival_city
     */
    public function getArriCity(): string
    {
        return $this->arrival_city;
    }

    /**
     * Set the value of arrival_city
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
    public function getDepartHour(): string
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
    public function getArrTime(): string
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
    public function getPrices(): ?int
    {
        return $this->price;
    }

    /**
     * Set the value of price
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

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
     * Get the value of statusCarSharing
     */
    public function getStatusCarSharing(): string
    {
        return $this->statusCarSharing;
    }

    /**
     * Set the value of statusCarSharing
     */
    public function setStatusCarSharing(string $statusCarSharing): self
    {
        $this->statusCarSharing = $statusCarSharing;

        return $this;
    }

    /**
     * Get the value of kilometers
     */
    public function getKilometer(): int
    {
        return $this->kilometers;
    }

    /**
     * Set the value of kilometers
     */
    public function setKilometers(int $kilometers): self
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    /**
     * Get the value of travel_time
     */
    public function getTravelTime(): string
    {
        return $this->travel_time;
    }

    /**
     * Set the value of travel_time
     */
    public function setTravelTime(string $travel_time): self
    {
        $this->travel_time = $travel_time;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of brand
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * Set the value of brand
     */
    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get the value of model
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * Set the value of model
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the value of color
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of departureDateFormat
     */
    public function getDepartureDateFormat(): string
    {
        return $this->departureDateFormat;
    }

    /**
     * Set the value of departureDateFormat
     */
    public function setDepartureDateFormat(string $departureDateFormat): self
    {
        $this->departureDateFormat = $departureDateFormat;

        return $this;
    }

    /**
     * Get the value of totalprice
     */
    public function getTotalprice(): ?int
    {
        return $this->totalprice;
    }

    /**
     * Set the value of totalprice
     */
    public function setTotalprice(?int $totalprice): self
    {
        $this->totalprice = $totalprice;

        return $this;
    }

    /**
     * Get the value of energie
     */
    public function getEnergie(): string
    {
        return $this->energie;
    }

    /**
     * Set the value of energie
     */
    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * Get the value of driverId
     */
    public function getDriverId(): int
    {
        return $this->driverId;
    }

    /**
     * Set the value of driverId
     */
    public function setDriverId(int $driverId): self
    {
        $this->driverId = $driverId;

        return $this;
    }
}

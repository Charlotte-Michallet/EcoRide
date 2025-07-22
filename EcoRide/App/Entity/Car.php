<?php

namespace App\Entity;

class Car
{
    protected int $id;
    protected string $brand;
    protected string $model;
    protected string $energy_type;
    protected int $num_seats;
    protected string $numplate;
    protected string $first_register_date;
    protected string $color;
    protected int $user_id;

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
     * Get the value of energy_type
     */
    public function getEnergyType(): string
    {
        return $this->energy_type;
    }

    /**
     * Set the value of energy_type
     */
    public function setEnergyType(string $energy_type): self
    {
        $this->energy_type = $energy_type;

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

    /**
     * Get the value of numplate
     */
    public function getNumplate(): string
    {
        return $this->numplate;
    }

    /**
     * Set the value of numplate
     */
    public function setNumplate(string $numplate): self
    {
        $this->numplate = $numplate;

        return $this;
    }

    /**
     * Get the value of first_register_date
     */
    public function getFirstRegisterDate(): string
    {
        return $this->first_register_date;
    }

    /**
     * Set the value of first_register_date
     */
    public function setFirstRegisterDate(string $first_register_date): self
    {
        $this->first_register_date = $first_register_date;

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
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}

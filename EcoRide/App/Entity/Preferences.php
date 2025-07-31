<?php
namespace App\Entity;

class Preferences
{
    private int $id;
    private int $user_id;
    private bool $smoking;
    private bool $animal;
    private string $description;

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

    /**
     * Get the value of smoking
     */
    public function isSmoking(): bool
    {
        return $this->smoking;
    }

    /**
     * Set the value of smoking
     */
    public function setSmoking(bool $smoking): self
    {
        $this->smoking = $smoking;

        return $this;
    }

    /**
     * Get the value of animal
     */
    public function isAnimal(): bool
    {
        return $this->animal;
    }

    /**
     * Set the value of animal
     */
    public function setAnimal(bool $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

<?php
namespace App\Entity;

class Preferences
{
    private int $id;
    private int $user_id;
    private ?bool $smoking_allowed = null;
    private ?bool $animal_allowed  = null;
    private ?string $description   = null;

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
     * Get the value of smoking_allowed
     */
    public function isSmokingAllowed(): ?bool
    {
        return $this->smoking_allowed;
    }

    /**
     * Set the value of smoking_allowed
     */
    public function setSmokingAllowed(?bool $smoking_allowed): self
    {
        $this->smoking_allowed = $smoking_allowed;

        return $this;
    }

    /**
     * Get the value of animal_allowed
     */
    public function isAnimalAllowed(): ?bool
    {
        return $this->animal_allowed;
    }

    /**
     * Set the value of animal_allowed
     */
    public function setAnimalAllowed(?bool $animal_allowed): self
    {
        $this->animal_allowed = $animal_allowed;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

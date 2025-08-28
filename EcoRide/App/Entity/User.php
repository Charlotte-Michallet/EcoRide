<?php
namespace App\Entity;

class User
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $date_of_birth;
    protected array|string $photo_url;
    protected ?int $credits;
    protected int $id_role;
    protected string $role;
    protected string $active;

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
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of date_of_birth
     */
    public function getDateOfBirth(): string
    {
        return $this->date_of_birth;
    }

    /**
     * Set the value of date_of_birth
     */
    public function setDateOfBirth(string $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    /**
     * Get the value of photo_url
     */
    public function getPhotoUrl(): array | string
    {
        return $this->photo_url;
    }

    /**
     * Set the value of photo_url
     */
    public function setPhotoUrl($photo_url): self
    {
        $this->photo_url = $photo_url;

        return $this;
    }

    /**
     * Get the value of credits
     */
    public function getCredits(): ?int
    {
        return $this->credits;
    }

    /**
     * Set the value of credits
     */
    public function setCredits(?int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * Get the value of id_role
     */
    public function getIdRole(): int
    {
        return $this->id_role;
    }

    /**
     * Set the value of id_role
     */
    public function setIdRole(int $id_role): self
    {
        $this->id_role = $id_role;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Set the value of role
     */
    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of active
     */
    public function getActive(): string
    {
        return $this->active;
    }

    /**
     * Set the value of active
     */
    public function setActive(string $active): self
    {
        $this->active = $active;

        return $this;
    }
}

<?php
namespace Admin\App\Entity;

class Company
{
    private int $id;
    private string $name;
    private string $adress;
    private string $email;
    private string $phone;
    private int $credits;

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
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of adress
     */
    public function getAdress(): string
    {
        return $this->adress;
    }

    /**
     * Set the value of adress
     */
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

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
     * Get the value of phone
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of credits
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    /**
     * Set the value of credits
     */
    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }
}

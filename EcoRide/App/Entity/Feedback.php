<?php
namespace App\Entity;

class Feedback
{
    protected int $id;
    protected int $user_id;
    protected int $note;
    protected string $feedback;
    protected string $status;
    protected int $reservationId;

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
     * Get the value of note
     */
    public function getNote(): int
    {
        return $this->note;
    }

    /**
     * Set the value of note
     */
    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of feedback
     */
    public function getFeedback(): string
    {
        return $this->feedback;
    }

    /**
     * Set the value of feedback
     */
    public function setFeedback(string $feedback): self
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get the value of stutus
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of stutus
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of reservationId
     */
    public function getReservationId(): int
    {
        return $this->reservationId;
    }

    /**
     * Set the value of reservationId
     */
    public function setReservationId(int $reservationId): self
    {
        $this->reservationId = $reservationId;

        return $this;
    }
}

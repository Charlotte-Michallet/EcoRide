<?php
namespace App\Entity;

class Feedback
{
    protected int $id;
    protected int $user_id;
    protected ?int $note        = null;
    protected ?string $feedback = null;
    protected string $status;
    protected string $trip_well;
    protected int $reservationId;
    protected int $number_reser;
    protected string $payment_status;
    protected string $status_reservation;
    protected int $totalPrice;
    protected string $passengers_username;
    protected string $passengers_email;
    protected string $passengers_photo;
    protected string $departure_city;
    protected string $arrival_city;
    protected string $departure_date;
    protected string $departure_hour;
    protected string $driver_username;
    protected string $driver_email;
    protected string $driver_photo;
    protected int $num_places;
    protected int $carSharingId;
    protected string $tripStatus;

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
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * Set the value of note
     */
    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of feedback
     */
    public function getFeedback(): ?string
    {
        return $this->feedback;
    }

    /**
     * Set the value of feedback
     */
    public function setFeedback(?string $feedback): self
    {
        $this->feedback = $feedback;

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

    /**
     * Get the value of number_reser
     */
    public function getNumberReser(): int
    {
        return $this->number_reser;
    }

    /**
     * Set the value of number_reser
     */
    public function setNumberReser(int $number_reser): self
    {
        $this->number_reser = $number_reser;

        return $this;
    }

    /**
     * Get the value of payment_status
     */
    public function getPaymentStatus(): string
    {
        return $this->payment_status;
    }

    /**
     * Set the value of payment_status
     */
    public function setPaymentStatus(string $payment_status): self
    {
        $this->payment_status = $payment_status;

        return $this;
    }

    /**
     * Get the value of status_reservation
     */
    public function getStatusReservation(): string
    {
        return $this->status_reservation;
    }

    /**
     * Set the value of status_reservation
     */
    public function setStatusReservation(string $status_reservation): self
    {
        $this->status_reservation = $status_reservation;

        return $this;
    }

    /**
     * Get the value of totalPrice
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * Set the value of totalPrice
     */
    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get the value of passengers_username
     */
    public function getPassengersUsername(): string
    {
        return $this->passengers_username;
    }

    /**
     * Set the value of passengers_username
     */
    public function setPassengersUsername(string $passengers_username): self
    {
        $this->passengers_username = $passengers_username;

        return $this;
    }

    /**
     * Get the value of passengers_photo
     */
    public function getPassengersPhoto(): string
    {
        return $this->passengers_photo;
    }

    /**
     * Set the value of passengers_photo
     */
    public function setPassengersPhoto(string $passengers_photo): self
    {
        $this->passengers_photo = $passengers_photo;

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
     * Get the value of arrival_city
     */
    public function getArrivalCity(): string
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
     * Get the value of driver_username
     */
    public function getDriverUsername(): string
    {
        return $this->driver_username;
    }

    /**
     * Set the value of driver_username
     */
    public function setDriverUsername(string $driver_username): self
    {
        $this->driver_username = $driver_username;

        return $this;
    }

    /**
     * Get the value of driver_photo
     */
    public function getDriverPhoto(): string
    {
        return $this->driver_photo;
    }

    /**
     * Set the value of driver_photo
     */
    public function setDriverPhoto(string $driver_photo): self
    {
        $this->driver_photo = $driver_photo;

        return $this;
    }

    /**
     * Get the value of num_places
     */
    public function getNumPlaces(): int
    {
        return $this->num_places;
    }

    /**
     * Set the value of num_places
     */
    public function setNumPlaces(int $num_places): self
    {
        $this->num_places = $num_places;

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
     * Get the value of tripStatus
     */
    public function getTripStatus(): string
    {
        return $this->tripStatus;
    }

    /**
     * Set the value of tripStatus
     */
    public function setTripStatus(string $tripStatus): self
    {
        $this->tripStatus = $tripStatus;

        return $this;
    }

    /**
     * Get the value of passengers_email
     */
    public function getPassengersEmail(): string
    {
        return $this->passengers_email;
    }

    /**
     * Set the value of passengers_email
     */
    public function setPassengersEmail(string $passengers_email): self
    {
        $this->passengers_email = $passengers_email;

        return $this;
    }

    /**
     * Get the value of driver_email
     */
    public function getDriverEmail(): string
    {
        return $this->driver_email;
    }

    /**
     * Set the value of driver_email
     */
    public function setDriverEmail(string $driver_email): self
    {
        $this->driver_email = $driver_email;

        return $this;
    }

    /**
     * Get the value of trip_well
     */
    public function getTripWell(): string
    {
        return $this->trip_well;
    }

    /**
     * Set the value of trip_well
     */
    public function setTripWell(string $trip_well): self
    {
        $this->trip_well = $trip_well;

        return $this;
    }
}

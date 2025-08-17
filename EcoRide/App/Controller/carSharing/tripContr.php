<?php
namespace App\Controller\CarSharing;

class TripContr
{
    protected int $id;
    protected string|array $departure_city;
    protected string|array $arrival_city;
    protected int $num_places;
    protected string $date_trip;
    protected string $hour_trip;
    protected string $arrival_time;
    protected int $price;
    protected int $car_id;
    protected array|string $info_itinary;
    protected int $user_id;
}

<?php
namespace App\Repository;

use App\Entity\Trip;

class TripRepository extends Repository
{
    public function CreateTrip($departure_city, $arrival_city, $num_places, $date_trip, $hour_trip, $price, $car_id, $arrival_time, $kilometers, $travel_time)
    {
        try {
            $status = "Programmé";
            $query  = $this->pdo->prepare("INSERT INTO car_sharing (car_id, departure_city, arrival_city, departure_date, departure_hour, arrival_time, price, num_seats, status, kilometers, travel_time) VALUES(:car_id, :departure_city, :arrival_city, :departure_date, :departure_hour, :arrival_time, :price, :num_seats, :status, :kilometers, :travel_time);");

            // bind value from form to query
            $query->bindValue(":car_id", $car_id, $this->pdo::PARAM_INT);
            $query->bindValue(":departure_city", $departure_city, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_city", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":departure_hour", $hour_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival_time", $arrival_time);
            $query->bindValue(":price", $price, $this->pdo::PARAM_INT);
            $query->bindValue(":num_seats", $num_places, $this->pdo::PARAM_INT);
            $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
            $query->bindValue(":kilometers", $kilometers, $this->pdo::PARAM_INT);
            $query->bindValue(":travel_time", $travel_time, $this->pdo::PARAM_STR);

            $query->execute();

            $lastInsertedId = $this->pdo->lastInsertId();

            // Hydration
            $tripInfo = new Trip();
            $tripInfo->setId($lastInsertedId);
            $tripInfo->setDepartureCity($departure_city);
            $tripInfo->setArrivalCity($arrival_city);
            $tripInfo->setNumSeats($num_places);
            $tripInfo->setDepartureDate($date_trip);
            $tripInfo->setDepartureHour($hour_trip);
            $tripInfo->setPrice($price);
            $tripInfo->setCarId($car_id);
            $tripInfo->setArrivalTime($arrival_time);
            $tripInfo->setStatus($status);
            $tripInfo->setKilometers($kilometers);
            $tripInfo->setTravel_time($travel_time);

            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showTripHistory($user_id)
    {
        try {

            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.car_id, s.status, s.kilometers, s.travel_time FROM car_sharing s INNER JOIN cars c on s.car_id = c.id WHERE c.user_id = :user_id AND s.departure_date < :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $trips     = [];

            // Hydration
            foreach ($tripsData as $tripData) {
                $dateObject = new \DateTime($tripData["departure_date"]);
                $tripDate   = $dateObject->format("d/m/Y");

                $tripInfo = new Trip();
                $tripInfo->setId($tripData["id"]);
                $tripInfo->setDepartureCity($tripData["departure_city"]);
                $tripInfo->setArrivalCity($tripData["arrival_city"]);
                $tripInfo->setNumSeats($tripData["num_seats"]);
                $tripInfo->setDepartureDate($tripDate);
                $tripInfo->setDepartureHour($tripData["departure_hour"]);
                $tripInfo->setPrice($tripData["price"]);
                $tripInfo->setCarId($tripData["car_id"]);
                $tripInfo->setArrivalTime($tripData["arrival_time"]);
                $tripInfo->setStatus($tripData["status"]);
                $tripInfo->setKilometers($tripData["kilometers"]);
                $tripInfo->setTravel_time($tripData["travel_time"]);
                $trips[] = $tripInfo;
            }

            return $trips;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showTripManage($user_id)
    {
        try {
            $todayTime = new \DateTime();
            $today     = $todayTime->format("Y-m-d");

            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.car_id, s.status, s.kilometers, s.travel_time FROM car_sharing s INNER JOIN cars c on s.car_id = c.id WHERE c.user_id = :user_id AND s.departure_date >= :today ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->bindValue(":today", $today);
            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $trips     = [];

            // Hydration
            foreach ($tripsData as $tripData) {
                $dateObject = new \DateTime($tripData["departure_date"]);
                $tripDate   = $dateObject->format("d/m/Y");

                $tripInfo = new Trip();
                $tripInfo->setId($tripData["id"]);
                $tripInfo->setDepartureCity($tripData["departure_city"]);
                $tripInfo->setArrivalCity($tripData["arrival_city"]);
                $tripInfo->setNumSeats($tripData["num_seats"]);
                $tripInfo->setDepartureDate($tripDate);
                $tripInfo->setDepartureHour($tripData["departure_hour"]);
                $tripInfo->setPrice($tripData["price"]);
                $tripInfo->setCarId($tripData["car_id"]);
                $tripInfo->setArrivalTime($tripData["arrival_time"]);
                $tripInfo->setStatus($tripData["status"]);
                $tripInfo->setKilometers($tripData["kilometers"]);
                $tripInfo->setTravel_time($tripData["travel_time"]);
                $trips[] = $tripInfo;
            }

            return $trips;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updatetTrip($status, $id)
    {
        try {
            $query = $this->pdo->prepare("UPDATE car_sharing SET status = :status WHERE id = :id;");

            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
            $query->execute();

            $tripInfo = new Trip();
            $tripInfo->setStatus($status);

            header("Location: /index.php?controller=trips&action=manageTrip");
            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteTrip($id)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM car_sharing WHERE id = :id;");
            $query->bindValue(":id", $id, $this->pdo::PARAM_STR);
            $query->execute();

            header("Location: /index.php?controller=trips&action=manageTrip");

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function findTrip($departCity, $arrival_city, $date_trip, $num_seats, $user_id)
    {
        try {

            $check = $this->pdo->prepare("SELECT COUNT(*) FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.departure_date = :date AND s.departure_city = :departure AND s.arrival_city = :arrival AND s.num_seats >= :seats AND s.status = 'Programmé' AND (u.id != :user_id OR :user_id IS NULL);");

            $check->bindValue(":departure", $departCity, $this->pdo::PARAM_STR);
            $check->bindValue(":arrival", $arrival_city, $this->pdo::PARAM_STR);
            $check->bindValue(":date", $date_trip, $this->pdo::PARAM_STR);
            $check->bindValue(":seats", $num_seats, $this->pdo::PARAM_INT);
            $check->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $check->execute();

            $exists = $check->fetchColumn() > 0;

            if ($exists) {
                return "trajet trouvés";

            } else {
                $check = $this->pdo->prepare("SELECT COUNT(*) FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.departure_date > :date AND s.departure_city = :departure AND s.arrival_city = :arrival AND s.num_seats >= :seats AND s.status = 'Programmé' AND (u.id != :user_id OR :user_id IS NULL);");

                $check->bindValue(":departure", $departCity, $this->pdo::PARAM_STR);
                $check->bindValue(":arrival", $arrival_city, $this->pdo::PARAM_STR);
                $check->bindValue(":date", $date_trip, $this->pdo::PARAM_STR);
                $check->bindValue(":seats", $num_seats, $this->pdo::PARAM_INT);
                $check->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
                $check->execute();

                $nextDate = $check->fetchColumn() > 0;

                if ($nextDate) {
                    return true;
                } else {
                    return false;
                }
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function findotherTrip($departCity, $arrival_city, $date_trip, $num_seats, $userId)
    {
        try {
            $query = $this->pdo->prepare("SELECT s.id, s.departure_date FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.departure_date > :date AND s.departure_city= :departure AND s.arrival_city = :arrival AND s.num_seats >= :seats AND s.status = 'Programmé' AND (u.id != :user_id OR :user_id IS NULL) ORDER BY departure_date ASC LIMIT 1;");

            // bind value from form to query
            $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
            $query->bindValue(":departure", $departCity, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":seats", $num_seats, $this->pdo::PARAM_INT);

            $query->execute();

            $tripsData  = $query->fetch(\PDO::FETCH_ASSOC);
            $dateObject = new \DateTime($tripsData["departure_date"]);
            $tripDate   = $dateObject->format("d/m/Y");

            return $tripDate;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showAllTrips($departCity, $arrival_city, $date_trip, $num_seats, $userId)
    {
        try {
            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.status, s.kilometers, s.travel_time, c.energy_type, u.username, u.photo, u.notes FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.departure_date = :date AND s.departure_city= :departure AND s.arrival_city = :arrival AND s.num_seats >= :seats AND s.status = 'Programmé' AND (u.id != :user_id OR :user_id IS NULL) ORDER BY departure_date ASC, departure_hour ASC;");

            // bind value from form to query
            $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
            $query->bindValue(":departure", $departCity, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":seats", $num_seats, $this->pdo::PARAM_INT);

            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $trips     = [];
            if ($tripsData) {
                // Hydration
                foreach ($tripsData as $tripData) {
                    $dateObject = new \DateTime($tripData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $tripInfo = new Trip();
                    $tripInfo->setId($tripData["id"]);
                    $tripInfo->setDepartureCity($tripData["departure_city"]);
                    $tripInfo->setArrivalCity($tripData["arrival_city"]);
                    $tripInfo->setDepartureDate($tripDate);
                    $tripInfo->setDepartureHour($tripData["departure_hour"]);
                    $tripInfo->setArrivalTime($tripData["arrival_time"]);
                    $tripInfo->setPrice($tripData["price"]);
                    $tripInfo->setNumSeats($tripData["num_seats"]);
                    $tripInfo->setStatus($tripData["status"]);
                    $tripInfo->setEnergyTy($tripData["energy_type"]);
                    $tripInfo->setUsername($tripData["username"]);
                    $tripInfo->setPhoto($tripData["photo"]);
                    $tripInfo->setNotes($tripData["notes"]);
                    $tripInfo->setKilometers($tripData["kilometers"]);
                    $tripInfo->setTravel_time($tripData["travel_time"]);
                    $trips[] = $tripInfo;
                }
            }
            return $trips;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showAllTripsFilter($departCity, $arrival_city, $date_trip, $num_seats, $userId, $filter)
    {
        try {
            $sql = "SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.status, s.kilometers, s.travel_time, c.energy_type, u.username, u.photo, u.notes FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.departure_date = :date AND s.departure_city= :departure AND s.arrival_city = :arrival AND s.num_seats >= :seats AND s.status = 'Programmé' ";

            if ($userId !== null) {
                $sql .= " AND u.id != :user_id";
            }

            if (! empty($filter["ecoTrip"])) {
                $sql .= " AND c.energy_type = :energy";
            }

            if (! empty($filter["starsNumber"])) {
                $sql .= " AND u.notes >= :stars";
            }

            if (! empty($filter["priceMax"])) {
                $sql .= " AND s.price <= :priceMax";
            }

            if (! empty($filter["timeMax"])) {
                $sql .= " AND s.travel_time <= :travelTimeMax";
            }
            $sql .= " ORDER BY s.departure_date ASC, s.departure_hour ASC;";

            $query = $this->pdo->prepare($sql);

            // bind value from form to query
            $query->bindValue(":departure", $departCity, $this->pdo::PARAM_STR);
            $query->bindValue(":arrival", $arrival_city, $this->pdo::PARAM_STR);
            $query->bindValue(":date", $date_trip, $this->pdo::PARAM_STR);
            $query->bindValue(":seats", $num_seats, $this->pdo::PARAM_INT);

            if ($userId !== null) {
                $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
            }

            if ($filter["ecoTrip"] !== null && $filter["ecoTrip"] !== '') {
                $query->bindValue(":energy", $filter["ecoTrip"], $this->pdo::PARAM_STR);
            }

            if ($filter["starsNumber"] !== null && $filter["starsNumber"] !== '') {
                $query->bindValue(":stars", $filter["starsNumber"], $this->pdo::PARAM_INT);
            }

            if ($filter["priceMax"] !== null && $filter["priceMax"] !== '') {
                $query->bindValue(":priceMax", $filter["priceMax"], $this->pdo::PARAM_INT);
            }

            if ($filter["timeMax"] !== null && $filter["timeMax"] !== '') {
                $query->bindValue(":travelTimeMax", $filter["timeMax"], $this->pdo::PARAM_STR);
            }

            $query->execute();

            $tripsData = $query->fetchAll(\PDO::FETCH_ASSOC);
            if (empty($tripsData)) {
                return "Aucun trajet trouvé avec ces paramètres.";
            } else {
                $trips = [];
                if ($tripsData) {
                    // Hydration
                    foreach ($tripsData as $tripData) {
                        $dateObject = new \DateTime($tripData["departure_date"]);
                        $tripDate   = $dateObject->format("d/m/Y");

                        $tripInfo = new Trip();
                        $tripInfo->setId($tripData["id"]);
                        $tripInfo->setDepartureCity($tripData["departure_city"]);
                        $tripInfo->setArrivalCity($tripData["arrival_city"]);
                        $tripInfo->setDepartureDate($tripDate);
                        $tripInfo->setDepartureHour($tripData["departure_hour"]);
                        $tripInfo->setArrivalTime($tripData["arrival_time"]);
                        $tripInfo->setPrice($tripData["price"]);
                        $tripInfo->setNumSeats($tripData["num_seats"]);
                        $tripInfo->setStatus($tripData["status"]);
                        $tripInfo->setEnergyTy($tripData["energy_type"]);
                        $tripInfo->setUsername($tripData["username"]);
                        $tripInfo->setPhoto($tripData["photo"]);
                        $tripInfo->setNotes($tripData["notes"]);
                        $tripInfo->setKilometers($tripData["kilometers"]);
                        $tripInfo->setTravel_time($tripData["travel_time"]);
                        $trips[] = $tripInfo;
                    }
                }
                return $trips;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function seeSeatsTrip($id)
    {
        $query = $this->pdo->prepare("SELECT num_seats FROM car_sharing WHERE id = :id");
        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);

        $query->execute();

        $seatsData = $query->fetch(\PDO::FETCH_ASSOC);

        $seats = $seatsData["num_seats"];

        return $seats;
    }

    public function detailsTrips($id)
    {
        try {
            $query = $this->pdo->prepare("SELECT s.id, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, s.price, s.num_seats, s.status, s.kilometers, s.travel_time, c.brand, c.model, c.energy_type, c.color, u.id AS driver_id, u.username, u.photo, u.notes FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id WHERE s.id = :id;");

            // bind value from form to query
            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);

            $query->execute();

            $tripData = $query->fetch(\PDO::FETCH_ASSOC);

            $dateObject = new \DateTime($tripData["departure_date"]);
            $tripDate   = $dateObject->format("d/m/Y");

            $tripInfo = new Trip();
            $tripInfo->setId($tripData["id"]);
            $tripInfo->setDepartureCity($tripData["departure_city"]);
            $tripInfo->setArrivalCity($tripData["arrival_city"]);
            $tripInfo->setDepartureDate($tripDate);
            $tripInfo->setDepartureDateFormat($tripData["departure_date"]);
            $tripInfo->setDepartureHour($tripData["departure_hour"]);
            $tripInfo->setArrivalTime($tripData["arrival_time"]);
            $tripInfo->setPrice($tripData["price"]);
            $tripInfo->setNumSeats($tripData["num_seats"]);
            $tripInfo->setStatus($tripData["status"]);
            $tripInfo->setKilometers($tripData["kilometers"]);
            $tripInfo->setTravel_time($tripData["travel_time"]);
            $tripInfo->setBrand($tripData["brand"]);
            $tripInfo->setModel($tripData["model"]);
            $tripInfo->setEnergyTy($tripData["energy_type"]);
            $tripInfo->setColor($tripData["color"]);
            $tripInfo->setUsername($tripData["username"]);
            $tripInfo->setPhoto($tripData["photo"]);
            $tripInfo->setDriverId($tripData["driver_id"]);
            $tripInfo->setNotes($tripData["notes"]);

            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function otherDetails($id)
    {
        try {
            $query = $this->pdo->prepare("SELECT s.id, p.smoking_allowed, p.animal_allowed, p.description FROM car_sharing s INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u ON c.user_id = u.id INNER JOIN preferences p ON p.user_id = u.id WHERE s.id = :id;");

            // bind value from form to query
            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->execute();

            $tripData = $query->fetch(\PDO::FETCH_ASSOC);

            $tripInfo = new Trip();

            $tripInfo->setSmokingAllowed($tripData["smoking_allowed"]);
            $tripInfo->setAnimalAllowed($tripData["animal_allowed"]);
            $tripInfo->setDescription($tripData["description"]) ?? "";

            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    public function seatsTrip($id)
    {
        try {
            $query = $this->pdo->prepare("SELECT num_seats FROM car_sharing WHERE id = :id;");

            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->execute();

            $tripData = $query->fetch(\PDO::FETCH_ASSOC);

            $numsteats = $tripData["num_seats"];

            return $numsteats;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function updatetSeatsTrip($numSeats, $id)
    {
        try {
            $query = $this->pdo->prepare("UPDATE car_sharing SET num_seats = :seats WHERE id = :id;");

            $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
            $query->bindValue(":seats", $numSeats, $this->pdo::PARAM_STR);
            $query->execute();

            $tripInfo = new Trip();
            $tripInfo->setNumSeats($numSeats);

            return $tripInfo;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function driverIdPriceTrip($idreservation)
    {
        try {
            $query = $this->pdo->prepare("SELECT r.totalPrice, c.user_id FROM reservations r INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id WHERE r.id =:id;");

            $query->bindValue(":id", $idreservation, $this->pdo::PARAM_INT);
            $query->execute();
            $userData = $query->fetch(\PDO::FETCH_ASSOC);

            $driverId = [
                "user_id"    => $userData["user_id"],
                "totalPrice" => $userData["totalPrice"],
            ];

            return $driverId;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

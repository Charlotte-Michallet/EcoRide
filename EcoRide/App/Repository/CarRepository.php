<?php
namespace App\Repository;

use App\Entity\Car;

class CarRepository extends Repository
{
    public function createCar(string $brand, string $model, string $energy_type, int $num_seats, string $numplate, string $first_register_date, string $color, int $user_id)
    {
        try {

            $query = $this->pdo->prepare("INSERT INTO cars (brand, model, energy_type, num_seats, number_plate, first_register_date, color, user_id) VALUES(:brand, :model, :energy_type, :num_seats, :numplate, :first_register_date, :color, :user_id);");

            // bind value from form to query
            $query->bindValue(":brand", $brand, $this->pdo::PARAM_STR);
            $query->bindValue(":model", $model, $this->pdo::PARAM_STR);
            $query->bindValue(":energy_type", $energy_type, $this->pdo::PARAM_STR);
            $query->bindValue(":num_seats", $num_seats, $this->pdo::PARAM_INT);
            $query->bindValue(":numplate", $numplate, $this->pdo::PARAM_STR);
            $query->bindValue(":first_register_date", $first_register_date, $this->pdo::PARAM_STR);
            $query->bindValue(":color", $color, $this->pdo::PARAM_STR);
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);

            $query->execute();

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showUserCars(int $user_id)
    {
        try {
            $query = $this->pdo->prepare("SELECT * FROM cars WHERE user_id = :user_id;");
            $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
            $query->execute();

            $carsInfo = $query->fetchAll(\PDO::FETCH_ASSOC);

            $cars = [];
            foreach ($carsInfo as $carInfo) {

                $dateObject   = new \DateTime($carInfo["first_register_date"]);
                $dateregister = $dateObject->format("d/m/Y");

                // Hydration
                $car = new Car();
                $car->setId($carInfo["id"]);
                $car->setBrand($carInfo["brand"]);
                $car->setModel($carInfo["model"]);
                $car->setEnergyType($carInfo["energy_type"]);
                $car->setNumSeats($carInfo["num_seats"]);
                $car->setNumplate($carInfo["number_plate"]);
                $car->setFirstRegisterDate($dateregister);
                $car->setColor($carInfo["color"]);
                $car->setUserId($carInfo["user_id"]);
                $cars[] = $car;

            }
            return $cars;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteCar(int $id)
    {
        try {
            $query = $this->pdo->prepare("DELETE FROM cars WHERE id = :id;");
            $query->bindValue(":id", $id, $this->pdo::PARAM_STR);
            $query->execute();

            header("Location: http://localhost:8080/index.php?controller=auth&action=cars");
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkCarInDb(string $numplate): mixed
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM cars WHERE number_plate = :numplate;");

        $query->bindValue(":numplate", $numplate);
        $query->execute();

        $count = $query->fetchColumn();

        return $count > 0;
    }
}

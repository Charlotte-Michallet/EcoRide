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

            // user id (from user table just created)
            $lastInsertedId = $this->pdo->lastInsertId();

            // Hydration
            $carInfo = new car();
            $carInfo->setId($lastInsertedId);

            return $carInfo;
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
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkCarInDb(string $numplate): mixed
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM cars WHERE numplate = :numplate;");

        $query->bindValue(":numplate", $numplate);
        $query->execute();

        $count = $query->fetchColumn();

        return $count > 0;
    }
}

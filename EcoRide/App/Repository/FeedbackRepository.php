<?php
namespace App\Repository;

use App\Entity\Feedback;

class FeedbackRepository extends Repository
{

    public function createFeedback($tripStatus, $rating, $feedback, $userId, $status, $reservationId)
    {
        $query = $this->pdo->prepare("INSERT INTO feedbacks (user_id, trip_status, note, feedback, status, reservation_id) VALUES(:user_id, :trip_status, :note, :feedback, :status, :reservation_id);");

        // bind value from form to query
        $query->bindValue(":trip_status", $tripStatus, $this->pdo::PARAM_STR);
        $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
        $query->bindValue(":reservation_id", $reservationId, $this->pdo::PARAM_INT);
        $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
        $query->bindValue(":note", $rating, $rating === null ? \PDO::PARAM_NULL : \PDO::PARAM_INT);
        $query->bindValue(":feedback", $feedback, $feedback === null ? \PDO::PARAM_NULL : \PDO::PARAM_STR);

        $query->execute();

        $lastInsertedId = $this->pdo->lastInsertId();

        // Hydration
        $feedbackInfo = new Feedback();
        $feedbackInfo->setId($lastInsertedId);
        $feedbackInfo->setUserId($userId);
        $feedbackInfo->setStatus($status);
        $feedbackInfo->setReservationId($reservationId);
        $feedbackInfo->setTripStatus($tripStatus);

        if ($feedback !== null) {
            $feedbackInfo->setFeedback($feedback);
        }
        if ($rating !== null) {
            $feedbackInfo->setNote($rating);
        }

        return $feedbackInfo;
    }

    public function validationFeedback()
    {
        try {
            $query = $this->pdo->prepare("SELECT f.id, f.trip_status, f.note, f.feedback, f.status, f.status, r.number_reser, f.reservation_id, r.totalPrice, r.num_seats_bookes, r.car_sharing_id, u_passe.username AS passengers_username, u_passe.photo AS passengers_photo, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, u_driver.username AS driver_username, u_driver.photo as driver_photo FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u_passe ON f.user_id = u_passe.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u_driver ON c.user_id = u_driver.id WHERE f.status = 'En attente de validation' ORDER BY departure_date ASC, departure_hour ASC;");

            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();
                    $feedbackinfo->setId($feedbackData["id"]);
                    $feedbackinfo->setTripWell($feedbackData["trip_status"]);
                    $feedbackinfo->setNote($feedbackData["note"]);
                    $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    $feedbackinfo->setReservationId($feedbackData["reservation_id"]);
                    $feedbackinfo->setNumberReser($feedbackData["number_reser"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setTotalPrice($feedbackData["totalPrice"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["passengers_username"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["passengers_photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);
                    $feedbackinfo->setDepartureHour($feedbackData["departure_hour"]);
                    $feedbackinfo->setDriverUsername($feedbackData["driver_username"]);
                    $feedbackinfo->setDriverPhoto($feedbackData["driver_photo"]);
                    $feedbackinfo->setCarSharingId($feedbackData["car_sharing_id"]);
                    $feedbackinfo->setStatus($feedbackData["status"]);

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showAllFeedbacks()
    {
        try {
            $query = $this->pdo->prepare("SELECT f.id, f.trip_status, f.note, f.feedback, f.status, f.status, r.number_reser, f.reservation_id, r.totalPrice, r.num_seats_bookes, r.car_sharing_id, u_passe.username AS passengers_username, u_passe.photo AS passengers_photo, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, u_driver.username AS driver_username, u_driver.photo as driver_photo FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u_passe ON f.user_id = u_passe.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u_driver ON c.user_id = u_driver.id WHERE (f.status = 'Validé' OR f.status ='Refusé' OR f.status ='Enregistré') ORDER BY departure_date ASC, departure_hour ASC;");

            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();
                    $feedbackinfo->setId($feedbackData["id"]);
                    $feedbackinfo->setTripWell($feedbackData["trip_status"]);
                    $feedbackinfo->setNote($feedbackData["note"]);
                    $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    $feedbackinfo->setReservationId($feedbackData["reservation_id"]);
                    $feedbackinfo->setNumberReser($feedbackData["number_reser"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setTotalPrice($feedbackData["totalPrice"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["passengers_username"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["passengers_photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);
                    $feedbackinfo->setDepartureHour($feedbackData["departure_hour"]);
                    $feedbackinfo->setDriverUsername($feedbackData["driver_username"]);
                    $feedbackinfo->setDriverPhoto($feedbackData["driver_photo"]);
                    $feedbackinfo->setCarSharingId($feedbackData["car_sharing_id"]);
                    $feedbackinfo->setStatus($feedbackData["status"]);

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showbadFeedback()
    {
        try {
            $query = $this->pdo->prepare("SELECT f.id, f.trip_status, f.note , f.feedback, f.status, r.payment_status, r.number_reser, f.reservation_id, r.totalPrice, r.num_seats_bookes, r.car_sharing_id, u_passe.username AS passengers_username, u_passe.email AS passengers_email, u_passe.photo AS passengers_photo, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, u_driver.username AS driver_username, u_driver.email AS driver_email, u_driver.photo as driver_photo FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u_passe ON f.user_id = u_passe.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u_driver ON c.user_id = u_driver.id WHERE f.trip_status = 'Non' AND (f.status = 'En attente de contact' OR f.status = 'En attente de validation') ORDER BY departure_date ASC, departure_hour ASC;");

            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();
                    $feedbackinfo->setId($feedbackData["id"]);
                    $feedbackinfo->setReservationId($feedbackData["reservation_id"]);
                    $feedbackinfo->setTripWell($feedbackData["trip_status"]);
                    $feedbackinfo->setNumberReser($feedbackData["number_reser"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setTotalPrice($feedbackData["totalPrice"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["passengers_username"]);
                    $feedbackinfo->setPassengersEmail($feedbackData["passengers_email"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["passengers_photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);
                    $feedbackinfo->setDepartureHour($feedbackData["departure_hour"]);
                    $feedbackinfo->setDriverUsername($feedbackData["driver_username"]);
                    $feedbackinfo->setDriverEmail($feedbackData["driver_email"]);
                    $feedbackinfo->setDriverPhoto($feedbackData["driver_photo"]);
                    $feedbackinfo->setCarSharingId($feedbackData["car_sharing_id"]);
                    $feedbackinfo->setPaymentStatus($feedbackData["payment_status"]);
                    $feedbackinfo->setStatus($feedbackData["status"]);

                    if ($feedbackData["feedback"] !== null) {
                        $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    }
                    if ($feedbackData["note"] !== null) {
                        $feedbackinfo->setNote($feedbackData["note"]);
                    }

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function allshowbadFeedback()
    {
        try {
            $query = $this->pdo->prepare("SELECT f.id, f.trip_status, f.note , f.feedback, f.status, r.payment_status, r.number_reser, f.reservation_id, r.totalPrice, r.num_seats_bookes, r.car_sharing_id, u_passe.username AS passengers_username, u_passe.email AS passengers_email, u_passe.photo AS passengers_photo, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, u_driver.username AS driver_username, u_driver.email AS driver_email, u_driver.photo as driver_photo FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u_passe ON f.user_id = u_passe.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u_driver ON c.user_id = u_driver.id WHERE f.trip_status = 'Non' AND (f.status = 'Payé' OR f.status = 'Enregistré') ORDER BY departure_date ASC, departure_hour ASC;");

            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();
                    $feedbackinfo->setId($feedbackData["id"]);
                    $feedbackinfo->setReservationId($feedbackData["reservation_id"]);
                    $feedbackinfo->setTripWell($feedbackData["trip_status"]);
                    $feedbackinfo->setNumberReser($feedbackData["number_reser"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setTotalPrice($feedbackData["totalPrice"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["passengers_username"]);
                    $feedbackinfo->setPassengersEmail($feedbackData["passengers_email"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["passengers_photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);
                    $feedbackinfo->setDepartureHour($feedbackData["departure_hour"]);
                    $feedbackinfo->setDriverUsername($feedbackData["driver_username"]);
                    $feedbackinfo->setDriverEmail($feedbackData["driver_email"]);
                    $feedbackinfo->setDriverPhoto($feedbackData["driver_photo"]);
                    $feedbackinfo->setCarSharingId($feedbackData["car_sharing_id"]);
                    $feedbackinfo->setPaymentStatus($feedbackData["payment_status"]);

                    if ($feedbackData["feedback"] !== null) {
                        $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    }
                    if ($feedbackData["note"] !== null) {
                        $feedbackinfo->setNote($feedbackData["note"]);
                    }

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function Upadatefeedback(string $status, int $id)
    {
        $query = $this->pdo->prepare("UPDATE feedbacks SET status = :status WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
        $query->execute();

        // Hydration
        $feedbackInfo = new Feedback();
        $feedbackInfo->setStatus($status);
        return $feedbackInfo;
    }

    public function showFeedback(int $userId)
    {
        try {
            $query = $this->pdo->prepare("SELECT f.id, f.trip_status, f.note, f.feedback, f.status, f.status, r.number_reser, f.reservation_id, r.totalPrice, r.num_seats_bookes, r.car_sharing_id, u_passe.username AS passengers_username, u_passe.photo AS passengers_photo, s.departure_city, s.arrival_city, s.departure_date, s.departure_hour, s.arrival_time, u_driver.username AS driver_username, u_driver.photo as driver_photo FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u_passe ON f.user_id = u_passe.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id INNER JOIN users u_driver ON c.user_id = u_driver.id WHERE f.user_id = :user_id ORDER BY departure_date ASC, departure_hour ASC;");

            $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);
            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();
                    $feedbackinfo->setId($feedbackData["id"]);
                    $feedbackinfo->setTripWell($feedbackData["trip_status"]);
                    $feedbackinfo->setNote($feedbackData["note"]);
                    $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    $feedbackinfo->setReservationId($feedbackData["reservation_id"]);
                    $feedbackinfo->setNumberReser($feedbackData["number_reser"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setTotalPrice($feedbackData["totalPrice"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["passengers_username"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["passengers_photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);
                    $feedbackinfo->setDepartureHour($feedbackData["departure_hour"]);
                    $feedbackinfo->setDriverUsername($feedbackData["driver_username"]);
                    $feedbackinfo->setDriverPhoto($feedbackData["driver_photo"]);
                    $feedbackinfo->setCarSharingId($feedbackData["car_sharing_id"]);
                    $feedbackinfo->setStatus($feedbackData["status"]);
                    $feedbackinfo->setArrivalHour($feedbackData["arrival_time"]);

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function showFeedbackTrips(int $userId)
    {
        try {
            $query = $this->pdo->prepare("SELECT f.note, f.feedback, r.num_seats_bookes, u.username, u.photo, s.departure_city, s.arrival_city, s.departure_date FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN users u ON f.user_id = u.id INNER JOIN car_sharing s ON r.car_sharing_id = s.id INNER JOIN cars c ON s.car_id = c.id WHERE c.user_id = :driver_id AND f.status = 'Validé' ORDER BY departure_date ASC, departure_hour ASC;");

            $query->bindValue(":driver_id", $userId, $this->pdo::PARAM_INT);
            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            $feedbacks     = [];
            if ($feedbacksData) {
                // Hydration
                foreach ($feedbacksData as $feedbackData) {
                    $dateObject = new \DateTime($feedbackData["departure_date"]);
                    $tripDate   = $dateObject->format("d/m/Y");

                    $feedbackinfo = new Feedback();

                    $feedbackinfo->setNote($feedbackData["note"]);
                    $feedbackinfo->setFeedback($feedbackData["feedback"]);
                    $feedbackinfo->setNumPlaces($feedbackData["num_seats_bookes"]);
                    $feedbackinfo->setPassengersUsername($feedbackData["username"]);
                    $feedbackinfo->setPassengersPhoto($feedbackData["photo"]);
                    $feedbackinfo->setDepartureCity($feedbackData["departure_city"]);
                    $feedbackinfo->setArrivalCity($feedbackData["arrival_city"]);
                    $feedbackinfo->setDepartureDate($tripDate);

                    $feedbacks[] = $feedbackinfo;
                }
            }
            return $feedbacks;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function countNotesDriver(int $driverId)
    {
        try {
            $query = $this->pdo->prepare("SELECT COUNT(*) FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN car_sharing s ON r.car_sharing_id= s.id INNER JOIN cars c ON s.car_id= c.id WHERE f.status = 'Validé' AND f.note IS NOT NULL AND c.user_id = :driver_id;");

            $query->bindValue(":driver_id", $driverId, $this->pdo::PARAM_INT);
            $query->execute();

            return $query->fetchColumn();

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function sumNotesDriver(int $driverId)
    {
        try {
            $query = $this->pdo->prepare("SELECT SUM(f.note) FROM feedbacks f INNER JOIN reservations r ON f.reservation_id = r.id INNER JOIN car_sharing s ON r.car_sharing_id= s.id INNER JOIN cars c ON s.car_id= c.id WHERE f.status = 'Validé' AND f.note IS NOT NULL AND c.user_id = :driver_id;");

            $query->bindValue(":driver_id", $driverId, $this->pdo::PARAM_INT);
            $query->execute();

            $totalNotes = $query->fetchColumn();
            return $totalNotes;

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function feedbackEmpty($feedbackId)
    {
        try {
            $query = $this->pdo->prepare("SELECT note FROM feedbacks WHERE id = :id;");

            $query->bindValue(":id", $feedbackId, $this->pdo::PARAM_INT);
            $query->execute();

            $feedbacksData = $query->fetchAll(\PDO::FETCH_ASSOC);
            if ($feedbacksData && $feedbacksData["note"] === null) {
                return null;
            } else {
                return true;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

<?php
namespace App\Repository;

use App\Entity\Feedback;

class FeedbackRepository extends Repository
{

    public function createFeedback($ratting, $feedback, $userId, $status, $reservationId)
    {
        $query = $this->pdo->prepare("INSERT INTO feedbacks (user_id, note, feedback, status, reservation_id) VALUES(:user_id, :note, :feedback, :status, :reservation_id);");

        // bind value from form to query
        $query->bindValue(":note", $ratting, $this->pdo::PARAM_INT);
        $query->bindValue(":feedback", $feedback, $this->pdo::PARAM_STR);
        $query->bindValue(":status", $status, $this->pdo::PARAM_STR);
        $query->bindValue(":reservation_id", $reservationId, $this->pdo::PARAM_INT);
        $query->bindValue(":user_id", $userId, $this->pdo::PARAM_INT);

        $query->execute();
        $query->fetch(\PDO::FETCH_ASSOC);

        $lastInsertedId = $this->pdo->lastInsertId();

        // Hydration
        $feedbackInfo = new Feedback();
        $feedbackInfo->setId($lastInsertedId);
        $feedbackInfo->setUserId($userId);
        $feedbackInfo->setNote($ratting);
        $feedbackInfo->setFeedback($feedback);
        $feedbackInfo->setStatus($status);
        $feedbackInfo->setReservationId($reservationId);

        return $feedbackInfo;
    }
}

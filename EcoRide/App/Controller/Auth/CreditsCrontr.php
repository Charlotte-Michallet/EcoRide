<?php
namespace App\Controller\Auth;

use App\Repository\UserRepository;

class CreditsCrontr extends AccountContr
{
    public function __construct(int $credits)
    {
        $this->credits = $credits;
    }
    public function checkCredits()
    {
        if (empty($this->credits) && filter_var($this->credits, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
            $errors = "Le montant des credits est incorrecte";
            return $errors;
        } else {
            $userId     = $_SESSION["id"];
            $creditRepo = new UserRepository();
            $creditUser = $creditRepo->usercredits($userId);
            $creditsNow = $creditUser + $this->credits;

            $creditsUpdated = $creditRepo->UpdatecreditsTrip($userId, $creditsNow);
            if (empty($creditsUpdated)) {
                $errors = "Une erreur est survenue";
                return $errors;
            }
        }

    }

}

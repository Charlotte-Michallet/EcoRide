<?php
namespace App\Controller\Mail;

use App\Repository\ReservationRepository;

class SendMailContr
{
    public function sendMail($idCarsharing)
    {
        $reservaRepo = new ReservationRepository();
        $usersinfo   = $reservaRepo->selectPassengersMail($idCarsharing);
        $mailer      = new MailerContr();

        $usernames = [];
        $emails    = [];
        $results   = [];

        foreach ($usersinfo as $userinfo) {
            $usernames = $userinfo["username"];
            $emails    = $userinfo["email"];
            $results[] = $mailer->sendMail($emails, $usernames);
        }
        if (empty($results)) {
            return "Aucun passager trouvé aucun mail envoyé!";
        } else {
            return $results;
        }
    }
}

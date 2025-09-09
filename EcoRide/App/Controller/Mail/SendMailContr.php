<?php
namespace App\Controller\Mail;

use App\Repository\ReservationRepository;

class SendMailContr
{
    public function sendMailForeach($idCarsharing)
    {
        $reservaRepo = new ReservationRepository();
        $usersinfo   = $reservaRepo->selectPassengersMail($idCarsharing);

        $sentEmails = [];
        $results    = [];

        if (empty($usersinfo)) {
            return "Aucun passager trouvé, aucun mail envoyé!";
        }

        foreach ($usersinfo as $userinfo) {
            $username = $userinfo["username"];
            $email    = $userinfo["email"];

            if (! in_array($email, $sentEmails)) {
                $mailer     = new MailerContr();
                $sendResult = $mailer->sendMail($email, $username);
                $results[]  = ["email" => $email, "result" => $sendResult];

                $sentEmails[] = $email;
            }
        }
        if (empty($results)) {
            return "Aucun passager trouvé aucun mail envoyé!";
        } else {
            return $results;
        }
    }
}

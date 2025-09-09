<?php
namespace App\Controller\Mail;

use PHPMailer\PHPMailer\PHPMailer;

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";

class MailerContr
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->configureSmtp();
    }

    public function configureSmtp()
    {
        try {
            $this->mail->isSMTP();
            $this->mail->Host       = "smtp.gmail.com";
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = "ecoridejose@gmail.com";
            $this->mail->Password   = "odghprphrbfahnyz";
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port       = 587;

            $this->mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ];
        } catch (\Exception $e) {
            error_log("Erreur de configuration SMTP: " . $e->getMessage());
        }
    }

    public function sendMail($recipientEmail, $recipientName)
    {
        try {
            $this->mail->CharSet = 'UTF-8';

            // Recipient
            $this->mail->setFrom("ecoridejose@gmail.com", "Ecoride");
            $this->mail->addAddress($recipientEmail, $recipientName);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = "Votre avis sur le trajet en covoiturage";
            $this->mail->Body    = "Bonjour $recipientName," . "<br> Pourriez-vous prendre quelques instants pour nous laisser votre avis sur votre expérience ? Vos commentaires sont précieux pour améliorer les futurs trajets. <br> Vous pouvez le faire en vous rendant sur votre espace personnel, dans la section 'Mes trajets', puis en cliquant sur le bouton 'Donnez votre avis' du site. <br> Merci d'avance pour votre retour ! <br> Cordialement, <br> l'équipe Ecoride";

            $this->mail->AltBody = "Bonjour $recipientName," . "Pourriez-vous prendre quelques instants pour nous laisser votre avis sur votre expérience ? Vos commentaires sont précieux pour améliorer les futurs trajets. Vous pouvez le faire en vous rendant sur votre espace personnel, dans la section 'Mes trajets', puis en cliquant sur le bouton 'Donnez votre avis' du site. Merci d'avance pour votre retour ! Cordialement, L'équipe Ecoride";

            $this->mail->send();

            return "Email demande avis envoyé";
        } catch (\Exception $e) {
            return "Erreur lors de l'envoi de l'email : " . $this->mail->ErrorInfo;
        }
    }

    public function sendMailPassenger($recipientEmail, $recipientName, $driverName, $dateTrip, $departureTrip, $arrivalTrip)
    {
        try {
            $this->mail->CharSet = 'UTF-8';

            // Recipient
            $this->mail->setFrom("ecoridejose@gmail.com", "Ecoride");
            $this->mail->addAddress($recipientEmail, $recipientName);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = "Annulation de votre trajet du $dateTrip";
            $this->mail->Body    = "Bonjour $recipientName," . "<br><br> Nous vous informons que le covoiturage que vous avez reservé a été annulé par le conducteur $driverName. <br> Voici les détails du trajet qui a été annulé : <br> Date : $dateTrip. <br> De $departureTrip à $arrivalTrip. <br> Nous sommes désolées pour ce dérangement.Vous serez remboursé dans les prochaines heures.<br> Cordialement, <br> l'équipe Ecoride";

            $this->mail->AltBody = "Bonjour $recipientName," . "Nous vous informons que le covoiturage que vous avez reservé a été annulé par le conducteur $driverName. Voici les détails du trajet qui a été annulé : Date : $dateTrip. De $departureTrip à $arrivalTrip. Nous sommes désolées pour ce dérangement.Vous serez remboursé dans les prochaines heures. Cordialement, l'équipe Ecoride";

            $this->mail->send();

            return "Email demande avis envoyé";
        } catch (\Exception $e) {
            return "Erreur lors de l'envoi de l'email : " . $this->mail->ErrorInfo;
        }
    }
}

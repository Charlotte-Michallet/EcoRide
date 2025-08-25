<?php
namespace App\Controller\Mail;

use PHPMailer\PHPMailer\PHPMailer;

require_once dirname(__DIR__, 3) . "/vendor/autoload.php";

class MailerContr
{
    private $mail;
    private $envVars = [];

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->configureSmtp();
    }

    public function configureSmtp()
    {
        // require dirname(__DIR__, 3) . ".env";

        $this->mail->isSMTP();
        $this->mail->Host       = "smtp.gmail.com";
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = "ecoridejose@gmail.com";
        $this->mail->Password   = "dzvydvqijbsgklsr";
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port       = 465;

    }

    public function sendMail($recipientEmail, $recipientName)
    {
        try {
            // require dirname(__DIR__, 3) . ".env";

            $this->mail->CharSet = 'UTF-8';

            // destinataire
            $this->mail->setFrom("ecoridejose@gmail.com", "Ecoride");
            $this->mail->addAddress($recipientEmail, $recipientName);

            // contenue
            $this->mail->isHTML(true);
            $this->mail->Subject = "Votre avis sur le trajet en covoiturage";
            $this->mail->Body    = "Bonjour $recipientName," . "<br> Pourriez-vous prendre quelques instants pour nous laisser votre avis sur votre expérience ? Vos commentaires sont précieux pour améliorer les futurs trajets. <br> Vous pouvez le faire en vous rendant sur votre espace personnel sur http://localhost:8080/index.php. <br> Merci d'avance pour votre retour ! <br> Cordialement, <br> l'équipe Ecoride";

            $this->mail->AltBody = "Bonjour $recipientName," . "Pourriez-vous prendre quelques instants pour nous laisser votre avis sur votre expérience ? Vos commentaires sont précieux pour améliorer les futurs trajets. Vous pouvez le faire en vous rendant sur votre espace personnel sur http://localhost:8080/index.php. Merci d'avance pour votre retour ! Cordialement, l'équipe Ecoride";

            $this->mail->send();

            return "Email demande avis envoyé";
        } catch (\Exception $e) {
            return "Erreur lors de l'envoi de l'email : " . $this->mail->ErrorInfo;
        }
    }

}

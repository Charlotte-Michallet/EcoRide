<?php

namespace App\Controller;

use App\Repository\LoginRepository;

class LoggingContr extends AccountContr
{
    public function __construct(string $email, string $password)
    {
        $this->email         = $email;
        $this->password      = $password;
    }

    public function checkImputLoginUser()
    {
        $errors = [];
        try {
            if ($this->InputEmpty() === true) {
                $errors = ["Tous les champs sont obligatoires."];
                echo "Tous les champs sont obligatoires.";
                return $errors;
            }

            if ($this->emailInvalid() === true) {
                $errors = ["L'adresse email est invalide."];
                echo "L'adresse email est invalide.";
                return $errors;
            }

            if ($errors) {
                $_SESSION["errorRegister"] = $errors;
                exit();
            } else {
                $repoLogin = new LoginRepository();
                $newUser      = $repoLogin->getUser($this->email, $this->password);

                $_SESSION["id"]       = $newUser->getId();
                $_SESSION["username"] = $newUser->getUsername();
                $_SESSION["email"]    = $newUser->getEmail();
                header("Location: http://localhost:8080/index.php");

                return $newUser;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    protected function InputEmpty()
    {
        if (empty($this->email || $this->password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}

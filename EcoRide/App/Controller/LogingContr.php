<?php

namespace App\Controller;

use App\Repository\LoginRepository;

class LogingContr extends AccountContr
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
                $user      = $repoLogin->getUser($this->email, $this->password);

                $_SESSION["id"]       = $user->getId();
                $_SESSION["username"] = $user->getUsername();
                $_SESSION["email"]    = $user->getEmail();
                header("Location: index.php");
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

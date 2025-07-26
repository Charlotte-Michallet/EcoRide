<?php
namespace App\Controller\Auth;

use App\Repository\LoginRepository;

class LoginContr extends AccountContr
{
    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    public function checkImputLoginUser()
    {
        $errors = [];
        try {
            if ($this->InputEmpty() === true) {
                $errors[] = ["Tous les champs sont obligatoires."];
                // echo "Tous les champs sont obligatoires."; // Verify if statment works
                return $errors;
            }

            if ($this->emailInvalid() === true) {
                $errors[] = ["L'adresse email est invalide."];
                // echo "L'adresse email est invalide."; // Verify if statment works
                return $errors;
            }

            if (! empty($errors)) {
                return $errors;
            } else {
                $repoLogin = new LoginRepository();
                $user      = $repoLogin->getUser($this->email, $this->password);
                if ($user === false) {
                    $errors[] = ["Le pseudo ou l'adresse email est incorrect."];
                    return $errors;
                } else {
                    $_SESSION["id"]       = $user->getId();
                    $_SESSION["username"] = $user->getUsername();
                    $_SESSION["email"]    = $user->getEmail();
                }

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

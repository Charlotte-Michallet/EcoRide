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
            }

            if ($this->emailInvalid() === true) {
                $errors[] = ["L'adresse email est invalide."];
            }

            if (! empty($errors)) {
                return $errors;

            } else {
                $repoLogin = new LoginRepository();

                $user   = $repoLogin->getUser($this->email, $this->password);
                $active = $user->getActive();

                if ($user === false) {
                    $errors[] = ["Le pseudo ou l'adresse email est incorrect."];
                    return $errors;
                } elseif ($active === "Suspendu") {
                    $errors[] = ["Votre compte a était desactivé"];
                    return $errors;
                } else {
                    $_SESSION["id"]       = $user->getId();
                    $_SESSION["username"] = $user->getUsername();
                    $_SESSION["email"]    = $user->getEmail();
                    $_SESSION["photo"]    = $user->getPhotoUrl();
                    $_SESSION["role"]     = $user->getIdRole();
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

<?php

namespace App\Controller\Auth;

use App\Repository\RegistRepository;

class RegisterContr extends AccountContr
{
    public function __construct(string $username, string $email, string $password, string $passwordVerif, string $date_of_birth, int $credits, int $id_role)
    {
        $this->username      = $username;
        $this->email         = $email;
        $this->password      = $password;
        $this->passwordVerif = $passwordVerif;
        $this->date_of_birth = $date_of_birth;
        $this->credits       = $credits;
        $this->id_role       = $id_role;
    }

    public function checkImputRegisterUser()
    {
        $errors = [];
        try {
            if ($this->InputEmpty() === true) {
                $errors = ["Tous les champs sont obligatoires."];
                return $errors;
            }

            if ($this->userInvalid() === true) {
                $errors = ["Le nom d'utilisateur est invalide. Utilisez uniquement des lettres et des chiffres."];
                return $errors;
            }

            if ($this->emailInvalid() === true) {
                $errors = ["L'adresse email est invalide."];
                return $errors;
            }

            // if ($this->pwdInvalid() === true) {
            //     $errors = ["Ne peut "];
            //     return $errors;
            // }

            if ($this->pwdMatch() === false) {
                $errors = ["Les mots de passe ne sont pas identiques."];
                return $errors;
            }

            if ($this->usernameTaken() === true) {
                $errors = ["Ce nom d'utilisateur est déjà utilisé."];
                return $errors;
            }

            if ($this->emailTaken() === true) {
                $errors = ["Cet email est déjà utilisé."];
                return $errors;
            }

            if ($this->userUnderAge() === true) {
                $errors = ["Vous devez être majeur pour vous inscrire sur notre plateforme."];
                return $errors;
            }

            if ($errors) {
                $_SESSION["errorRegister"] = $errors;
                exit();
            } else {
                $repoRegister = new RegistRepository();
                $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

                $_SESSION["id"]       = $newUser->getId();
                $_SESSION["username"] = $newUser->getUsername();
                $_SESSION["email"]    = $newUser->getEmail();
                header("Location: index.php");

                return $newUser;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    protected function InputEmpty()
    {
        if (empty($this->username || $this->email || $this->date_of_birth || $this->password || $this->passwordVerif)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}

<?php
namespace App\Controller\Auth;

use App\Repository\RegistRepository;

class RegisterContr extends AccountContr
{
    public function __construct(string $username, string $email, string $password, string $passwordVerif, string $date_of_birth, string $photo_url, int $credits, int $id_role)
    {
        $this->username      = $username;
        $this->email         = $email;
        $this->password      = $password;
        $this->passwordVerif = $passwordVerif;
        $this->date_of_birth = $date_of_birth;
        $this->credits       = $credits;
        $this->id_role       = $id_role;
        $this->photo_url     = $photo_url;

    }

    public function checkImputRegisterUser()
    {
        $errors = [];
        try {
            if ($this->InputEmpty() === true) {
                $errors = ["Tous les champs sont obligatoires."];
            }

            if ($this->userInvalid() === true) {
                $errors = ["Le nom d'utilisateur est invalide. Utilisez uniquement des lettres et des chiffres."];
            }

            if ($this->emailInvalid() === true) {
                $errors = ["L'adresse email est invalide."];
            }

            if ($this->pwdInvalid() === true) {
                $errors = ["Le mot de passe est invalide."];
            }

            if ($this->pwdMatch() === false) {
                $errors = ["Les mots de passe ne sont pas identiques."];
            }

            if ($this->usernameTaken() === true) {
                $errors = ["Ce nom d'utilisateur est déjà utilisé."];
            }

            if ($this->emailTaken() === true) {
                $errors = ["Cet email est déjà utilisé."];
            }

            if ($this->userUnderAge() === true) {
                $errors = ["Vous devez être majeur pour vous inscrire sur notre plateforme."];
            }

            if (! empty($errors)) {
                return $errors;

            } else {
                $repoRegister = new RegistRepository();
                $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->photo_url, $this->credits, $this->id_role);

                $_SESSION["id"]       = $newUser->getId();
                $_SESSION["username"] = $newUser->getUsername();
                $_SESSION["email"]    = $newUser->getEmail();
                $_SESSION["photo"]    = $newUser->getPhotoUrl();
                $_SESSION["role"]     = $newUser->getIdRole();
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    protected function InputEmpty()
    {
        if (empty($this->id_role) || empty($this->username) || empty($this->email) || empty($this->date_of_birth) || empty($this->password) || empty($this->passwordVerif)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}

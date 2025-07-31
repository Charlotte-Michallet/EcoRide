<?php
namespace App\Controller\Auth;

class ModifyProContr extends AccountContr
{
    public function checkImputRegisterUser()
    {
        // $errors = [];
        // try {
        //     // if ($this->InputEmpty() === true) {
        //     //     $errors = ["empty" => "Tous les champs sont obligatoires."];
        //     //     return $errors;
        //     // }

        //     // if ($this->userInvalid() === true) {
        //     //     $errors = ["userInvalid" => "Le nom d'utilisateur est invalide. Utilisez uniquement des lettres et des chiffres."];
        //     //     return $errors;
        //     // }

        //     // if ($this->emailInvalid() === true) {
        //     //     $errors = ["emailInvalide" => "L'adresse email est invalide."];
        //     //     return $errors;
        //     // }

        //     // if ($this->pwdInvalid() === true) {
        //     //     $errors = ["pwdInvalide" => "Le mot de passe est invalide."];
        //     //     return $errors;
        //     // }

        //     // if ($this->pwdMatch() === false) {
        //     //     $errors = ["passwordMatch" => "Les mots de passe ne sont pas identiques."];
        //     //     return $errors;
        //     // }

        //     // if ($this->usernameTaken() === true) {
        //     //     $errors = ["userTaken" => "Ce nom d'utilisateur est déjà utilisé."];
        //     //     return $errors;
        //     // }

        //     // if ($this->emailTaken() === true) {
        //     //     $errors = ["emailTaken" => "Cet email est déjà utilisé."];
        //     //     return $errors;
        //     // }

        //     // if ($this->userUnderAge() === true) {
        //     //     $errors = ["userAge" => "Vous devez être majeur pour vous inscrire sur notre plateforme."];
        //     //     return $errors;
        //     // }

        //     // if (! empty($errors)) {
        //     //     return $errors;

        //     } else {
        //         // $repoRegister = new RegistRepository();
        //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

        //         // $_SESSION["id"]       = $newUser->getId();
        //         // $_SESSION["username"] = $newUser->getUsername();
        //         // $_SESSION["email"]    = $newUser->getEmail();
        //     }
        // } catch (\Exception $e) {
        //     throw new \Exception($e->getMessage());
        // }
    }

    protected function InputEmpty()
    {
        // if (empty($this->username || $this->email || $this->date_of_birth || $this->password || $this->passwordVerif)) {
        //     $result = true;
        // } else {
        //     $result = false;
        // }
        // return $result;
    }
}

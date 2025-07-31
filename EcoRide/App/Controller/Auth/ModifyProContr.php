<?php
namespace App\Controller\Auth;

use App\Repository\ModifyProfilRepo;

class ModifyProContr extends AccountContr
{

    public function checkImput()
    {
        $errors = [];
        try {

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function checkRole()
    {
        $errors = [];
        try {

            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkUsername($username, $id)
    {
        $this->username = $username;
        $this->id       = $id;

        $errors = [];
        try {
            if (empty($this->username)) {
                $errors = ["empty" => "Le champs doit etre rempli"];
                return $errors;
            }
            if ($this->userInvalid() === true) {
                $errors = ["userInvalid" => "Le nom d'utilisateur est invalide. Utilisez uniquement des lettres et des chiffres."];
                return $errors;
            }

            if ($this->usernameTaken() === true) {
                $errors = ["userTaken" => "Ce nom d'utilisateur est déjà utilisé."];
                return $errors;
            }
            if (! empty($errors)) {
                return $errors;

            } else {
                $modifyRepo           = new ModifyProfilRepo;
                $user                 = $modifyRepo->UpdateUsername($this->username, $this->id);
                $_SESSION["username"] = $user->getUsername();
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkEmail($email, $id)
    {
        $this->email = $email;
        $this->id    = $id;
        $errors      = [];

        try {

            if ($this->emailInvalid() === true) {
                $errors = ["L'adresse email est invalide."];
                return $errors;
            }

            if ($this->emailTaken() === true) {
                $errors = ["Cet email est déjà utilisé."];
                return $errors;
            }

            if (! empty($errors)) {
                return $errors;

            } else {
                $modifyRepo        = new ModifyProfilRepo;
                $user              = $modifyRepo->UpadateEmail($this->email, $this->id);
                $_SESSION["email"] = $user->getEmail();

            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkPassword()
    {
        $errors = [];
        try {

            //     // if ($this->pwdInvalid() === true) {
            //     //     $errors = ["pwdInvalide" => "Le mot de passe est invalide."];
            //     //     return $errors;
            //     // }

            //     // if ($this->pwdMatch() === false) {
            //     //     $errors = ["passwordMatch" => "Les mots de passe ne sont pas identiques."];
            //     //     return $errors;
            //     // }

            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkPhoto()
    {
        $errors = [];
        try {
//  $_SESSION["photo"]    = $newUser->getPhotoUrl();
            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkLicense()
    {
        $errors = [];
        try {

            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkAccept()
    {
        $errors = [];
        try {
            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function checkPreferences()
    {
        $errors = [];
        try {

            //     // if (! empty($errors)) {
            //     //     return $errors;

            //     } else {
            //         // $repoRegister = new RegistRepository();
            //         // $newUser      = $repoRegister->createUser($this->username, $this->email, $this->password, $this->date_of_birth, $this->credits, $this->id_role);

            //         //
            //         // $_SESSION["email"]    = $newUser->getEmail();
            //     }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

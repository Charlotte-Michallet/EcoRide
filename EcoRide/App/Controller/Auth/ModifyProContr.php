<?php
namespace App\Controller\Auth;

use App\Repository\ModifyProfilRepo;

class ModifyProContr extends AccountContr
{
    private $animal;
    private $smoking;
    private $description;

    public function checkRole($id_role, $id)
    {
        $this->id_role = $id_role;
        $this->id      = $id;
        $errors        = [];

        try {
            if ($this->id_role === null) {
                $errors = ["Le champs doit etre rempli"];
                return $errors;

            } else {
                $modifyRepo       = new ModifyProfilRepo;
                $user             = $modifyRepo->UpdateRole($this->id_role, $this->id);
                $_SESSION["role"] = $user->getIdRole();
            }
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
                $errors = ["Le champs doit etre rempli"];
            }
            if ($this->userInvalid() === true) {
                $errors = ["Le nom d'utilisateur est invalide. Utilisez uniquement des lettres et des chiffres."];
            }

            if ($this->usernameTaken() === true) {
                $errors = ["Ce nom d'utilisateur est déjà utilisé."];
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
            }

            if ($this->emailTaken() === true) {
                $errors = ["Cet email est déjà utilisé."];
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

    public function checkPassword($password, $passwordVerif, $id)
    {
        $this->password      = $password;
        $this->passwordVerif = $passwordVerif;
        $this->id            = $id;
        $errors              = [];
        try {

            if ($this->pwdInvalid() === true) {
                $errors = ["Le mot de passe est invalide."];
            }

            if ($this->pwdMatch() === false) {
                $errors = ["Les mots de passe ne sont pas identiques."];
            }

            if (! empty($errors)) {
                return $errors;

            } else {
                $modifyRepo = new ModifyProfilRepo;
                $modifyRepo->UpadatePassword($this->password, $this->id);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkPhoto($photo, $id)
    {
        $this->photo_url = $photo;
        $this->id        = $id;

        $types   = ["image/png", "image/jpeg", "image/jpg"];
        $maxSize = 3 * 1024 * 1024;
        $errors  = [];

        try {

            if ($this->photo_url['error'] !== UPLOAD_ERR_OK) {
                $errors = ["Erreur lors de l'envoi de l'image." . $this->photo_url['error']];
                return $errors;
            }

            if ($this->photo_url["size"] > $maxSize) {
                $errors = ["La taille de l'image ne doit pas dépasser 3Mo"];
            }

            if (! in_array($this->photo_url["type"], $types)) {
                $errors = ["Format de l'image non autorisé."];
            }

            if (! empty($errors)) {
                return $errors;

            } else {
                // send to folder Upload
                $exetension      = pathinfo($photo["name"], PATHINFO_EXTENSION);
                $imgName         = uniqid() . "." . $exetension;
                $uploadDirectory = dirname(__DIR__, 3) . "/Uploads/img";
                $uploadPath      = $uploadDirectory . $imgName;

                if (! move_uploaded_file($photo["tmp_name"], $uploadPath)) {
                    $errors = ["Erreur lors de l'enregistrement de l'image."];
                    return $errors;
                }
                $this->photo_url = "/Uploads/img" . $imgName;

                $modifyRepo = new ModifyProfilRepo;
                $user       = $modifyRepo->UpadatePhoto($this->photo_url, $this->id);

                $_SESSION["photo"] = $user->getPhotoUrl();
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkLicense($license, $id)
    {

        $this->drivers_license = $license;
        $this->id              = $id;
        $errors                = [];

        try {
            if (preg_match("/^\d{12}$/", $this->drivers_license) || preg_match("/^[a-zA-Z0-9]{1,15}$/", $this->drivers_license)) {

                $modifyRepo = new ModifyProfilRepo;
                $modifyRepo->UpadateLicense($this->drivers_license, $this->id);

            } else {
                $errors = ["Le numéro de permis n'est pas valide."];
                return $errors;
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function checkAccept($animal, $smoking, $id)
    {
        $this->animal  = $animal;
        $this->smoking = $smoking;
        $this->id      = $id;
        $errors        = [];

        if ($this->animal === "") {
            $errors = ["Choisissez les préferennces."];

        } elseif ($this->animal === "acceptAnimal") {
            $this->animal = true;

        } else {
            $this->animal = false;
        }

        if ($this->smoking === "") {
            $errors = ["Choisissez les préferennces."];

        } elseif ($this->smoking === "smoking") {
            $this->smoking = true;

        } else {
            $this->smoking = false;

        }

        try {
            if (! empty($errors)) {
                return $errors;

            } else {
                $modifyRepo = new ModifyProfilRepo;
                $modifyRepo->CreatOrUpadateAccepte($this->animal, $this->smoking, $this->id);
            }

        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function checkPreferences($description, $id)
    {
        $this->description = $description;
        $this->id          = $id;
        $errors            = [];

        if (empty($this->description)) {
            $errors = ["Le champs doit etre rempli"];
        }

        if (! preg_match("/^[a-zA-Z0-9\s\-.&+\/()[\]]+$/", $this->description)) {
            $errors = ["Le champs ne doit pas contenir de caractère spéciaux."];
        }

        try {
            if (! empty($errors)) {
                return $errors;

            } else {
                $modifyRepo  = new ModifyProfilRepo;
                $preferences = $modifyRepo->UpadatePreferences($this->description, $this->id);

                if (! empty($preferences)) {
                    $errors = ["Il faut remplir les préférences avant."];
                    return $errors;
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}

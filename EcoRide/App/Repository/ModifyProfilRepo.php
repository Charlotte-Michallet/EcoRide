<?php
namespace App\Repository;

use App\Entity\Preferences;
use App\Entity\User;

class ModifyProfilRepo extends Repository
{

    public function UpdateRole(int $id_role, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET id_role = :id_role WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":id_role", $id_role, $this->pdo::PARAM_INT);
        $query->execute();

        // Hydration
        $userInfo = new User();
        $userInfo->setIdRole($id_role);
        return $userInfo;

        //    ( password,) VALUES(:password

    }

    public function UpdateUsername(string $username, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET username = :username WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":username", $username, $this->pdo::PARAM_STR);

        $query->execute();

        // Hydration
        $userInfo = new User();
        $userInfo->setUsername($username);
        return $userInfo;
    }

    public function UpadateEmail(string $email, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET email = :email WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":email", $email, $this->pdo::PARAM_STR);
        $query->execute();

        // Hydration
        $userInfo = new User();
        $userInfo->setEmail($email);
        return $userInfo;
    }

    public function UpadatePhoto(string $photo_url, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET photo = :photo WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":photo", $photo_url, $this->pdo::PARAM_STR);
        $query->execute();

        // Hydration
        $userInfo = new User();
        $userInfo->setPhotoUrl($photo_url);
        return $userInfo;
    }

    public function UpadateLicense(string $drivers_license, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET drivers_license = :license WHERE id = :id;");

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":license", $drivers_license, $this->pdo::PARAM_STR);
        $query->execute();

        // Hydration
        $userInfo = new User();
        $userInfo->setDriversLicense($drivers_license);
        return $userInfo;
    }

    public function UpadatePassword(string $password, int $id)
    {
        $query = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id;");

        // hash password
        $hashPwd = password_hash($password, PASSWORD_DEFAULT);

        $query->bindValue(":id", $id, $this->pdo::PARAM_INT);
        $query->bindValue(":password", $hashPwd, $this->pdo::PARAM_STR);

        $query->execute();
    }

    public function CreatOrUpadateAccepte(bool $animal, bool $smoking, int $user_id)
    {
        // check if
        $check = $this->pdo->prepare("SELECT COUNT(*) FROM preferences WHERE user_id = :user_id;");
        $check->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
        $check->execute();

        $exists = $check->fetchColumn() > 0;

        if ($exists) {
            $query = $this->pdo->prepare("UPDATE preferences SET smoking_allowed = :smoking, animal_allowed = :animal WHERE user_id = :user_id;");
        } else {
            $query = $this->pdo->prepare("INSERT INTO preferences (user_id, smoking_allowed, animal_allowed) VALUES (:user_id, :smoking, :animal);");
        }

        $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
        $query->bindValue(":animal", $animal, $this->pdo::PARAM_BOOL);
        $query->bindValue(":smoking", $smoking, $this->pdo::PARAM_BOOL);
        $query->execute();

        // Hydration
        $preferencesEntity = new Preferences();
        $preferencesEntity->setUserId($user_id);
        $preferencesEntity->setSmoking($smoking);
        $preferencesEntity->setAnimal($animal);

        return $preferencesEntity;
    }

    public function UpadatePreferences(string $description, int $user_id)
    {
        $query = $this->pdo->prepare("UPDATE users SET description = :description WHERE user_id = :user_id;");

        $query->bindValue(":user_id", $user_id, $this->pdo::PARAM_INT);
        $query->bindValue(":description", $description, $this->pdo::PARAM_STR);
        $query->execute();

        // Hydration
        $preferencesEntity = new Preferences();
        $preferencesEntity->setUserId($user_id);
        $preferencesEntity->setDescription($description);

        return $preferencesEntity;
    }

    public function checkUserInDb(string $username): mixed
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username;");

        $query->bindValue(":username", $username);
        $query->execute();

        $count = $query->fetchColumn();

        return $count > 0;
    }

    public function checkEmailInDb(string $email): mixed
    {
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email;");

        $query->bindValue(":email", $email);
        $query->execute();

        $count = $query->fetchColumn();

        return $count > 0;
    }
}

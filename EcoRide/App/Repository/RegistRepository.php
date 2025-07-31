<?php
namespace App\Repository;

use App\Entity\User;

class RegistRepository extends Repository
{
    public function createUser(string $username, string $email, string $password, string $date_of_birth, int $credits, int $id_role): User
    {
        $query = $this->pdo->prepare("INSERT INTO users (username, email, password, date_of_birth, credits, id_role) VALUES(:username,:email, :password, :date, :credits, :id_role);");

        // hash password
        $hashPwd = password_hash($password, PASSWORD_DEFAULT);

        // bind value from form to query
        $query->bindValue(":username", $username, $this->pdo::PARAM_STR);
        $query->bindValue(":email", $email, $this->pdo::PARAM_STR);
        $query->bindValue(":password", $hashPwd, $this->pdo::PARAM_STR);
        $query->bindValue(":date", $date_of_birth, $this->pdo::PARAM_STR);
        $query->bindValue(":credits", $credits, $this->pdo::PARAM_INT);
        $query->bindValue(":id_role", $id_role, $this->pdo::PARAM_INT);
        $query->execute();
        $query->fetch(\PDO::FETCH_ASSOC);

        // user id (from user table just created)
        $lastInsertedId = $this->pdo->lastInsertId();

        // Hydration
        $userInfo = new User();
        $userInfo->setId($lastInsertedId);
        $userInfo->setUsername($username);
        $userInfo->setEmail($email);
        $userInfo->setPhotoUrl("/assets/img/user.jpg");
        $userInfo->setDateOfBirth($date_of_birth);
        $userInfo->setCredits($credits);
        $userInfo->setIdRole($id_role);

        return $userInfo;
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

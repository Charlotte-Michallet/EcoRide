<?php
namespace App\Repository;

use App\Entity\User;

class LoginRepository extends Repository
{

    public function getUser(string $email, string $password): bool | User
    {
        $query = $this->pdo->prepare("SELECT * FROM users WHERE email = :email;");

        // bind value from form to query
        $query->bindValue(":email", $email, $this->pdo::PARAM_STR);
        $query->execute();

        $user = $query->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            // Hydration
            $userInfo = new User();
            $userInfo->setId($user["id"]);
            $userInfo->setUsername($user["username"]);
            $userInfo->setEmail($user["email"]);
            $userInfo->setPhotoUrl($user["photo"]);
            $userInfo->setDateOfBirth($user["date_of_birth"]);
            $userInfo->setCredits($user["credits"]);
            $userInfo->setIdRole($user["id"]);

            return $userInfo;
        } else {
            return false;
        }
    }
}

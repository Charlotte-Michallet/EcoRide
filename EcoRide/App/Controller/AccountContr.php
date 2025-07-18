<?php
namespace App\Controller;

use App\Repository\RegistRepository;

class AccountContr
{
    protected int $id;
    protected string $username;
    protected string $email;
    protected string $password;
    protected string $passwordVerif;
    protected string $date_of_birth;
    protected string $photo_url;
    protected int $credits;
    protected int $id_role;
    protected string $drivers_license;

    // verify special caratares
    protected function userInvalid()
    {
        if (! preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function emailInvalid()
    {
        if (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // verify if email is valid
    protected function pwdInvalid()
    {}

    protected function pwdMatch()
    {
        if ($this->password !== $this->passwordVerif) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function usernameTaken()
    {
        $userRepo = new RegistRepository();
        if ($userRepo->checkUserInDb($this->username)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function emailTaken()
    {
        $userRepo = new RegistRepository();
        if ($userRepo->checkEmailInDb($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function userUnderAge()
    {

        $today = new \DateTimeImmutable();
        $dOB   = \DateTimeImmutable::createFromFormat('Y-m-d', $this->date_of_birth);

        if ($dOB === false) {
            error_log("Date de naissance invalide: " . $this->date_of_birth);
            return true;
        }

        $interval = $dOB->diff($today);
        $age      = $interval->y;

        if ($age < 18) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}

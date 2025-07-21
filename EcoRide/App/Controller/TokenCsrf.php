<?php

namespace App\Controller;

class TokenCsrf
{

    public function getGenerateToken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            throw new \RuntimeException("Erreur critique : La session PHP n'est pas active.");
        }
        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }
        $currentToken =  $_SESSION["csrf_token"];
        return $currentToken;
    }

    public function validateToken($submittedToken)
    {
        if (session_status() == PHP_SESSION_NONE) {
            throw new \RuntimeException("Erreur critique : La session PHP n'est pas active.");
        }

        $currentToken =  $_SESSION["csrf_token"];

        if ($submittedToken === null || !isset($currentToken)) {
            return false;
        }

        $isValid = hash_equals($submittedToken, $currentToken);
        if ($isValid)
            unset($currentToken);
        return $isValid;
    }
}

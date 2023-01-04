<?php

namespace App\Auth;

use App\Core\IAuthenticator;
use App\Models\User;

/**
 * Class DBAuthenticator
 * @package App\Auth
 */
class Authenticator implements IAuthenticator
{
    public function __construct()
    {
        session_start();
    }

    function  login($login, $password): bool
    {
        $user = User::getAll("username = ?", [$login])[0] ?? null;

        if ($user != null) {
            if (password_verify($password, $user->getPasswordHash())) {
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }


    function logout(): void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            session_destroy();
        }
    }

    function getLoggedUserName(): string
    {
        return $_SESSION['user']->getUsername() ?? throw new \Exception("User not logged in");
    }

    function getLoggedUserId(): mixed
    {
        return $_SESSION['user']->getId() ?? throw new \Exception("User not logged in");
    }

    function getLoggedUserContext(): mixed
    {
        return $_SESSION['user'] ?? throw new \Exception("User not logged in");
    }

    function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null;
    }
}
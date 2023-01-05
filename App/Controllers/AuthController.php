<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\User;
use Exception;

/**
 * Class AuthController
 * Controller for authentication actions
 * @package App\Controllers
 */
class AuthController extends AControllerBase
{
    /**
     *
     * @return \App\Core\Responses\RedirectResponse|\App\Core\Responses\Response
     */
    public function index(): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    public function register(): Response
    {
        return $this->html([
            'user' => new User()
        ],
            'register'
        );
    }

        /**
         * @throws \Exception
         */
    public function store(): Response
    {
        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit'])) {
            $username = trim($formData["username"]);
            if (empty($username)) {
                throw new Exception("Nezadané žiadne používateľské meno");
            }

            $loginExists = count(User::getAll("username = ?", [$username])) > 0;
            if ($loginExists) {
                throw new Exception("Používateľské meno už niekto používa");
            }

            $email = filter_var($formData["email"], FILTER_VALIDATE_EMAIL);
            if (!$email) {
                throw new Exception("Emailová adresa nie je platná");
            }

            $emailExists = count(User::getAll("email = ?", [$email])) > 0;
            if ($emailExists) {
                throw new Exception("Zadaný email už niekto používa");
            }


            $password = $formData["password"];
            $password2 = $formData["password2"];
            if ($password !== $password2) {
                throw new Exception("Zadané heslá sa nezhodujú");
            }

            $user = new User();
            $user->setUsername($username);
            $user->setMeno($this->request()->getValue('meno'));
            $user->setEmail($email);
            $user->setPasswordHash(password_hash($password, PASSWORD_DEFAULT));
            $user->setCreatedAt(date("Y-m-d H:i:s"));
            $user->save();
        }
        return $this->redirect("?c=auth&a=login");
    }


    public function login(): Response
    {
        return $this->html(null,'login');
    }

    /**
     * @return \App\Core\Responses\JsonResponse
     */
    public function loginUser(): Response
    {
        $login = $this->request()->getValue('username');
        $password = $this->request()->getValue('password');
        $logged = $this->app->getAuth()->login($login, $password);

        if(!$logged) {
            return $this->json(['success' => false, 'message' => 'Zlý login alebo heslo']);
        }
        return $this->json(['success' => true]);
    }


    /**
     * Logout a user
     * @return \App\Core\Responses\ViewResponse
     */
    public function logout(): Response
    {
        $this->app->getAuth()->logout();
        return $this->redirect('?c=home');
        //return $this->html();
    }
}
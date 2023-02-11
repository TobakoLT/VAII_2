<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\Post;
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
         * @throws Exception
         */
    public function store(): Response
    {
        date_default_timezone_set('Europe/Prague');

        $formData = $this->app->getRequest()->getPost();
        if (isset($formData['submit'])) {
            $username = trim($formData["username"]);
            if (empty($username)) {
                throw new Exception("Nezadané žiadne používateľské meno");
            }

            $email = filter_var($formData["email"], FILTER_VALIDATE_EMAIL);
            if (!$email) {
                throw new Exception("Emailová adresa je neplatná");
            }

            $password = $formData["password"];
            $password2 = $formData["password2"];
            if ($password !== $password2) {
                throw new Exception("Zadané heslá sa nezhodujú");
            }
            if ($formData['form_name'] === 'register_form') {
                $loginExists = count(User::getAll("username = ?", [$username])) > 0;
                if ($loginExists) {
                    throw new Exception("Používateľské meno už niekto používa");
                }

                $emailExists = count(User::getAll("email = ?", [$email])) > 0;
                if ($emailExists) {
                    throw new Exception("Zadaný email už niekto používa");
                }
                $user = new User();
                $user->setUsername($username);
                $user->setMeno($this->request()->getValue('meno'));
                $user->setEmail($email);
                $user->setPasswordHash(password_hash($password, PASSWORD_DEFAULT));
                $user->setCreatedAt(date("Y-m-d H:i:s"));
                $user->save();
                return $this->redirect("?c=auth&a=login");
            } else if ($formData['form_name'] === 'profile_form') {
                $userId = $_SESSION["user"]->getId();
                $user = User::getOne($userId);
                if (!$user) {
                    throw new Exception("Používateľ s daným ID neexistuje");
                }

                $usernameExists = count(User::getAll("username = ? AND id != ?", [$username, $userId])) > 0;
                if ($usernameExists) {
                    throw new Exception("Používateľské meno už niekto používa");
                }

                $emailExists = count(User::getAll("email = ? AND id != ?", [$email, $userId])) > 0;
                if ($emailExists) {
                    throw new Exception("Zadaný email už niekto používa");
                }
                $user->setUsername($username);
                $user->setMeno($this->request()->getValue('meno'));
                $user->setEmail($email);
                if (!empty($password)) {
                    $user->setPasswordHash(password_hash($password, PASSWORD_DEFAULT));
                }

                $newPhoto = $this->processUploadedFile($user);
                if ($newPhoto != null) {
                    $user->setAccountImg($newPhoto);
                }
                $user->setEditedAt(date("Y-m-d H:i:s"));
                $user->save();
                $_SESSION["user"] = $user;
            }

        }
        return $this->redirect("?c=auth&a=account");
    }


    /**
     * @return \App\Core\Responses\ViewResponse
     */
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


    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function account(): Response
    {
        return $this->html();
    }


    public function delete()
    {
        $id = $this->request()->getValue('id');
        $userToDelete = User::getOne($id);
        if ($userToDelete || $userToDelete->getAccountImg()) {
            $userToDelete->delete();
            unlink($userToDelete->getAccountImg());
        }
        $this->logout();
        return $this->redirect("?c=home");
    }

    private function processUploadedFile(User $user)
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "photosAccount" . DIRECTORY_SEPARATOR . time() . "_" . $photo['name'];
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                if ($user->getId() && $user->getAccountImg()) {
                    unlink($user->getAccountImg());
                }
                return $targetFile;
            }
        }
        return null;
    }
}
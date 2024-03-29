<?php
namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\RedirectResponse;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\ForumPost;
use App\Models\ForumTheme;
use App\Models\User;
use Exception;

/**
 *
 */
class ForumThemesController extends AControllerBase
{
    /**
     * @param $action
     * @return bool
     */
    public function authorize($action): bool
    {
        switch ($action) {
            case "delete":
            case "create":
            case "store":
            case "edit":
                return $this->app->getAuth()->isLogged();

        }
        return true;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function index(): Response
    {
        $forumThemes = ForumTheme::getAll();
        $postCount = [];

        foreach ($forumThemes as $theme) {
            $posts = ForumPost::getAll("theme_id = ?", [$theme->getId()]);
            $postCount[$theme->getId()] = count($posts);
        }
        return $this->html(["forumThemes" => $forumThemes, "postCount" =>$postCount]);
    }

    /**
     * @throws Exception
     */
    public function delete(): void
    {
        $id = $this->request()->getValue('id');
        $themeToDelete = ForumTheme::getOne($id);
        if ($themeToDelete) {
            $postsToDelete = ForumPost::getAll("theme_id = ?", [$id]);
            foreach ($postsToDelete as $post) {
                $post->delete();
            }
            $themeToDelete->delete();
            echo 'Téma bola úspešne vymazaná';
        } else {
            echo 'Téma sa nepodarilo vymazať';
        }
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws Exception
     */
    public function store(): RedirectResponse
    {
        date_default_timezone_set('Europe/Prague');
        $id = $this->request()->getValue('id');
        $theme = ($id ? ForumTheme::getOne($id) : new ForumTheme());

        $title = trim($this->request()->getValue('title'));
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        if (strlen($title) > 50 || strlen($title) < 3) {
            throw new Exception("Error: Názov témy moze mať maximálne 50 znakov a minimálne 3");
        }
        $theme->setNazov($title);

        $description = trim($this->request()->getValue('description'));
        $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
        if (strlen($description) > 400 || strlen($description) < 10) {
            throw new Exception("Error: Popis témy moze mať maximálne 400 znakov a minimálne 10");
        }
        $theme->setPopis($description);
        $theme->setCreatedAt(date("Y-m-d H:i:s"));
        $theme->save();
        return $this->redirect("?c=forumThemes");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html(new ForumTheme(), viewName: 'create.form');
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws Exception
     */
    public function edit()
    {
        $id = $this->request()->getValue('id');
        $themeToEdit = ForumTheme::getOne($id);
        return $this->html($themeToEdit, viewName: 'create.form');
    }
}
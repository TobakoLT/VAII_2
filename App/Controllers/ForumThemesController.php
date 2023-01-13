<?php
namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
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
        return $this->html($forumThemes);
    }

    /**
     * @return Response
     */
    public function themes(): Response
    {
        return $this->html();
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws Exception
     */
    public function delete()
    {
        $id = $this->request()->getValue('id');
        $themeToDelete = ForumTheme::getOne($id);
        if ($themeToDelete) {
            $themeToDelete->delete();
        }
        return $this->redirect("?c=forumThemes&a=themes");
    }

    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $theme = ($id ? ForumTheme::getOne($id) : new ForumTheme());

        $theme->setNazov($this->request()->getValue('title'));
        $theme->setCreatedAt(date("Y-m-d"));
        $theme->setPopis($this->request()->getValue('description'));

        $theme->save();
        return $this->redirect("?c=forumthemes");
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     */
    public function create()
    {
        return $this->html(new ForumTheme(), viewName: 'create');
    }

    /**
     * @return \App\Core\Responses\ViewResponse
     * @throws Exception
     */
    public function edit()
    {
        $id = $this->request()->getValue('id');
        $themeToEdit = ForumTheme::getOne($id);
        return $this->html($themeToEdit, viewName: 'create');
    }
}
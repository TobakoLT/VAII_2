<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Core\Responses\JsonResponse;
use App\Models\ForumTheme;
use App\Models\ForumPost;
use App\Models\Post;
use Exception;

/**
 *
 */
class ForumPostsController extends AControllerBase
{
    public function index(): Response
    {
        $themeId = $this->request()->getValue('themeId');
        $posts = ForumPost::getAll("theme_id = ?", [$themeId]);
        return $this->html(['posts' => $posts, 'themeId' => $themeId]);
    }

    public function showAllPosts(): Response
    {
        $themeId = NULL;
        $forumPosts = ForumPost::getAll();
        return $this->html(['posts' => $forumPosts, 'themeId' => $themeId], viewName: 'index');
    }

    public function userPosts(): Response
    {
        $myPost = 1;
        $themeId = NULL;
        $user = $_SESSION["user"]->getId();
        $forumPosts = ForumPost::getAll("author = ?", [$user]);
        return $this->html(['posts' => $forumPosts, 'themeId' => $themeId, 'myPost' => $myPost], viewName: 'index');
    }

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
     * @return \App\Core\Responses\RedirectResponse
     * @throws Exception
     */
    public function store()
    {
        date_default_timezone_set('Europe/Prague');
        $id = $this->request()->getValue('id');
        $post = ($id ? ForumPost::getOne($id) : new ForumPost());
        $post->setThemeId($this->request()->getValue('theme_id'));

        $postText = trim($this->request()->getValue('post_text'));
        $postText = htmlspecialchars($postText, ENT_QUOTES, 'UTF-8');

        if (strlen($postText) > 500 || strlen($postText) < 50) {
            throw new Exception("Error: Text príspevku musí mať maximálne 500 znakov a minimálne 50");
        }

        $post->setPostText($postText);

        $post->setAuthor($_SESSION['user']->getId());
        $post->setCreatedAt(date('Y-m-d H:i:s'));
        $newPhoto = $this->processUploadedFile($post);
        if ($newPhoto != null) {
            $post->setAttachmentImage($newPhoto);
        }
        $forumTheme = $this->request()->getValue('theme_id');
        $post->save();
        return $this->redirect("?c=forumPosts&a=index&themeId=" . $forumTheme);
    }

    public function create()
    {
        $id = $this->request()->getValue('id');
        return $this->html(['post' => new ForumPost(), 'id' => $id], viewName: 'create.form');
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $id = $this->request()->getValue('id');
        $theme_id = $this->request()->getValue('theme_id');
        $postToDelete = ForumPost::getOne($id);
        if (!$postToDelete || !$this->app->getAuth()->getLoggedUserContext()->getAdmin() && ($this->app->getAuth()->getLoggedUserId() !== $postToDelete->getAuthor())) {
            return $this->redirect("?c=forumThemes");
        }
        $postToDelete->delete();

        return $this->redirect('?c=forumPosts&a=index&themeId=' . $theme_id);
    }


    public function edit()
    {
        $id = $this->request()->getValue('id');
        $postToEdit = ForumPost::getOne($id);
        return $this->html(['post' => $postToEdit], viewName: 'create.form');
    }

    private function processUploadedFile(ForumPost $post)
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public/photosPostsForum/" . time() . "_" . $photo['name'];
            if (!getimagesize($photo["tmp_name"])) {
                throw new Exception("Chyba: nahrany subor nie je obrazok");
            }
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                if ($post->getId() && $post->getAttachmentImage()) {
                    unlink($post->getAttachmentImage());
                }
                return $targetFile;
            }
        }
        return null;
    }

}
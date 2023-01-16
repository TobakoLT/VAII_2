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
        $post->setPostText($this->request()->getValue('post_text'));
        $post->setAuthor($_SESSION['user']->getUsername());
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
        return $this->html(['post' => new ForumPost(),'id' => $id], viewName: 'create.form');
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $postToEdit = ForumPost::getOne($id);
        return $this->html($postToEdit, viewName: 'create.form');
    }

    public function showAllPosts(): Response
    {
        $forumPosts = ForumPost::getAll();
        return $this->html($forumPosts, viewName: 'index');
    }

    private function processUploadedFile(ForumPost $post)
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "photosPostsForum" . DIRECTORY_SEPARATOR . time() . "_" . $photo['name'];
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
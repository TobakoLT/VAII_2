<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Post;
use Exception;

class PostsController extends AControllerBase
{

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

    public function index(): Response
    {
        $posts = Post::getAll();
        return $this->html($posts);
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $postToDelete = Post::getOne($id);
        if ($postToDelete || $postToDelete->getObrazok()) {
            $postToDelete->delete();
            unlink($postToDelete->getObrazok());
        }
        return $this->redirect("?c=posts");
    }


    /**
     * @return \App\Core\Responses\RedirectResponse
     * @throws Exception
     */
    public function store()
    {
        date_default_timezone_set('Europe/Prague');

        $nadpis = trim($this->request()->getValue('nadpis'));
        $nadpis = htmlspecialchars($nadpis, ENT_QUOTES, 'UTF-8');
        if (mb_strlen($nadpis, "UTF-8") > 50 || mb_strlen($nadpis, "UTF-8") < 10) {
            throw new Exception("Chyba: nadpis moze mat maximalne 50 a minimalne 10 znakov!");
        }

        $clanok = trim($this->request()->getValue('clanok'));
        $clanok = htmlspecialchars($clanok, ENT_QUOTES, 'UTF-8');
        if (mb_strlen($clanok, "UTF-8") > 1000 || mb_strlen($clanok, "UTF-8") < 100) {
            throw new Exception("Chyba: clanok moze mat maximalne 50 a minimalne 10 znakov!");
        }

        $id = $this->request()->getValue('id');
        $post = ($id ? Post::getOne($id) : new Post());
        $post->setAutor($_SESSION["user"]->getMeno());
        $post->setNadpis($nadpis);
        $post->setDatum(date("Y-m-d"));
        $post->setClanok($clanok);
        $newPhoto = $this->processUploadedFile($post);
        if ($newPhoto != null) {
            $post->setObrazok($newPhoto);
        }

        $post->save();

        return $this->redirect("?c=posts");
    }

    public function create()
    {
        return $this->html(new Post(), viewName: 'create.form');
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $postToEdit = Post::getOne($id);
        return $this->html($postToEdit, viewName: 'create.form');
    }

    private function processUploadedFile(Post $post)
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "photosPosts" . DIRECTORY_SEPARATOR . time() . "_" . $photo['name'];
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                if ($post->getId() && $post->getObrazok()) {
                    unlink($post->getObrazok());
                }
                return $targetFile;
            }
        }
        return null;
    }
}
<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Post;

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

    public function store()
    {
        date_default_timezone_set('Europe/Prague');
        $id = $this->request()->getValue('id');
        $post = ($id ? Post::getOne($id) : new Post());
        $oldPhoto = $post->getObrazok();

        $post = ( $id ? Post::getOne($id) : new Post());
        $post->setAutor($_SESSION["user"]->getMeno());
        $post->setNadpis($this->request()->getValue('nadpis'));
        $post->setDatum(date("Y-m-d"));
        $post->setClanok($this->request()->getValue('clanok'));
        //$post->setObrazok($this->processUploadedFile($post));
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
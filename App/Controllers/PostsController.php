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
        if ($postToDelete) {
            $postToDelete->delete();
        }
        return $this->redirect("?c=posts");
    }

    public function store()
    {
        $id = $this->request()->getValue('id');

        $post = ( $id ? Post::getOne($id) : new Post());
        $post->setAutor($this->request()->getValue('autor'));
        $post->setNadpis($this->request()->getValue('nadpis'));
        $post->setDatum(date("Y-m-d"));
        $post->setClanok($this->request()->getValue('clanok'));
        $post->setObrazok($this->request()->getValue('obrazok'));
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
}
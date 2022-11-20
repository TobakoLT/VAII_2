<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Image;

class ImagesController extends AControllerBase
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
        $images = Image::getAll();
        return $this->html($images);
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $imageToDelete = Image::getOne($id);
        if ($imageToDelete) {
            $imageToDelete->delete();
        }
        return $this->redirect("?c=images");
    }

    public function store()
    {
        $id = $this->request()->getValue('id');

        $image = ( $id ? Image::getOne($id) : new Image());
        $image->setImg($this->request()->getValue('img'));
        $image->setText($this->request()->getValue('text'));
        $image->save();
        return $this->redirect("?c=images");
    }

    public function create()
    {
        return $this->html(new Image(), viewName: 'create.form');
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $imageToEdit = Image::getOne($id);
        return $this->html($imageToEdit, viewName: 'create.form');
    }
}
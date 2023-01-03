<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Image;
use App\Models\Post;

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
        if ($imageToDelete->getImg()) {
            unlink($imageToDelete->getImg());
        }
        $imageToDelete->delete();
        return $this->redirect("?c=images");
    }

    public function store()
    {
        $id = $this->request()->getValue('id');
        $image = ( $id ? Image::getOne($id) : new Image());
        $oldPhoto = $image->getImg();

        $image->setText($this->request()->getValue('text'));
        $image->setImg($this->processUploadedFile($image));
        if (!is_null($oldPhoto) && is_null($image->getImg())) {
            unlink($oldPhoto);
        }
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

    private function processUploadedFile(Image $post)
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public" . DIRECTORY_SEPARATOR . "photos" . DIRECTORY_SEPARATOR . time() . "_" . $photo['name'];
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                if ($post->getId() && $post->getImg()) {
                    unlink($post->getImg());
                }
                return $targetFile;
            }
        }
        return null;
    }
}
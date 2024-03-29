<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Image;
use App\Models\Post;
use Exception;

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

    /**
     * @throws Exception
     */
    public function store()
    {
        $id = $this->request()->getValue('id');
        $image = ($id ? Image::getOne($id) : new Image());

        $text = trim($this->request()->getValue('text'));
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $image->setText($text);

        $newPhoto = $this->processUploadedFile($image);
        if ($newPhoto != null) {
            $image->setImg($newPhoto);
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

    /**
     * @param $image
     * @return string|null
     */
    private function processUploadedFile(Image $image): ?string
    {
        $photo = $this->request()->getFiles()['photo'];
        if (!is_null($photo) && $photo['error'] == UPLOAD_ERR_OK) {
            $targetFile = "public/photosImages/" . time() . "_" . $photo['name'];
            if (move_uploaded_file($photo["tmp_name"], $targetFile)) {
                if ($image->getId() && $image->getImg()) {
                    unlink($image->getImg());
                }
                return $targetFile;
            }
        }
        return null;
    }
}
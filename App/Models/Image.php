<?php

namespace App\Models;

use App\Core\Model;

class Image extends Model
{
    protected $id;
    protected $text;
    protected $img;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getImg(): ?string
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg(?string $img): void
    {
        $this->img = $img;
    }


}
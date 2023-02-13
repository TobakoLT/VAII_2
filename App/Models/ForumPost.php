<?php

namespace App\Models;

use App\Core\Model;

class ForumPost extends Model
{
    protected ?int $id = 0;
    protected ?int $theme_id = 0;
    protected ?string $post_text = "";
    protected ?int $author = 0;
    protected ?string $created_at;
    protected ?string $attachment_image = "";

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getThemeId(): ?int
    {
        return $this->theme_id;
    }

    /**
     * @param int|null $theme_id
     */
    public function setThemeId(?int $theme_id): void
    {
        $this->theme_id = $theme_id;
    }

    /**
     * @return string|null
     */
    public function getPostText(): ?string
    {
        return $this->post_text;
    }

    /**
     * @param string|null $post_text
     */
    public function setPostText(?string $post_text): void
    {
        $this->post_text = $post_text;
    }

    /**
     * @return int|null
     */
    public function getAuthor(): ?int
    {
        return $this->author;
    }

    /**
     * @param int|null $author
     */
    public function setAuthor(?int $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @param string|null $created_at
     */
    public function setCreatedAt(?string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string|null
     */
    public function getAttachmentImage(): ?string
    {
        return $this->attachment_image;
    }

    /**
     * @param string|null $attachment_image
     */
    public function setAttachmentImage(?string $attachment_image): void
    {
        $this->attachment_image = $attachment_image;
    }


}
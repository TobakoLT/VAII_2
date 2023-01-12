<?php

namespace App\Models;

use App\Core\Model;

class ForumTheme extends Model
{
    protected ?int $id;
    protected ?string $nazov;
    protected ?string $popis;
    protected ?string $created_at;

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
     * @return string|null
     */
    public function getNazov(): ?string
    {
        return $this->nazov;
    }

    /**
     * @param string|null $nazov
     */
    public function setNazov(?string $nazov): void
    {
        $this->nazov = $nazov;
    }

    /**
     * @return string|null
     */
    public function getPopis(): ?string
    {
        return $this->popis;
    }

    /**
     * @param string|null $popis
     */
    public function setPopis(?string $popis): void
    {
        $this->popis = $popis;
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


}
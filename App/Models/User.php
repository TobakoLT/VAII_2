<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected ?int $id = 0;
    protected ?string $username = "";
    protected ?string $email = "";
    protected ?string $meno = "";
    protected ?string $password_hash = "";
    protected ?string $created_at = "";

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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $login
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getMeno(): ?string
    {
        return $this->meno;
    }

    /**
     * @param string|null $meno
     */
    public function setMeno(?string $meno): void
    {
        $this->meno = $meno;
    }

    /**
     * @return string|null
     */
    public function getPasswordHash(): ?string
    {
        return $this->password_hash;
    }

    /**
     * @param string|null $password_hash
     */
    public function setPasswordHash(?string $password_hash): void
    {
        $this->password_hash = $password_hash;
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
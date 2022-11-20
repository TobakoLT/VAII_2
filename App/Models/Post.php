<?php

namespace App\Models;

use App\Core\Model;

class Post extends Model
{
    protected $id;
    protected $autor;
    protected $nadpis;
    protected $datum;
    protected $clanok;
    protected $obrazok;

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
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor): void
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getNadpis()
    {
        return $this->nadpis;
    }

    /**
     * @param mixed $nadpis
     */
    public function setNadpis($nadpis): void
    {
        $this->nadpis = $nadpis;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum): void
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getClanok()
    {
        return $this->clanok;
    }

    /**
     * @param mixed $clanok
     */
    public function setClanok($clanok): void
    {
        $this->clanok = $clanok;
    }

    /**
     * @return mixed
     */
    public function getObrazok()
    {
        return $this->obrazok;
    }

    /**
     * @param mixed $obrazok
     */
    public function setObrazok($obrazok): void
    {
        $this->obrazok = $obrazok;
    }



}
<?php
namespace App\Models;

use App\Core\Sql;

class Product extends Sql{

    protected int $id = 0;
    protected int $id_categorie = 1;
    protected int $id_seller = 1;
    protected string $titre;
    protected string $description;
    protected string $thumbnail;
    protected string $trokos;


    protected bool $is_verified = false;

    public function hydrate($id = null, $id_categorie, $id_seller, $titre, $description, $thumbnail, $trokos) 
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setId_categorie($id_categorie);
        $this->setId_Seller($id_seller);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setThumbnail($thumbnail);
        $this->setTrokos($trokos);
    }

############################# Getters & Setters ###############################
###############################################################################
 
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_categorie
     */ 
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * Get the value of id_seller
     */ 
    public function getId_seller()
    {
        return $this->id_seller;
    }

    /**
     * Set the value of id_seller
     *
     * @return  self
     */ 
    public function setId_seller($id_seller)
    {
        $this->id_seller = $id_seller;

        return $this;
    }

    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of thumbnail
     */ 
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set the value of thumbnail
     *
     * @return  self
     */ 
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get the value of trokos
     */ 
    public function getTrokos()
    {
        return $this->trokos;
    }

    /**
     * Set the value of trokos
     *
     * @return  self
     */ 
    public function setTrokos($trokos)
    {
        $this->trokos = $trokos;

        return $this;
    }
}

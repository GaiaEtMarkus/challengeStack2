<?php
namespace App\Models;

use App\Core\Sql;

class Product extends Sql{

    protected int $id = 0;
    protected int $id_category = 1;
    protected int $id_seller = 1;
    protected string $title;
    protected string $description;
    protected string $thumbnail;
    protected int $trokos;
    protected bool $is_verified;

    public function hydrate($id = null, $id_category, $id_seller, $title, $description, $trokos, $thumbnail, $is_verified)
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setId_category($id_category);
        $this->setId_Seller($id_seller);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setTrokos($trokos);
        $this->setThumbnail($thumbnail);
        $this->setIs_verified($is_verified);        
    }
    
    public function getCategories(): array
    {
        return $this->getAllFromTable('Category');
    }
 
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
    public function getId_category()
    {
        return $this->id_category;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */ 
    public function setId_category($id_categorie)
    {
        $this->id_category = $id_categorie;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Get the value of is_verified
     */ 
    public function getIs_verified()
    {
        return $this->is_verified;
    }

    /**
     * Set the value of is_verified
     *
     * @return  self
     */ 
    public function setIs_verified($is_verified)
    {
        $this->is_verified = $is_verified;

        return $this;
    }
}

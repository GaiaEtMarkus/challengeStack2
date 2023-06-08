<?php
namespace App\Models;

use App\Core\Sql;

class Product extends Sql{

    protected int $id = 0;
    protected int $id_category = 1;
    protected int $id_seller = 1;
    protected string $titre;
    protected string $description;
    protected string $trokos;
    protected bool $is_verified = false;

    public function hydrate($id = null, $id_category, $id_seller, $titre, $description, $trokos, $is_verified) 
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setId_category($id_category);
        $this->setId_Seller($id_seller);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setTrokos($trokos);
        $this->setIs_verified($is_verified); 
    }

    public function getCategories(): array
    {
        return $this->getAllFromTable('Category');
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

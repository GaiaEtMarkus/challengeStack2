<?php

namespace App\Models;

use App\Core\Sql;

class Transaction extends Sql
{
    protected int $id = 0;
    protected int $id_receiver;
    protected int $id_seller;
    protected int $id_item_receiver;
    protected int $id_item_seller;
    protected bool $is_validate;
    protected int $quality;

    public function hydrate($id, $id_receiver, $id_seller, $id_item_receiver, $id_item_seller, $is_validate, $quality)
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setId_receiver($id_receiver);
        $this->setId_seller($id_seller);
        $this->setId_item_receiver($id_item_receiver); 
        $this->setId_item_seller($id_item_seller); 
        $this->setIs_validate($is_validate === false); 
        $this->setQuality($quality);
    }

    // Getters & Setters

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
     * Get the value of id_receiver
     */ 
    public function getId_receiver()
    {
        return $this->id_receiver;
    }

    /**
     * Set the value of id_receiver
     *
     * @return  self
     */ 
    public function setId_receiver($id_receiver)
    {
        $this->id_receiver = $id_receiver;

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
     * Get the value of is_validate
     */ 
    public function getIs_validate()
    {
        return $this->is_validate;
    }

    /**
     * Set the value of is_validate
     *
     * @return  self
     */ 
    public function setIs_validate($is_validate)
    {
        $this->is_validate = $is_validate;

        return $this;
    }

    /**
     * Get the value of quality
     */ 
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set the value of quality
     *
     * @return  self
     */ 
    public function setQuality($quality)
    {
        $this->quality = $quality;

        return $this;
    }


    /**
     * Get the value of id_item_seller
     */ 
    public function getId_item_seller()
    {
        return $this->id_item_seller;
    }

    /**
     * Set the value of id_item_seller
     *
     * @return  self
     */ 
    public function setId_item_seller($id_item_seller)
    {
        $this->id_item_seller = $id_item_seller;

        return $this;
    }

    /**
     * Get the value of id_item_receiver
     */ 
    public function getId_item_receiver()
    {
        return $this->id_item_receiver;
    }

    /**
     * Set the value of id_item_receiver
     *
     * @return  self
     */ 
    public function setId_item_receiver($id_item_receiver)
    {
        $this->id_item_receiver = $id_item_receiver;

        return $this;
    }
}

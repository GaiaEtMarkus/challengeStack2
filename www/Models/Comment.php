<?php

namespace App\Models;

use App\Core\Sql;
use DateTime;

class Comment extends Sql
{
    protected int $id = 0;
    protected string $content;
    protected string $pseudo;
    protected ?DateTime $date;
    protected int $id_user;
    protected int $target_user;
    protected int $target_product;
    protected bool $is_signaled;

    public function hydrate($id = null, $pseudo,  $content, $id_user, $target_user, $target_product, $is_signaled)
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setContent($content);
        $this->setPseudo($pseudo);
        $this->setId_user($id_user); 
        $this->setTarget_user($target_user); 
        $this->setTarget_product($target_product); 
        $this->setIs_signaled($is_signaled); 
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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of id_user
     */ 
    public function getId_user()
    {
        return $this->id_user;
    }

    /**
     * Set the value of id_user
     *
     * @return  self
     */ 
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Get the value of target_user
     */ 
    public function getTarget_user()
    {
        return $this->target_user;
    }

    /**
     * Set the value of target_user
     *
     * @return  self
     */ 
    public function setTarget_user($target_user)
    {
        $this->target_user = $target_user;

        return $this;
    }

    /**
     * Get the value of target_product
     */ 
    public function getTarget_product()
    {
        return $this->target_product;
    }

    /**
     * Set the value of target_product
     *
     * @return  self
     */ 
    public function setTarget_product($target_product)
    {
        $this->target_product = $target_product;

        return $this;
    }

    /**
     * Get the value of pseudo
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of is_signaled
     */ 
    public function getIs_signaled()
    {
        return $this->is_signaled;
    }

    /**
     * Set the value of is_signaled
     *
     * @return  self
     */ 
    public function setIs_signaled($is_signaled)
    {
        $this->is_signaled = $is_signaled;

        return $this;
    }
}
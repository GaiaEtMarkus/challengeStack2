<?php
namespace App\Models;
use App\Core\Sql;

class User extends Sql {

    protected int $id = 0;
    protected String $firstname;
    protected String $lastname;
    protected String $country;
    protected string $email;
    protected string $phone;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $password;
    protected bool $vip = false;
    

    public function hydrate($firstname, $lastname, $email, $phone, $birth_date, $thumbnail, $pwd, $vip)
    {
        $this->setNom($firstname);
        $this->setPrenom($lastname);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setBirthDate($birth_date);
        $this->setThumbnail($thumbnail);
        $this->setVip($vip);
        $this->setPassword($pwd);
    }

    public function changePassword() {
        // To be implemented
    }

    public function modifyProfile() {
        // To be implemented
    }

    public function createTournament() {
        // To be implemented
    }

    public function joinTeam() {
        // To be implemented
    }

    public function participateTournament() {
        // To be implemented
    }

    public function displayProfile() {
        // To be implemented
    }

    public function desinscription() {
        // To be implemented
    }

    public function displayStats() {
        // To be implemented
    }

    public function displayGames() {
        // To be implemented
    }

    
    ############################# Getters ################################
    ######################################################################
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getBirthDate(): string {
        return $this->birth_date;
    }

    public function getThumbnail(): string {
        return $this->thumbnail;
    }

    public function getVip(): bool {
        return $this->vip;
    }

    public function getPhone(): bool {
        return $this->phone;
    }

    public function getEmail(): bool {
        return $this->email;
    }

    public function getPassword(): bool {
        return $this->password;
    }

    ############################# Setters ################################
    ######################################################################    
    
    public function setPhone(int $phone): void {
        $this->id = $phone;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }

    public function setBirthDate(string $birth_date): void {
        $this->birth_date = $birth_date;
    }

    public function setThumbnail(string $thumbnail): void {
        $this->thumbnail = $thumbnail;
    }

    public function setVip(bool $vip): void {
        $this->vip = $vip;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}

<?php
namespace App\Models;
use App\Core\Sql;
use PDOException;

class User extends Sql {

    protected int $id = 0;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $phone;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $pwd;
    protected string $country;
    protected bool $vip = false;

    public function hydrate($firstname, $lastname, $email, $phone, $birth_date, $thumbnail, $pwd, $country, $vip)
    {
        $this->setNom($firstname);
        $this->setPrenom($lastname);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setBirthDate($birth_date);
        $this->setThumbnail($thumbnail);
        $this->setPwd($pwd);
        $this->setCountry($country);
        $this->setVip($vip);
    }

    // Methods
    // public function createUser(User $user) {

    //     try {
    //         $req = Sql::getInstance()->prepare("insert into user(firstname, lastname, email, phone, birth_date, thumbnail, pwd, country, vip)
    //         values(:firstname, :lastname, :email, :phone, :birth_date, :thumbnail, :pwd, :country)");
    //         $req->bindValue(':firstname', $user->getEmail());
    //         $req->bindValue(':lastname',  $user->getlastname());
    //         $req->bindValue(':email', $user->getEmail());
    //         $req->bindValue(':phone', $user->getPhone());
    //         $req->bindValue(':birth_date', $user->getBirthDate());
    //         $req->bindValue(':thumbnail', $user->getThumbnail());
    //         $req->bindValue(':pwd', $user->getPwd());
    //         $req->bindValue(':country', $user->getCountry());
  
    //         $req->execute();
    //     } catch (PDOException $e) {

    //         echo $e->getMessage();
    //     }

    // }

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

    public function getCountry(): string {
        return $this->country;
    }

    public function getName(): string {
        return $this->firstname;
    }

    public function getlastname(): string {
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

    public function getPwd(): string {
        return $this->pwd;
    }

    ############################# Setters ################################
    ######################################################################    
    
    public function setPhone(int $phone): void {
        $this->phone = $phone;
    }

    public function setCountry(string $country): void {
        $this->country = $country;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNom(string $firstname): void {
        $this->firstname = $firstname;
    }

    public function setPrenom(string $lastname): void {
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

    public function setPwd(string $pwd): void {
        $this->pwd = $pwd;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }
}

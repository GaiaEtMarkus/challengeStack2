<?php
namespace App\Models;

use App\Core\Sql;

class User extends Sql{

    protected int $id = 0;
    protected int $id_role = 1;
    protected string $firstname;
    protected string $lastname;
    protected string $pseudo;
    protected string $email;
    protected string $phone;
    protected string $birth_date;
    protected string $thumbnail;
    protected string $address;
    protected string $zip_code;
    protected string $pwd;
    protected string $country;
    protected bool $is_verified = false;

    public function hydrate($id = null, $id_role, $firstname, $lastname, $pseudo, $email, $phone, $birth_date, $address, $zip_code, $country, $pwd, $thumbnail, $is_verified) 
    {
        if ($id !== null) {
            $this->setId($id);
        }
        $this->setIdRole($id_role);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setPseudo($pseudo);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setBirthDate($birth_date);
        $this->setAddress($address);
        $this->setZipCode($zip_code);
        $this->setCountry($country);
        $this->setPwd($pwd);
        $this->setThumbnail($thumbnail);
        $this->setIsVerified($is_verified);
    }

    // public function __sleep()
    // {
    //     return array_diff(array_keys(get_object_vars($this)), ['pdo']);
    // }
    
    // public function __wakeup()
    // {
    //     $this->__construct(); // Rétablissez la connexion à la base de données après la désérialisation
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

    public function getIdRole(): int {
        return $this->id_role;
    }

    public function getCountry(): string {
        return $this->country;
    }

    public function getZipCode(): int {
        return $this->zip_code;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function getBirthDate(): string {
        return $this->birth_date;
    }

    public function getThumbnail(): string {
        return $this->thumbnail;
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

    public function getIsVerified(): bool {
        return $this->is_verified;
    }

    ############################# Setters ################################
    ######################################################################    
    
    public function setPhone(int $phone): void {
        $this->phone = $phone;
    }

    public function setCountry(string $country): void {
        $this->country = $country;
    }

    public function setZipCode(int $zip_code): void {
        $this->zip_code = $zip_code;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setIdRole(int $id_role): void {
        $this->id_role = $id_role;
    }

    public function setLastname(string $lastname): void {
        $this->lastname = $lastname;
    }

    public function setFirstname(string $firstname): void {
        $this->firstname = $firstname;
    }

    public function setPseudo(string $pseudo): void {
        $this->pseudo = $pseudo;
    }

    public function setBirthDate(string $birth_date): void {
        $this->birth_date = $birth_date;
    }

    public function setThumbnail(string $thumbnail): void {
        $this->thumbnail = $thumbnail;
    }

    public function setPwd(string $pwd): void {
        $this->pwd = $pwd;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setIsVerified(bool $is_verified): void {
        $this->is_verified = $is_verified;
    }

    
}

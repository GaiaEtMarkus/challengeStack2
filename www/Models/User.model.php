<?php
namespace App\Models;
use App\Core\Sql;

class User extends Sql {

    protected int $id = 0;
    protected string $nom;
    protected string $prenom;
    protected string $birth_date;
    protected string $thumbnail;
    protected bool $vip = false;

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
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

    // Setters
    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
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

    // Methods
    public function createUser() {
        // To be implemented
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
}

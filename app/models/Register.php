<?php

require_once '../app/models/Users.php';

class Register {
    private $id;
    private $typeAnimal;
    private $latitude;
    private $longitude;
    private $folderFile;
    private $nameFile;
    private $text;
    private $user;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getTypeAnimal() {
        return $this->typeAnimal;
    }
    
    public function setTypeAnimal($typeAnimal) {
        $this->typeAnimal = $typeAnimal;
    }
    
    public function getLatitude() {
        return $this->latitude;
    }
    
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }
    
    public function getLongitude() {
        return $this->longitude;
    }
    
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
    
    public function getFolderFile() {
        return $this->folderFile;
    }
    
    public function setFolderFile($folderFile) {
        $this->folderFile = $folderFile;
    }
    
    public function getNameFile() {
        return $this->nameFile;
    }
    
    public function setNameFile($nameFile) {
        $this->nameFile = $nameFile;
    }
    
    public function getText() {
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
    }
    
    public function getUser() {
        return $this->user;
    }
    
    public function setUser(Users $user) {
        $this->user = $user;
    }
    
    
}
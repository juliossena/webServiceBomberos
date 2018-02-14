<?php 

class Users {
    private $email;
    private $password;
    private $name;
    private $lastName;
    private $telephone;
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }
    
    public function getTelephone() {
        return $this->telephone;
    }
    
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
    
    
    
}
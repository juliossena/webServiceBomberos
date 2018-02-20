<?php

require_once '../app/dao/DAO.php';
require_once '../app/dao/FilterUsers.php';
require_once '../app/models/Users.php';

class UsersDAO extends DAO{
    private $select = "SELECT * FROM Users WHERE %s %s";
    private $insertUser = "INSERT INTO Users (Email, Password, Name, LastName, Telephone) VALUES ('%s', '%s', '%s', '%s', '%s')";
    
    public function insert($object) {
        if ($object instanceof Users) {
            $sql = sprintf($this->insertUser, $object->getEmail(), $object->getPassword(), $object->getName(), $object->getLastName(), $object->getTelephone());
            return $this->runQuery($sql);
        }
    }
    
    
    public function insertObjet($object) {
        return $this->insert($object);
    }
    
    public function update($object) {
    }
    
    public function drop($object) {
    }
    
    protected function getSelect() {
        return $this->select;
    }
    
    
    public function getObjects($filter) {
        $objects = new ArrayObject();
        if ($filter instanceof FilterUsers) {
            $rs = $this->select($filter->getWhere(), $filter->getOrder());
            
            for ($i = 0 ; $i < count($rs) ; $i++){
                $user = new Users();
                $user->setEmail($rs[$i]['Email']);
                $user->setLastName($rs[$i]['LastName']);
                $user->setName($rs[$i]['Name']);
                $user->setPassword($rs[$i]['Password']);
                $user->setTelephone($rs[$i]['Telephone']);
                
                $objects->append($user);
            }
        }
        return $objects;
    }
    
    public function instance($array) {
        
    }
}
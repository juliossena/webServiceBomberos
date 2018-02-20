<?php

require_once '../app/dao/DAO.php';
require_once '../app/dao/FilterRegister.php';
require_once '../app/models/Register.php';

class RegisterDAO extends DAO {
    private $insert = "INSERT INTO Register (TypeAnimal, Latitude, Longitude, FolderFile, NameFile, Text, UserRegistered) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')";
    private $select = "SELECT * FROM Register Where %s %s"; 
    
    public function drop($objeto)
    {}

    public function instance($array)
    {}

    protected function getSelect(){
        return $this->select;
    }

    public function insert($objeto) {
        if ($objeto instanceof Register) {
            $sql = sprintf($this->insert, $objeto->getTypeAnimal(), $objeto->getLatitude(), $objeto->getLongitude(), $objeto->getFolderFile(), $objeto->getNameFile(), $objeto->getText(), $objeto->getUser()->getEmail());
            return $this->runQuery($sql);
        }
    }

    public function update($objeto)
    {}

    public function getObjects($filter){
        $objects = new ArrayObject();
        if ($filter instanceof FilterRegister) {
            $rs = $this->select($filter->getWhere(), $filter->getOrder());
            
            for ($i = 0 ; $i < count($rs) ; $i++){
                $register = new Register();
                $register->setFolderFile($rs[$i]['FolderFile']);
                $register->setId($rs[$i]['Id']);
                $register->setLatitude($rs[$i]['Latitude']);
                $register->setLongitude($rs[$i]['Longitude']);
                $register->setNameFile($rs[$i]['NameFile']);
                $register->setText($rs[$i]['Text']);
                $register->setTypeAnimal($rs[$i]['TypeAnimal']);
                
                $user = new Users();
                $user->setEmail($rs[$i]['UserRegistered']);
                
                $register->setUser($user);
                
                
                $objects->append($register);
            }
        }
        return $objects;
    }

    
}
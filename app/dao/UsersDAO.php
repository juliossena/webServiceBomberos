<?php

require_once '../app/dao/DAO.php';
require_once '../app/dao/FilterUsers.php';
require_once '../app/models/Users.php';

class UsersDAO extends DAO{
    private $select = "SELECT * FROM Users WHERE %s %s";
    private $insertUser = "INSERT INTO Users (Email, Password, Name, LastName, Telephone) VALUES ('%s', '%s', '%s', '%s', '%s')";
    private $insertPermission = "INSERT INTO UsersPermission (IdPermission, EmailUsers) VALUES %s";
    private $insertComposition = "INSERT INTO UserComposition (EmailUser, IdQuestion, IdExercises, SequenceComposition) VALUES ('%s', '%s', '%s', '%s')";
    private $insertUploadTasks = "INSERT INTO UploadTasksUser (IdUploadTasks, EmailUser, DateSend, File, NameFile) VALUES ('%s', '%s', '%s', '%s', '%s')";
    private $insertTasksUser = "INSERT INTO TasksUsers (IdTasks, EmailUser) VALUES ('%s', '%s')";
    private $updateUploadTasks = "UPDATE UploadTasksUser SET DateSend = '%s', File = '%s', NameFile = '%s' WHERE IdUploadTasks LIKE '%s' AND EmailUser LIKE '%s'";
    private $updateCompostion = "UPDATE UserComposition SET SequenceComposition = '%s' WHERE EmailUser LIKE '%s' AND IdQuestion LIKE '%s' AND IdExercises LIKE '%s'";
    private $dropUser = "DELETE FROM Users WHERE Email LIKE '%s'";
    private $dropPermission = "DELETE FROM UsersPermission WHERE EmailUsers LIKE '%s'";
    
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
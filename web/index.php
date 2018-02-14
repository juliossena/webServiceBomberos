<?php 

require_once '../app/dao/UsersDAO.php';
require_once '../app/models/Users.php';

header('Content-Type: application/json');

if (isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
    $user = new Users();
    $user->setEmail($_REQUEST['email']);
    $user->setPassword($_REQUEST['password']);
    
    $filterUser = new FilterUsers($user);
    
    $userDAO = new UsersDAO();
    
    $user = $userDAO->getObjects($filterUser);
    
    
    if ($user->count() > 0) {
        $datos = array(
            'estado' => true
        );
    } else {
        $datos = array(
            'estado' => false
        );
    }
    
    
    
    echo json_encode($datos, JSON_FORCE_OBJECT);
    
}

?>
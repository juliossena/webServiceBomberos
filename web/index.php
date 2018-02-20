<?php 

require_once '../app/dao/UsersDAO.php';
require_once '../app/models/Users.php';
require_once '../app/dao/RegisterDAO.php';
require_once '../app/models/Register.php';



if (isset($_REQUEST['typeAnimal'])
    && isset($_REQUEST['latitude'])
    && isset($_REQUEST['longitude'])
    && isset($_REQUEST['emailUser'])) {
        header('Content-Type: application/json');
        $user = new Users();
        $user->setEmail($_REQUEST['emailUser']);
        
        $extensao = "";
        if (isset($_REQUEST['nameFile'])) {
            $extensao = "." . $_REQUEST['nameFile'];
        }
        
        $date = hash("sha512",(date("Y-m-d H:i:s")));
        
        file_put_contents("../dados/" . $date . $extensao, base64_decode($_REQUEST['folderFile']));
        $bytesFile = file_get_contents("../dados/" . $date . $extensao);
        
        $registerDAO = new RegisterDAO();
        
        $register = new Register();
        if (isset($_REQUEST['folderFile'])) {
            $register->setFolderFile("http://denunciarap.indutel.pe/webServiceBomberos/dados/");
        }
        
        if (isset($_REQUEST['folderFile'])) {
            $register->setNameFile($date . $extensao);
        }
        
        if (isset($_REQUEST['text'])) {
            $register->setText($_REQUEST['text']);
        }
        
        $register->setLatitude($_REQUEST['latitude']);
        $register->setLongitude($_REQUEST['longitude']);
        $register->setTypeAnimal($_REQUEST['typeAnimal']);
        $register->setUser($user);
        
        
        
        if ($registerDAO->insert($register)) {
            $registerJSON['folderFile'] = $register->getFolderFile();
            $registerJSON['latitude'] = $register->getLatitude();
            $registerJSON['longitude'] = $register->getLongitude();
            $registerJSON['nameFile'] = $register->getNameFile();
            $registerJSON['text'] = $register->getText();
            $registerJSON['typeAnimal'] = $register->getTypeAnimal();
            $registerJSON['emailUser'] = $register->getUser()->getEmail();
            
            $datos['register'][] = $registerJSON;
        } else {
            $datos['register'][] = false;
        }
        
        echo json_encode($datos);
} else if (isset($_REQUEST['email']) 
    && isset($_REQUEST['password']) 
    && isset($_REQUEST['name']) 
    && isset($_REQUEST['lastName']) 
    && isset($_REQUEST['telephone'])) {
    
    header('Content-Type: application/json');
    $user = new Users();
    $user->setEmail($_REQUEST['email']);
    $user->setPassword(hash("sha512", $_REQUEST['password']));
    $user->setLastName($_REQUEST['lastName']);
    $user->setName($_REQUEST['name']);
    $user->setTelephone($_REQUEST['telephone']);
    
    $userDAO = new UsersDAO();
    
    if ($userDAO->insert($user)) {
        $userJSON['email'] = $user->getEmail();
        $userJSON['password'] = $user->getPassword();
        $userJSON['name'] = $user->getName();
        $userJSON['lastName'] = $user->getLastName();
        $userJSON['telephone'] = $user->getTelephone();
        
        $datos['users'][] = $userJSON;
    } else {
        $datos['users'][] = false;
    }
    
    echo json_encode($datos);
} else if (isset($_REQUEST['email']) 
    && isset($_REQUEST['password'])) {
    
    header('Content-Type: application/json');
    
    $user = new Users();
    $user->setEmail($_REQUEST['email']);
    $user->setPassword(hash("sha512", $_REQUEST['password']));
    
    $filterUser = new FilterUsers($user);
    
    $userDAO = new UsersDAO();
    
    $users = $userDAO->getObjects($filterUser);
    
    
    if ($users->count() > 0) {
        $user = $users->offsetGet(0);
        if ($user instanceof Users) {
            
            $userJSON['email'] = $user->getEmail();
            $userJSON['password'] = $user->getPassword();
            $userJSON['name'] = $user->getName();
            $userJSON['lastName'] = $user->getLastName();
            $userJSON['telephone'] = $user->getTelephone();
            
            $datos['users'][] = $userJSON;
        }
    } else {
        $datos['users'][] = false;
    }
    
    
    
    echo json_encode($datos);
    
    } else {
        require_once '../app/dao/FilterRegister.php';
        require_once '../app/models/Register.php';
        
        echo '<input type="text" class="input-search" alt="lista-clientes" placeholder="Buscar Nota" />
                    <table class="lista-clientes" style="width:100%;">
                         <thead>
                            <tr>
                                <th>Animal
                                <th>Ubication
                                <th>Arquivo
                                <th>Texto
                                <th>User
                         </thead>';
        
        $registerDAO = new RegisterDAO();
        
        $filter = new FilterRegister(new Register());
        
        $registers = $registerDAO->getObjects($filter);
        
        for ($i = 0 ; $i < $registers->count() ; $i++) {
            $register = $registers->offsetGet($i);
            if ($register instanceof Register) {
                echo ' 
                    <tr>
                        <td>'.$register->getTypeAnimal().'
                        <td><a target="_blank" href="https://www.google.com.pe/maps/place/'.$register->getLatitude().','.$register->getLongitude().'">Ubication</a>
                        <td><a target="_blank" href="'.$register->getFolderFile().$register->getNameFile().'">Arquivo</a>
                        <td>'.$register->getText().'
                        <td>'.$register->getUser()->getEmail().'
                ';
            }
        }
        
        echo '</table>';


        
        
        
        
    }

?>
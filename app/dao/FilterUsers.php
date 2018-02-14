<?php

require_once '../app/dao/FilterSearch.php';


class FilterUsers extends FilterSearch {
    private $users;
    private $order;
    private $administrator = false;
    
    public function __construct(Users $users) {
        $this->users = $users;
        $this->order = "";
    }
    
    public function setWhereAdm() {
        $this->administrator = true;
    }
    
    public function getWhere() {
        $pesquisa = null;
        
        if ($this->users != null) {
            if ($this->users instanceof Users) {
                if ($this->users->getEmail() != null && $this->users->getPassword() != null) {
                    $pesquisa = $this->getCampo($pesquisa) . sprintf(
                        "Email LIKE '%s' AND Password LIKE '%s'",
                        $this->users->getEmail(),
                        $this->users->getPassword());
                }
            }
        } else {
            $pesquisa = '1';
        }
        
        return $pesquisa;
    }
    
    public function setOrder($order) {
        $this->order = $order;
    }
    
    public function getOrder() {
        return $this->order;
    }
}
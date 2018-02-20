<?php

require_once '../app/dao/FilterSearch.php';


class FilterRegister extends FilterSearch {
    private $register;
    private $order;
    private $administrator = false;
    
    public function __construct(Register $register) {
        $this->register = $register;
        $this->order = "";
    }
    
    public function setWhereAdm() {
        $this->administrator = true;
    }
    
    public function getWhere() {
        $pesquisa = null;
        
        if ($this->register != null) {
            if ($this->register instanceof Register) {
                if ($this->register->getId() == null) {
                    $pesquisa = '1';
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
<?php

class Directores_model extends CI_Model {
    
    function __contstruct() {
        parent::__construct();
    }
    
    //Devuelve todos los directores que se encuentran en la tabla, ordenados
    //alfabeticamente por apellidos
    function getDirectores() {
        
        $this->db->select('*');
        $this->db->from('directores');
        $this->db->join('paises', 'directores.codPais = paises.codPais');
        $query = $this->db->get();
        
        return ($query->result());
    }
}
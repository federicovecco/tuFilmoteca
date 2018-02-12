<?php

class Paises_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    //Devuelve todos los paises que hay en la tabla, ordenados alfabeticamente
    function getPaises() {
        
        $query = "SELECT * FROM paises ORDER BY nombPais";
        
        return mysql_query($query);
    }
}
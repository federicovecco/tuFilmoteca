<?php

class Premios_model extends CI_Model {
    
    function __construct() {
        
        parent::__construct();
    }
    
    //Devuelve todos los datos de la tabla premios, ordenados alfabeticamente
    function getPremios() {
        
        $query = "SELECT * FROM premios ORDER BY nombre";
        
        return mysql_query($query);
    }
}
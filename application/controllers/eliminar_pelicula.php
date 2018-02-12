<?php

class Eliminar_pelicula extends CI_Controller {
//Clase controlador que gestiona los modulos, vistas y funciones para eliminar
//una pelicula de la base de datos

    function __construct() {
        
        parent::__construct();
        
        //Carga los modelos que se van a utilizar
        $this->load->model('peliculas_model');
        
        //Carga los helpers CI que se van a utilizar
        $this->load->helper('url');
        
    }//Fin function __construct()
    
    function index($codPelicula = "null") {
        
        $this->load->view('menu.html');
        $this->peliculas_model->deletePelicula($codPelicula);
        $this->load->view('vw_pelicula_eliminada_con_exito');
        $this->load->view('foot.html');
        
    }//Fin function index()
    
}//Fin Clase Eliminar_pelicula

?>
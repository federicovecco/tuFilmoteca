<?php
class Test extends CI_Controller {
    
    function __construct() {
        
        parent::__Construct();
        
        //Carga las librerías de CodeIgniter que se usarán
        //Load the Codeigniter's libraries
        $this->load->library(array('table', 'pagination'));
        
        //Carga el Helper de URL
        //Load the URL Helper
        $this->load->helper('url');
        
        //Carga el Modelo de las pelicuas
        //Load the Model of films
        //$this->load->model('Peliculas_model');
    }
    
    function index(){
        
        $this->load->view('welcome_message');
    }
}

?>
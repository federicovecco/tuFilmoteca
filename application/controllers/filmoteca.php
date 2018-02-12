<?php
class Filmoteca extends CI_Controller {
    
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
        $this->load->model('Peliculas_model');
    }
    
    function index(){
        
        //Solicita los ultimas 20 peliculas al modelo (base de datos)
        //Ask for the las 20 films to the data base through the model
        $lastFilms = $this->Peliculas_model->getLastFilms('20');
        
        //Establece la configuración necesaria para la paginacion en la vista
        //Set the config for the pagination
        $config['base_url'] = base_url().'index.php/filmoteca/index';
        $config['total_rows'] = $this->Peliculas_model->get_total_registros();
        $config['per_page'] = 3;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div><ul class="pagination">';
        $config['full_tag_close'] = '</ul></div>';
        
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';        
        
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        
        //$config['anchor_class'] = 'follow_link';
        
        $this->pagination->initialize($config);
        
        //Carga los datos a mostrar en cada pagina en el array de datos de la vista;
        //Load data to be shown on each page in the array of the view;
        $films_paginados = $this->get_pagination($config['per_page']);
        
        
        //Crea el array con los datos de configuración para la vista
        //Build an array setting the data for the View
        $viewData = array('films' => $lastFilms,
                          'films_paginados' => $films_paginados);
        
        //Carga la Vista pasando los datos de configuración
        //Load the View passing the data of the films
        $this->load->view('menu.html');
        $this->load->view('cuerpo', $viewData);
        $this->load->view('foot.html');
    }//Fin index()
    
    //Devuelve los datos a mostrar por paginas
    //Return dato to be shown by page
    function get_pagination($porPagina) {
        $data = $this->Peliculas_model->get_films_paginados($porPagina, $this->uri->segment(3));
        return $data;
    }//Fin get_pagination()
    
    //Carga la vista con Sly
    //Load the fancy view
    function loadFancyView(){
        
        //Trae los datos de las peliculas desde la base de datos
        //Brings films data from data base
        $allFilms = $this->Peliculas_model->get_all();
        
        $fancyViewData = array('allFilms' => $allFilms);
        
        //Carga la Vista pasando los datos de las peliculas
        //Load the View passing the data of the films
        $this->load->view('menu.html');
        $this->load->view('fancy-view-films', $fancyViewData);
        $this->load->view('foot.html');
        
    }//Fin loadFancyView()
}
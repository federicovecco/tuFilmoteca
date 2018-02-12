<?php

class Buscar_pelicula extends CI_Controller {
    
    function __construct() {
        
        parent::__construct();
        
        //Carga las librerias
        //Load libraries
        $this->load->library(array('form_validation','table', 'pagination'));
        
        //Carga la base de datos
        //Load Data Base
        $config['hostname'] = "localhost";
        $config['username'] = "vt000156_creator";
        $config['password'] = "Keyboard25";
        $config['database'] = "vt000156_filmtec";
        $config['dbdriver'] = "mysql";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        $this->load->database($config);
        
        //Carga los modelos
        //Load models
        $this->load->model('Peliculas_model');
        
        //Carga helpers
        //Load helplers
        $this->load->helper(array('form', 'url'));
        
        //Variables globales
        //Global variables
        global $config;
        
}
    
    function index() {
        
        //Definicion de las variables globales que se utilizan en esta funcion
        global $config;
        
        //Estabece las reglas de control para cada campo y las almacena en un
        //array
        $config = array(
                        array(
                            'field' => 'titulo',
                            'label' => 'Título de la película',
                            'rules' => 'max_length[25]'
                        ),
                        array(
                            'field' => 'pais',
                            'label' => 'País de origen',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'genero',
                            'label' => 'Género',
                            'rules' => 'required'
                        ),
                        array(
                            'field' => 'director',
                            'label' => 'Director',
                            'rules' => ''
                        ),
                        array(
                            'field' => 'actor',
                            'label' => 'Actor Protagonista',
                            'rules' => ''
                        )
                    );
        
        //Establece las reglas de control de campos de acuerdo a lo que establece
        //la variable $config
        $this->form_validation->set_rules($config);
        
        //Establece el mensaje para los campos requeridos que no se han completado
        $this->form_validation->set_message('numeric','Este campo solo permite valores num&eacutericos');
        
        //Carga los modelos de los campos que se deben mostrar en forma de dropdown
        //en las vistas
        $modelos = array('Paises_model', 'Generos_model', 'Directores_model', 'Actores_model');
        
        $this->load->model($modelos);
        
        
        //Traigo los datos de las respectivas tablas, formo un array de datos
        //para luego enviar los datos a las vistas
        $paises = $this->Paises_model->getPaises();
        $generos = $this->Generos_model->getGeneros();
        $directores = $this->Directores_model->getDirectores();
        $actores = $this->Actores_model->getActores();
        
        $datos_vistas = array(
                            'paises'=> $paises,
                            'generos' => $generos,
                            'directores' => $directores,
                            'actores' => $actores,
                            'msg_noEncontrado'=> 'False'
                        );
        
        //Establece la configuración necesaria para la paginacion en la vista
        //Set the config for the pagination
        //$config['base_url'] = base_url().'index.php/buscar_pelicula/page';
        //$config['total_rows'] = $this->Peliculas_model->get_total_registros();
        //$config['per_page'] = 3;
        //$config['uri_segment'] = 3;
        //
        //$config['full_tag_open'] = '<div><ul class="pagination">';
        //$config['full_tag_close'] = '</ul></div>';
        //
        //$config['first_link'] = '&laquo; First';
        //$config['first_tag_open'] = '<li class="prev page">';
        //$config['first_tag_close'] = '</li>';
        //
        //$config['last_link'] = 'Last &raquo;';
        //$config['last_tag_open'] = '<li class="next page">';
        //$config['last_tag_close'] = '</li>';
        //
        //$config['next_link'] = 'Next &rarr;';
        //$config['next_tag_open'] = '<li class="next page">';
        //$config['next_tag_close'] = '</li>';
        //
        //$config['prev_link'] = '&larr; Previous';
        //$config['prev_tag_open'] = '<li class="prev page">';
        //$config['prev_tag_close'] = '</li>';        
        //
        //$config['num_tag_open'] = '<li class="page">';
        //$config['num_tag_close'] = '</li>';
        //
        //$config['cur_tag_open'] = '<li class="active"><a href="">';
        //$config['cur_tag_close'] = '</a></li>';
        
        //$config['anchor_class'] = 'follow_link';
        
        //$this->pagination->initialize($config);
        
        //Carga los datos a mostrar en cada pagina en el array de datos de la vista;
        //Load data to be shown on each page in the array of the view;
//        $films_paginados = $this->get_pagination($config['per_page']);
        
        //carga el menu en la vista
        $this->load->view('menu.html');
    
        if($this->form_validation->run() == FALSE) {
            $this->load->view('formulario_buscar_pelicula', $datos_vistas);
        }else {
            $datos_vistas['peliculas_encontradas'] = $this->buscarPelicula();
            //Si la busqueda no devuelve ningun resultado devuelve la vista indicando esto
            if(($datos_vistas['peliculas_encontradas']) == null) {
                $datos_vistas['msg_noEncontrado'] = "<p class='text-warning text-center'>La b&uacutesqueda no gener&oacute ning&uacuten resultado.<br>Vuelva a intentarlo con otros criterios</p>";
                $this->load->view('formulario_buscar_pelicula', $datos_vistas);
            }else{
                $this->page();
                //$datos_vistas['films_paginados'] = $films_paginados;
                //$datos_vistas['msg_noEncontrado'] = "False";
                //$this->load->view('view_resultados_busqueda_peliculas', $datos_vistas);
            }
        }
        $this->load->view('foot.html');
    } //Fin index()
    
    //Busca una pelicula en la base de datos, utilizando como criterio de busqueda
    //los datos recibidos desde el formulario a traves del metodo POST
    //Search a film in the data base, using the data, sent via POST method, from
    //the form as a condition
    function buscarPelicula() {
        
        //Almaceno los datos cargados en el formulario en un array
        $datos['titulo'] = $_POST['titulo'];
        $datos['pais'] = $_POST['pais'];
        $datos['genero'] = $_POST['genero'];
        $datos['director'] = $_POST['director'];
        $datos['actor'] = $_POST['actor'];
        
        $this->load->model('peliculas_model');
        $resultados = $this->peliculas_model->getPeliculas($datos);
        
        return $resultados;
        
    } //Fin buscarPeliculas()
    
    function page() {
        //Definicion y uso de variables globales
        global $config;
        
        //Establece la configuración necesaria para la paginacion en la vista
        //Set the config for the pagination
        $config['base_url'] = base_url().'index.php/buscar_pelicula/page';
        $config['total_rows'] = $this->Peliculas_model->get_total_registros();
        $config['per_page'] = 5;
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
        
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        //$config['anchor_class'] = 'follow_link';
        
        $this->pagination->initialize($config);
        
        //Carga los datos a mostrar en cada pagina en el array de datos de la vista;
        //Load data to be shown on each page in the array of the view;
        $films_paginados = $this->get_pagination($config['per_page']);
        $datos_vistas['films_paginados'] = $films_paginados;
        
        //carga el menu en la vista
        $this->load->view('menu.html');
        //carga la vista con los resutlados paginados
        $this->load->view('view_resultados_busqueda_peliculas', $datos_vistas);
        //carga el pie de pagina
        $this->load->view('foot.html');
        
    } /*fin page()*/
    
    //Devuelve los datos a mostrar por paginas
    //Return dato to be shown by page
    function get_pagination($porPagina) {
        
        $data = $this->Peliculas_model->get_films_paginados($porPagina, $this->uri->segment(3));
        return $data;
    
    }//Fin get_pagination()
    
}
<html>
<head>
    <title>Resultado de la busqueda - TuFilmoteca</title>
    
    <!--BOOTSTRAP 3-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css" >
    
    <!--Pie de pagina-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css" >
    
    <!--Estilos propios-->
    <style type="text/css">
        #header {
            margin-top: 80px;
        }
    </style>
    
</head>

<body>
    <div id="wrap" class="container">
        <div id="header" class="page-header">
            <h1>Resultados de la busqueda</h1>
        </div>
        
        <?php
        header('Content-type: text/html; charset=UTF-8');
        
        //Crea una plantilla para el formato de la tabla
        $template = array(
                        'table_open' => '<table class="table table-hover table-responsive">',
                        
                        'heading_row_start' => '<thead><tr>',
                        'heading_row_end' => '</tr></thead><tbody>',
                        'heading_cell_start' => '<th class="heading_cell">',
                        'heading_cell_end' => '</th>',
                        
                        //'row_start' => '<tr>',
                        //'row_end' => '</tr>',
                        //'cell_start' => '<td>',
                        //'cell_start' => '</td>',
                        
                        //'row_alt_start' => '<tr>',
                        //'row_alt_end' => '</tr>',
                        //'cell_alt_start' => '<td class="alt_cell">',
                        //'cell_alt_start' => '</td>',
                        
                        'table_close' => '</tbody></table>'
        );
        $this->table->set_template($template);
        
        //Establece los titulos de las columnas de la tabla
        //Set titles for each column in table
        $this->table->set_heading(array('T&iacutetulo','Pa&iacutes','G&eacutenero','Director','Actor Protagonista', 'Editar', 'Borrar'));
        
        //Carga los datos recibidos en la tabla
        //Load data received from controller in table
        foreach($films_paginados as $peli) {
            $link_title = '<a href="' . site_url('/filmoteca/' . $peli->codigo) . '">'. $peli->titulo . '</a>';
            $data_director = $peli->apeDirector . ", " . $peli->nombDirector;
            $data_actor = $peli->nombActor . ", " . $peli->apeActor;
            $enlace = "editar_pelicula/index/".$peli->codigo;
            $btn_Editar = "<a href='" . site_url($enlace) . "'><span class='glyphicon glyphicon-pencil'></span></a>";
            $msg_confirm = "\"Se eliminar&aacute la pelicula definitivamente. Desea continuar?\"";
            $btn_Eliminar = "<a href='" .site_url('eliminar_pelicula/index/'.$peli->codigo)."' onclick='return confirm(". $msg_confirm .")';><span class='glyphicon glyphicon-remove'></span></a>";
            $this->table->add_row(array($link_title, $peli->nombPais, $peli->descGenero, $data_director, $data_actor, $btn_Editar, $btn_Eliminar ));
        }
        
        //Genera la tabla ya creada || Create the table
        echo $this->table->generate();
        
        $aux = $this->uri->segment(3);
        echo "<div id='links_pagination' class='container'>";
        echo $this->pagination->create_links();
        echo "</div>";
    
        ?>
    </div> <!--Fin #wrap-->
    
    <!--JAVASCRIP CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>
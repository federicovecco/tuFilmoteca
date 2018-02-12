<!DOCTYPE>
<html lang="es">
    <head>
        <title>Listado de Directores - TuFilmoteca</title>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!--ensures proper rendering and touch zooming-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--BOOTSTRAP 3-->
        <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css">

        <!--Pie de pagina-->
        <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css">

        <!--Estilos propios-->
        <style type="text/css">
        #header {
            margin-top: 80px;
        }
        </style>
        
    </head>
    <body>
        
        <?php header('Content-type: text/html; charset=UTF-8'); ?>
        
        <!--HEADER-->
        
        <div id="wrap" class="container">
            <div id="header" class="page-header"><h2>Listado de Directores</h2></div>
        
        <!--CUERPO-->
            
         <?php
        //Crea una plantilla para el formato de la tabla
        $template = array(
                    'table_open' => '<table class="table table-hover">',
                    
                    'heading_row_start' => '<th><tr>',
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
    
        //Establece los títulos de las columnas
        $this->table->set_heading(array('Nombre', 'Pa&iacute;s de Origen', 'Fecha de Nacimiento', 'Editar', 'Eliminar', 'Ver Peliculas'));
        
        //Recorro los datos recibidos desde el controlador y los agrego en la tabla dinamicamente
        foreach($directors as $row){
            $linkName = "<a href='" . site_url('/filmoteca/'.$row->codigo) . "'>" . $row->nombre . " " . $row->apellido . "</a>";
            $birthDate = date('d-m-Y', strtotime($row->birthDate));
            $enlace = "editar_pelicula/index/";
            $btn_Editar = "<a href='" . site_url($enlace) . "'><span class='glyphicon glyphicon-pencil'></span></a>";
            $btn_Eliminar = "<a href='" .site_url('eliminar_pelicula/index/')."' onclick='return confirm('')';><span class='glyphicon glyphicon-remove'></span></a>";
            $btn_wathFilms = "<a href='" .site_url('eliminar_pelicula/index/')."' onclick='return confirm('')';><span class='glyphicon glyphicon-list-alt'></span></a>";
            $this->table->add_row(array($linkName, $row->nombPais, $birthDate, $btn_Editar, $btn_Eliminar, $btn_wathFilms));
        }//foreach
        
        //Se en envuelve la tabla en un div con la clase .table-responsive de Bootstrap para lograr que la
        //tabla se vea bien en cualquier dispositivo
        echo "<div class='table-responsive'>";
            //Genera la tabla
            echo $this->table->generate();
        echo "</div>";  /*Fin div table-responsive*/
        ?>
        </div>
    <!--JAVASCRIP CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    
    </body>
</html>
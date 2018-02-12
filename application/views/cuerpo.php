<!DOCTYPE html>
<html lang="sp">
<head>
    <title>Bienvenido a Tu Filmoteca</title>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--ensures proper rendering and touch zooming-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--BOOTSTRAP 3-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css">
        
    <!--Pie de pagina-->
    <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css">
    
    <!--Estilos propios-->
    <style type="text/css">
    
    #links_pagination {
        position: relative;
        top: 0%;
        left: 0%;
        margin-left: 45%;
    }
    
    #header {
        margin-top: 80px;
    }
    </style>
</head>
<body>
<div id="wrap" class="container">
    <div id="header" class="page-header">
        <table width="100%"><tr>
            <td width="75%"><h2>Bienvenido a Tu Filmoteca</h2></td>
            <td width="25%" align="right"><div class="btn-group">
                <button type="button" class="btn btn-default active" onclick="#"><span class="glyphicon glyphicon-list"></style></button>
                <button type="button" class="btn btn-default" onclick="window.location.assign('<?php echo base_url('index.php'); ?>/filmoteca/loadFancyView')"><span class="glyphicon glyphicon-expand"></span></button>
            </div></td>
        </tr></table>
    </div>
    <!--<br>-->
    <?php
    header('Content-type: text/html; charset=UTF-8');
        
    //Crea una plantilla para el formato de la tabla
    $template = array(
                    'table_open' => '<table class="table table-hover">',
                    
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
    
    //Establece los títulos de las columnas
    $this->table->set_heading(array('', 'T&iacutetulo', 'Sin&oacutepsis'));
 
    
    //Carga los datos (enviados desde el controlador) en la tabla   
        foreach($films_paginados as $row) { 
            $enlace_titulo = '<a href="' . site_url('/filmoteca/' . $row->codigo) . '">'. $row->titulo . '</a>';
            $imgPortada = "<img src='http://www.bernardoplanning.com/tuFilmoteca_v1/".$row->portada."' alt='".$row->titulo."' width='75' />";
            $this->table->add_row(array($imgPortada, $enlace_titulo, $row->sinopsis));
        }
    
    //Se en envuelve la tabla en un div con la clase .table-responsive de Bootstrap para lograr que la
    //tabla se vea bien en cualquier dispositivo
    echo "<div class='table-responsive'>";
        //Genera la tabla
        echo $this->table->generate();
    echo "</div>";  /*Fin div table-responsive*/
    
    echo "<div id='links_pagination' class='container'>";
    echo $this->pagination->create_links();
    echo "</div>";
    
    ?>
</div>
    
    <!--JAVASCRIP CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
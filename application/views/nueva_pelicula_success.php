<html>
<head>
    <title>Pelicula Guardada</title>
    
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
    <?php header('Content-type: text/html; charset:UTF-8'); ?>
    <div id="wrap" class="container">
        <div id="header" class="page-header">
            <h3>La película se ha guardado correctamente!</h3>
        </div>
        <p class="text-success">
        <?php echo anchor('Nueva_pelicula', '¡Ingrese una nueva película!', array('class'=>'')); ?></p>
    </div>
    
    <!--JAVASCRIP CODE-->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    
</body>
</html>
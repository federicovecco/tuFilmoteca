<!DOCTYPE html>

<html lang="es">
    <head>
        <title>Bienvenido a Tu Filmoteca</title>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">
        
        <!--BOOTSTRAP 3-->
        <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/bootstrap.min.css">

        <!--Pie de pagina-->
        <link rel="stylesheet" href="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/css/sticky-footer.css">

        <!-- Sly -->
        <link rel="stylesheet" href="<?php echo base_url().'/css/sly-effects.css';?>" />
        
        <!--  -->
        <script type="text/javascript">
            var dataFilm = new Array();
        </script>
        
        <!--Estilos propios-->
        <style type="text/css">
        #header {
            margin-top: 80px;
        }
        </style>
    
    </head>
    <body>
        <?php header('Content-type: text/html; charset=utf-8'); ?>
        <div id="wrap" class="container">
            <div id="header" class="page-header">
                <table width="100%"><tr>
                    <td width="75%"><h2>Bienvenido a Tu Filmoteca</h2></td>
                    <td width="25%" align="right"><div class="btn-group">
                        <button type="button" class="btn btn-default" onclick="window.location.assign('<?php echo base_url('index.php'); ?>')"><span class="glyphicon glyphicon-list"></style></button>
                        <button type="button" class="btn btn-default active" onclick="#"><span class="glyphicon glyphicon-expand"></span></button>
                    </div></td>
                </tr></table>
            </div>
            
            <!-- Sly -->
            <div class="frame effects" id="effects">
                    <ul class="clearfix">
                        
                        <?php 
                            foreach($allFilms as $row){
                                echo "<li><img src=".base_url().$row->portada." alt=\'".$row->titulo."\' width='100%' height='100%'</li>";
//                                echo "<script type='text/javascript'>dataFilm.push(['".$row->titulo."', ".$row->sinopsis."]);</script>";
                         ?>       
                         <script type='text/javascript'>
                            dataFilm.push( <?php echo "'".$row->titulo."'"; ?>);
                            dataFilm.push( <?php echo "'".$row->sinopsis."'"; ?>);
                          </script>
                            
                        <?php
                            
                            }
                        ?>
                    </ul>
            </div>
            
            <!-- Scrollbar -->
            <br>
            <div class="scrollbar">
                <div class="handle">
                        <div class="mousearea"></div>
                </div>
            </div>
            
            <div id="film-description">
                <h3 id="title"><script type="text/javascript">document.write(dataFilm[6]);</script></h3>
                <p id="sinopsis"><script type="text/javascript">document.write(dataFilm[7]);</script></p>
            </div>
        </div>
        
        <!--javascript code-->
        <?php
        echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js'></script>";
        echo "<script src='".base_url()."js/sly.js'></script>";
        echo "<script type='text/javascript' src='".base_url()."js/sly-effects.js'></script>";
        ?>
        <script type="text/javascript" src="http://www.bernardoplanning.com/tuFilmoteca_v1/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" type="image/png" href="statics/pictures/fav_icon.png"/>
        <title>banding tracking</title>

        <!-- Bootstrap -->
        <link href="statics/css/bootstrap.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php?url=home">Accueil</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?url=form">Vous avez vu un gravelot ?</a></li>
                        <li><a href="index.php?url=about">Informations complémentaires</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <?php
            include "core/database_operations.php";
            $db = new Database_operations;
            // $db->get_plover("SE05980", "BLANC"); // -> Test in progress
        
            if (isset($_GET["url"])) {
                include "content/" . $_GET["url"]. ".php";    
            }
            else {
                include "content/home.php";
            }
        ?>
        <script src="statics/js/jquery-2.1.3.min.js"></script>
        <script src="statics/js/bootstrap.min.js"></script>
        <script src="statics/js/banding-tracking.js"></script>
    </body>
</html>
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

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php?url=home">Accueil</a>
                </div>
                <div id="navbarCollapse" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php?url=form">Vous avez vu un gravelot ?</a></li>
                        <li><a href="index.php?url=about">Informations complémentaires</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            if (isset($_GET["url"])) {
                include "content/" . $_GET["url"]. ".php";    
            }
            else {
                include "content/home.php";
            }
        ?>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="statics/js/bootstrap.min.js"></script>
    </body>
</html>
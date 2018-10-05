<!DOCTYPE html>

<html>
    <head>
        <title>Online Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="An e-policy online platform augmented with applications and services, to assist authorities in the EU in elaborating their smart specialisation agenda."/>
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/base.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/sidebar.css" type="text/css">
        <link rel="stylesheet" href="css/social.css" type="text/css">
        <link rel="stylesheet" href="css/fonts.css" type="text/css">
        <link rel="stylesheet" href="css/utils.css" type="text/css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="css/add_esfri.css" type="text/css">
        <link rel="stylesheet" href="css/buttons.css" type="text/css">
        <link rel="stylesheet" href="css/tutorial-boxes.css" type="text/css">

    </head>

    <body>
        <div id='mainpage' class='site'>
            <!--main header-->
            <header id='mainheader' class='site-header'>
                <div class='header-top'>
                    <img src='images/logo.png' class='logo-img' width='60'>
                    <p class='online-title'>Online S3</p>
                </div>
                <div class='header-bottom'>
                    <span class="step-header">
                        Step 2: Research Infrastructure mapping
                    </span>
                </div>
            </header>

            <!--top menu-->
            <nav id='mainnav'>
            <ul>
            <li><a href='index.php'>PanEuropean</a></li>
            <li><a href='esfri-map.php'>ESFRI</a></li>
            <li><a href='add_esfri_main.php'>ESFRI Form</a></li>
            <li><a href='add_non_esfri_main.php'>RI Form</a></li>
			<li><a href='admin_tab.php'>Administrator</a></li>
            </ul>
            </nav>
            <!--site content-->
            <div class='site-content'>
                <header id='appl-title' class='appl-title'>
                    <h2>ESFRI Insertion Form</h2>
                </header>
                <article id='contentmain'>
                  <?php include 'php/forms/add_esfri.php'?>
                </article>

                <aside id='sidebar' class='sidebar'>
                    <?php include 'templates/sidebar.html'; ?>
                </aside>
            </div>

            <!--main footer-->
            < <footer id='mainfooter' class='site-footer'>               
            <!--social share buttons-->
            <div class='social-share'>
                <h3 class='social-title'>Share this:</h3>
                <div class='social-btns'>
                    <div class='twitter-btn'></div>
                    <div class='gplus-btn'></div>
                </div>
            </div>
            <?php include 'templates/footermain.html'; ?>
            </footer>

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://cdn.jsdelivr.net/g/sweetalert2@6.4.4(sweetalert2.min.js+sweetalert2.js)"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/g/sweetalert2@6.4.4(sweetalert2.min.css+sweetalert2.css)">
        <script type="text/javascript" src="js/esfriFormTutorialPopupController.js"></script> <!-- load our javascript file -->

    </body>
</html>

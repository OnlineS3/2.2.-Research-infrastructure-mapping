<!DOCTYPE html>

<html>
    <head>
        <title>Online Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="An e-policy online platform augmented with applications and services, to assist authorities in the EU in elaborating their smart specialisation agenda."/>
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="css/layout.css" type="text/css">
        <link rel="stylesheet" href="css/base.css" type="text/css">
        <link rel="stylesheet" href="css/fonts.css" type="text/css">
        <link rel="stylesheet" href="css/social.css" type="text/css">
        <link rel="stylesheet" href="css/sidebar.css" type="text/css">
        <link rel="stylesheet" href="css/utils.css" type="text/css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="css/buttons.css" type="text/css">
		<link rel="stylesheet" href="css/tab.css" type="text/css">
		<link rel="stylesheet" href="css/administrator_results.css" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
      	<script src="https://maps.googleapis.com/maps/api/js?key=" async defer></script>
     	<script type="text/javascript" src="formProcessor.js"></script> <!-- load our javascript file -->
    </head>

    <body>
<?php include 'password_protect.php'; ?>
    	 <div id='mainpage' class='site'>
			<header id='mainheader' class='site-header'>
                <div class='header-top'>
                    <img src='images/logo.png' class='logo-img' width='60'>
                    <p class='online-title'>Online S3</p>
                </div>
                <div class='header-bottom'>
                    <span class="step-header">
                        2.2 Research Infrastructures Mapping
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
                    <h2>Administrator Panel</h2>
                </header>

				<article id='contentmain'>
					<div class="tab">
						<button class="tablinks" onclick="openCategory(event, 'ESFRItab')" id="defaultOpen">ESFRI</button>
						<button class="tablinks" onclick="openCategory(event, 'RItab')">RI</button>
					</div>
					<div id="ESFRItab" class="tabcontent">
						<h3>ESFRIs</h3>
						<?php include 'php/administrator_esfri.php'?>
					</div>
					<div id="RItab" class="tabcontent">
						<h3>RIs</h3>
						<?php include 'php/administrator_ri.php'?>
					</div>
					<script src="js/admin_button_handler.js"></script>
					<script src="js/tabs.js"></script>

                </article>

                <aside id='sidebar' class='sidebar'>
                    <?php include 'templates/sidebar.html'; ?>
                </aside>
            </div>
            <!--main footer-->
            <footer id='mainfooter' class='site-footer'>
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
    </body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.38499
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>PakarMata|CBR</title>
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- lotiefile -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript">
    function direct_link(){
		//window.location.href="index.php?top=home.php";
		return false;
		}
    </script>
</head>
<body onload="direct_link();">
    <?php include "koneksi.php"; ?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-8 pt-5">RSKM Padang Eye Center <br> Sistem Pakar Diagnosa Penyakit Mata</h1>
            <p class="lead">Menggunakan Metode Case Based Reasoning (CBR) <br> PHP&MySQL</p>
        </div>
    </div>
    <?php include "menu.php"; ?>
    <div class="container">
        <div class="art-postcontent">
            <div style="display:none;"><?php $top=$_GET['top']; ?></div>
            <?php
            if(empty($top)){
            $on_top="home.php";
            echo "<meta http-equiv='refresh' content='0; url=index.php?top=home.php'>";
            }
            else{
            $on_top=$top;
            include "$on_top";
            }
            ?>
        </div>
    </div>
    <footer class="bg-cream text-dark pt-3 pb-3 text-center mt-5">
        Copyright &copy; <script>
            document.write(new Date().getFullYear());
        </script> <a href="https://www.instagram.com/taufanomt/" target="_blank" style="color: #000; text-decoration: unset">RSKM Eye Center. All Rights Reserved.</a> | <i class="fa fa-heart-o" aria-hidden="true"></i> by Taufano.  
    </footer>
    <script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>

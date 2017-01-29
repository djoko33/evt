<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche les CVT d'un service</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="../assets/bootstrap-select-1.10.0/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-datepicker-1.5.1-dist/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap-datepicker-1.5.1-dist/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="../assets/bootstrap-3.3.6-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select-1.10.0/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">

    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
<!-- Fixed navbar -->
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="synthese.html"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="synthese.html" target="_blank">Synthese</a></li>
                <li><a href="terrain.html" target="_blank">Tous les constats</a></li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Par service &eacute;metteur<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                    	$services=array("AUT", "CDT", "EC", "ECE", "EM", "ING", "LOG", "MSR", "MTE", "QSPR", "SIR", "S3P");
                    	foreach ($services as $serv){
                    		echo '<li><a href="afficheTableCVT2.php?serv_emet='.$serv.'">'.$serv.'</a></li>';
                    	}
                    	?>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Par service concern&eacute; <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                    	<?php 
                    	$services=array("AUT", "CDT", "EC", "ECE", "EM", "ING", "LOG", "MSR", "MTE", "QSPR", "SIR", "S3P");
                    	foreach ($services as $serv){
                    		echo '<li><a href="afficheTableCVT2.php?serv_conc='.$serv.'">'.$serv.'</a></li>';
                    	}
                    	?>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Par code <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php 
                    	$codes=array("EM01", "EM02", "EM03");
                    	foreach ($codes as $code){
                    		echo '<li><a href="afficheTableCVT2.php?code='.$code.'">'.$code.'</a></li>';
                    	}
                    	?>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="content">
    <iframe width="100%" height="100%"></iframe>
</div>
		
<body>

</html>
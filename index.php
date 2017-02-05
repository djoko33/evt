<?php
session_start();
include_once('modele/connexionPG.php');
$reponse = $bdd->query('SELECT * FROM options ORDER BY id');
$donnees = $reponse->fetchAll(PDO::FETCH_ASSOC);
$_SESSION["debut"] = $donnees[0]['value'];
$_SESSION["fin"] =$donnees[1]['value'];
$_SESSION["cvtDebut"] = $donnees[2]['value'];
$_SESSION["cvtFin"] =$donnees[3]['value'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>EVT</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=9">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
	<!-- jQuery -->
	<script src="../assets/js/jquery-2.2.3.min.js"></script>
	
	<!-- Bootstrap -->
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css" type="text/css">
	
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<? echo $_SESSION["debut"]; echo "toto";?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-left">
        <li>
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon site<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
					<li><a href="vue/site.php">RMPAC-M</a></li>
					<li class="dropdown-submenu"><a href="">TdB PCI</a>
						<ul class="dropdown-menu">
							<li><a href="vue/siteTdb.php?mp=0">General</a></li>
<?php
for ($i = 1; $i < 9; $i++) 
	{

					echo '<li><a href="vue/siteTdb.php?mp='.$i.'">MP'.$i.'</a></li>';
						
	}
?>		
						</ul>
					</li>
					<li class="dropdown-submenu"><a href="">Fiches PCI</a>
						<ul class="dropdown-menu">
<?php
	include('modele/connexionPG.php');
	for ($i = 1; $i < 9; $i++) 
	{

					echo '<li class="dropdown-submenu"><a href="">MP'.$i.'</a>
						<ul class="dropdown-menu">';
	
	// R�cup�ration des codes PCI du MP
	$rep = $bdd->prepare('SELECT DISTINCT(code), titre FROM pci_fiches WHERE mp= ? ORDER BY code');
	$rep->execute(array($i));
	$s="";
		while ($don = $rep->fetch())
		{											
				echo '<li><a href="vue/tramePci.php?code='.$don['code'].'">'.$don['code'].' : '.$don['titre'].'</a></li>';
		}		
				
				echo '</ul>
					</li>';
	}
	$rep->closeCursor();
	
?>
						</ul>
					</li>
				</ul>
        </li>
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon service<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                	<li class="dropdown-submenu"><a href="#">AUT</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=AUT">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=AUT">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">CDT</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=CDT">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=CDT">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">EC</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=EC">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=EC">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">ECE</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=ECE">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=ECE">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">EM</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=1_EM">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=1_EM">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">ING</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=ING">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=ING">TdB</a></li>
						</ul>
                    </li>    
                    <li class="dropdown-submenu"><a href="#">LOG</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=LOG">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=LOG">TdB</a></li>
						</ul>
                    </li>    
                    <li class="dropdown-submenu"><a href="#">MSR</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=MSR">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=MSR">TdB</a></li>
						</ul>
                    </li>
                    <li class="dropdown-submenu"><a href="#">MTE</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=MTE">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=MTE">TdB</a></li>
						</ul>
                    </li>                         
                    <li class="dropdown-submenu"><a href="#">QSPR</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=QSPR">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=QSPR">TdB</a></li>
						</ul>
                    </li>                      
                    <li class="dropdown-submenu"><a href="#">SIR</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=SIR">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=SIR">TdB</a></li>
						</ul>
                    </li>                         
                    <li class="dropdown-submenu"><a href="#">S3P</a>
						<ul class="dropdown-menu">
							<li><a href="vue/service.php?serv=S3P">Analyse</a></li>
							<li><a href="vue/serviceTdb.php?serv=S3P">TdB</a></li>
						</ul>
                    </li>                        
                </ul>
        </li>			
      	<li>
      		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon Code<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
					<?php
					include('modele/connexionPG.php');
					// R�cup�ration des codes
					$reponse = $bdd->query('SELECT DISTINCT(categorie) FROM codification ORDER BY categorie');
					$s="";
					while ($donnees = $reponse->fetch())
					{
						echo '<li class="dropdown-submenu"><a href="#">'.$donnees['categorie'].'</a>
								<ul class="dropdown-menu">';
						$rep = $bdd->prepare('SELECT quad, libelle FROM codification WHERE categorie=? ORDER BY quad');
						$rep->execute(array($donnees['categorie']));
						while ($don = $rep->fetch())
							{
								echo '<li><a href="vue/code.php?code='.$don['quad'].'">'.$don['quad'].' : '.$don['libelle'].'</a></li>';
							}
							$rep->closeCursor();	
						echo '</ul>
							</li>';
					}
					$reponse->closeCursor();?>				                     
                </ul>
      	</li>
        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mon Sous-Processus<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
					<?php
					include('modele/connexionPG.php');
					// R�cup�ration des MP
					$reponse = $bdd->query('SELECT DISTINCT(mp) FROM sousprocessus ORDER BY mp');
					$s="";
					while ($donnees = $reponse->fetch())
					{
						echo '<li class="dropdown-submenu"><a href="#">'.$donnees['mp'].'</a>
								<ul class="dropdown-menu">';
					$rep = $bdd->prepare('SELECT sp, sp_libelle FROM sousprocessus WHERE mp=? ORDER BY sp');
					$rep->execute(array($donnees['mp']));
					while ($don = $rep->fetch())
						{
						echo '<li><a href="vue/sp.php?sp='.$don['sp'].'">'.$don['sp'].'</a></li>';
						}
						$rep->closeCursor();
						echo '</ul>
							</li>';
					}
					$reponse->closeCursor();?>
				</ul>
		</li>
		<li><a href="vue/mot.php" >Mon Mot Cl&eacute;</a>
		</li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>EVT</h1> 
  <p>EnVie de Terrain ?</p> 
</div>

<!-- Container (About Section) -->
<div id="about" class="container-fluid">
  <div class="row">
    <div class="col-sm-8">
      <h2>4 axes d'exploitation des CVT</h2><br>
      <h4>Une approche globale Site</h4><br>
      <h4>Une approche par service</h4><br>
      <h4>Une approche par code</h4><br>
      <h4>Une approche par sous-processus</h4><br>
      <br>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-signal logo"></span>
    </div>
  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-link logo slideanim"></span>
    </div>
    <div class="col-sm-8">
      <h2>Les liens</h2><br>
      <h4>Les plans d'actions Suret&eacute; du site</h4><br>
      <h4>La d&eacute;marche MQME</h4><br>
      <h4>Le SMI</h4><br>
    </div>
  </div>
</div>


<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Site fait &agrave; la main, bienveillance et patience pour les bugs...</p>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
  
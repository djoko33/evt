
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exploitation Visites Terrain</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">
	<link rel="stylesheet" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/vue.css" type="text/css">
    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Quill Themes -->
    <link href="../assets/css/quill.snow.css" rel="stylesheet">
	<link href="../assets/css/quill.bubble.css" rel="stylesheet">

</head>

<body>

<div class="container">
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-pencil fa-fw"></i> Commentaires
				</div>
	    		<div  class="panel-body">
					<div id="c" >
					</div>				
				</div>
				<button type="button" class="btn btn-default" id="savec">Sauvergarder</button>				    
			</div>
		</div>
	</div>
<!-- /.row -->

</div>

<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/js/Chart.bundle.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/evt.js"></script>
<script src="../assets/js/quill.js"></script>

<script>





<?php 
include_once('fnComment.php');
echo initQuill('c');
echo initComment(1,'c'); ?>


$(document).ready(function(){
	$("#savec").click(function(){
		var comment = JSON.stringify(c.getContents());
		$.ajax({
			type: "POST",
			url: "comment.php",
			data: 'comment='+comment+'&id=1',		
			cache: false,
			success: function(data){
				 alert(data);		}
		});
	
	});
});


</script>
</body>
</html>
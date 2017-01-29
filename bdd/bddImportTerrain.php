<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche un code</title>
	    <script src="../../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../../assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../../assets/bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../../assets/bootstrap-table/bootstrap-table.min.css">

		<style type="text/css">
		    .bs-example{
		    	margin: 20px;
		    }
		</style>
    </head>
    <style>
    form
    {
        text-align:left;
    }
    </style>
<body>

<h1>Traitement</h1><br>

<div class="container">
	<div class="row">
		<form action="import.php" method="post" enctype="multipart/form-data">
		    <label class="btn btn-primary" for="fileToUpload">
		    	<input type="file" name="fileToUpload" class="btn btn-default btn-sm" id="fileToUpload" style="display:none;">
				Choisir Export Terrain
			</label>
		 
		    <input type="submit" class="btn btn-primary" value="MAJ importCVT" name="submit" class="btn btn-primary">
		</form>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-2">
			<button id="importCvt" class="btn btn-primary">ImportCVT</button>
		</div>
		<div class="col-lg-2">
			<button id="resetImportCVT" class="btn btn-primary">Vider ImportCVT</button>
		</div>
		<div class="col-lg-2">
			<button id="resetcodesCVT" class="btn btn-primary">Vider codesCVT</button>
		</div>
		<div class="col-lg-2">
			<button id="traitementCodes" class="btn btn-primary">Traitement LDD</button>
		</div>
		<div class="col-lg-2">
			<button id="resetCVT" class="btn btn-primary">Vider CVT</button>
		</div>
		<div class="col-lg-2">
			<button id="traitementCVT" class="btn btn-primary">Traitement CVT</button>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
        $('#resetImportCVT').click(function(){
            $.ajax({
                type: 'POST',
                url: 'bddResetImportCVT.php',
                success: function(data) {
                    $("p").text(data);  }
            });
   		});
	});
	
	$(document).ready(function(){
		$('#resetCVT').click(function(){
        	$.ajax({
	            type: 'POST',
	            url: 'bddResetCVT.php',
	            success: function(data) {
	                $("p").text(data);  }
        	});
		});
	});

	$(document).ready(function(){
		$('#resetcodesCVT').click(function(){
		    $.ajax({
		        type: 'POST',
		        url: 'bddResetcodesCVT.php',
		        success: function(data) {
		            $("p").text(data);  }
		    	});
			});
		});

	
    $(document).ready(function(){
        $('#importCvt').click(function(){
            $.ajax({
                type: 'POST',
                url: 'import.php',
                success: function(data) {
                    $("p").text(data);  }
            });
   		});
	});
    $(document).ready(function(){
        $('#traitementCVT').click(function(){
            $.ajax({
                type: 'POST',
                url: 'traitement.php',
                success: function(data) {
                    $("p").text(data);  }
            });
   		});
	});
    $(document).ready(function(){
        $('#traitementCodes').click(function(){
            $.ajax({
                type: 'POST',
                url: 'traitementCodes.php',
                success: function(data) {
                    $("p").text(data);  }
            });
   		});
	});

</script>



</body>
</html>